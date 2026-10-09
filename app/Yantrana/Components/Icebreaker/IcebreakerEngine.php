<?php
/**
 * IcebreakerEngine.php - Main component file
 *
 * This file is part of the Icebreaker component.
 *-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Icebreaker;

use App\Yantrana\Base\BaseEngine;
use App\Yantrana\Components\Icebreaker\Models\CardDeck;
use App\Yantrana\Components\Icebreaker\Models\CardQuestion;
use App\Yantrana\Components\Icebreaker\Repositories\IcebreakerRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class IcebreakerEngine extends BaseEngine
{
    /**
     * @var IcebreakerRepository - Icebreaker Repository
     */
    protected $icebreakerRepository;

    /**
     * Fallback categories used only when there are no decks in the DB yet
     * (e.g. first install, empty seed). Once a deck exists in a category,
     * that category appears automatically — admin can add any new category
     * just by typing it in the deck form.
     */
    protected $fallbackCategories = [
        ['id' => 'dating',   'label' => 'Dating'],
        ['id' => 'couples',  'label' => 'Couples'],
        ['id' => 'friends',  'label' => 'Friends'],
    ];

    /**
     * Constructor.
     *-----------------------------------------------------------------------*/
    public function __construct(IcebreakerRepository $icebreakerRepository)
    {
        $this->icebreakerRepository = $icebreakerRepository;
    }

    /* ================================================================
       Public-facing methods (called by IcebreakerController)
       ================================================================ */

    /**
     * Prepare data for the /icebreakers deck-selection page.
     *---------------------------------------------------------------- */
    public function preparePublicIndex($category = null)
    {
        $category = $this->normalizeCategorySlug($category);
        $decks = $this->icebreakerRepository->fetchPublishedDecks($category);

        // Build filter pills from DISTINCT categories across published decks,
        // always prefixed with "All Decks". Admin add a new category simply
        // by typing it in the deck editor — it appears here automatically.
        $categories = $this->buildPublicCategoryPills();

        return $this->engineReaction(1, [
            'decks' => $decks->map(fn($d) => $this->formatDeckForPublic($d))->all(),
            'categories' => $categories,
            'activeCategory' => $category ?: 'all',
        ]);
    }

    /**
     * Prepare data for the /icebreakers/{slug} deck detail page.
     *---------------------------------------------------------------- */
    public function prepareDeckDetail($slug)
    {
        $deck = $this->icebreakerRepository->fetchPublishedBySlug($slug);

        if (!$deck) {
            return $this->engineReaction(2, [
                'message' => __tr('Deck not found or not yet published.'),
            ]);
        }

        return $this->engineReaction(1, [
            'deck' => $this->formatDeckForPublic($deck, true),
        ]);
    }

    /**
     * Prepare data for the /icebreakers/{slug}/play page.
     * Returns the deck plus the full set of active questions as a JSON-safe payload
     * that the frontend two-card player consumes.
     *---------------------------------------------------------------- */
    public function preparePlay($slug)
    {
        $deck = $this->icebreakerRepository->fetchPublishedBySlug($slug);

        if (!$deck) {
            return $this->engineReaction(2, [
                'message' => __tr('Deck not found or not yet published.'),
            ]);
        }

        if ($deck->activeQuestions->isEmpty()) {
            return $this->engineReaction(2, [
                'message' => __tr('This deck has no questions yet.'),
            ]);
        }

        return $this->engineReaction(1, [
            'deck' => $this->formatDeckForPublic($deck, true),
            'cards' => $deck->activeQuestions->map(fn($q) => [
                'q' => $q->question_text,
                'cat' => $q->category_tag ?: 'BE FOR REAL',
            ])->values()->all(),
        ]);
    }

    /* ================================================================
       Admin-facing methods (called by IcebreakerAdminController)
       ================================================================ */

    /**
     * Data for the admin deck list.
     *---------------------------------------------------------------- */
    public function prepareAdminIndex()
    {
        $decks = $this->icebreakerRepository->fetchAllForAdmin();

        return $this->engineReaction(1, [
            'decks' => $decks,
        ]);
    }

    /**
     * Data for the admin deck editor. If $deckIdOrUid is null, we're creating a new deck.
     *---------------------------------------------------------------- */
    public function prepareAdminEditor($deckIdOrUid = null)
    {
        $deck = null;

        if ($deckIdOrUid) {
            $deck = $this->icebreakerRepository->fetchDeckById($deckIdOrUid);
            if (!$deck) {
                return $this->engineReaction(2, [
                    'message' => __tr('Deck not found.'),
                ]);
            }
        }

        return $this->engineReaction(1, [
            'deck' => $deck,
            // Existing categories pulled from the DB — used as datalist suggestions
            // in the admin form so Nina can autocomplete or type a new one.
            'categories' => $this->buildAdminCategorySuggestions(),
            'variants' => [
                ['id' => CardDeck::VARIANT_SOLID, 'label' => 'Solid purple (deep)'],
                ['id' => CardDeck::VARIANT_SOFT,  'label' => 'Soft lavender (light)'],
            ],
        ]);
    }

    /**
     * Create OR update a deck. Handles cover image upload.
     *---------------------------------------------------------------- */
    public function processStoreDeck($inputData, $uploadedFile = null, $deckIdOrUid = null)
    {
        $existingDeck = $deckIdOrUid
            ? $this->icebreakerRepository->fetchDeckById($deckIdOrUid)
            : null;

        // Handle cover image upload (if provided)
        if ($uploadedFile) {
            $storedName = $this->storeCoverImage($uploadedFile, $existingDeck);
            if ($storedName === false) {
                return $this->engineReaction(2, [
                    'message' => __tr('Failed to save the cover image. Please try again.'),
                ]);
            }
            $inputData['cover_image'] = $storedName;
        }

        // Normalize status coming from a checkbox
        $inputData['status'] = !empty($inputData['status'])
            ? CardDeck::STATUS_PUBLISHED
            : CardDeck::STATUS_DRAFT;

        // Default variant + category. Category is slugified so Nina can type
        // "Girls Night Out" in the form and the system stores "girls-night-out".
        $inputData['variant'] = $inputData['variant'] ?? CardDeck::VARIANT_SOLID;
        $inputData['category'] = $this->normalizeCategorySlug(
            $inputData['category'] ?? CardDeck::CATEGORY_DATING
        ) ?: CardDeck::CATEGORY_DATING;

        if ($existingDeck) {
            $saved = $this->icebreakerRepository->updateDeck($existingDeck, $inputData);
            $msg = __tr('Deck updated.');
        } else {
            $saved = $this->icebreakerRepository->storeDeck($inputData);
            $msg = __tr('Deck created.');
        }

        if (!$saved) {
            return $this->engineReaction(2, [
                'message' => __tr('Failed to save the deck. Please try again.'),
            ]);
        }

        $this->flushPublicCache();

        return $this->engineReaction(1, [
            'message' => $msg,
            'deck' => $saved,
        ]);
    }

    /**
     * Delete a deck (with its questions).
     *---------------------------------------------------------------- */
    public function processDeleteDeck($deckIdOrUid)
    {
        $deck = $this->icebreakerRepository->fetchDeckById($deckIdOrUid);

        if (!$deck) {
            return $this->engineReaction(2, [
                'message' => __tr('Deck not found.'),
            ]);
        }

        // Best-effort cover cleanup
        if (!empty($deck->cover_image)) {
            $this->deleteCoverImage($deck->cover_image);
        }

        if (!$this->icebreakerRepository->deleteDeck($deck)) {
            return $this->engineReaction(2, [
                'message' => __tr('Failed to delete the deck.'),
            ]);
        }

        $this->flushPublicCache();

        return $this->engineReaction(1, [
            'message' => __tr('Deck deleted.'),
        ]);
    }

    /**
     * Create a single question in a deck.
     *---------------------------------------------------------------- */
    public function processStoreQuestion($deckIdOrUid, $inputData)
    {
        $deck = $this->icebreakerRepository->fetchDeckById($deckIdOrUid);
        if (!$deck) {
            return $this->engineReaction(2, ['message' => __tr('Deck not found.')]);
        }

        $inputData['status'] = $inputData['status'] ?? CardQuestion::STATUS_ACTIVE;

        $question = $this->icebreakerRepository->storeQuestion($deck, $inputData);
        if (!$question) {
            return $this->engineReaction(2, ['message' => __tr('Failed to store the question.')]);
        }

        $this->flushPublicCache();

        return $this->engineReaction(1, [
            'question' => $question,
        ]);
    }

    /**
     * Update an existing question.
     *---------------------------------------------------------------- */
    public function processUpdateQuestion($questionIdOrUid, $inputData)
    {
        $question = $this->icebreakerRepository->fetchQuestionById($questionIdOrUid);
        if (!$question) {
            return $this->engineReaction(2, ['message' => __tr('Question not found.')]);
        }

        $saved = $this->icebreakerRepository->updateQuestion($question, $inputData);
        if (!$saved) {
            return $this->engineReaction(2, ['message' => __tr('Failed to update the question.')]);
        }

        $this->flushPublicCache();

        return $this->engineReaction(1, [
            'question' => $saved,
        ]);
    }

    /**
     * Delete a question.
     *---------------------------------------------------------------- */
    public function processDeleteQuestion($questionIdOrUid)
    {
        $question = $this->icebreakerRepository->fetchQuestionById($questionIdOrUid);
        if (!$question) {
            return $this->engineReaction(2, ['message' => __tr('Question not found.')]);
        }

        if (!$this->icebreakerRepository->deleteQuestion($question)) {
            return $this->engineReaction(2, ['message' => __tr('Failed to delete the question.')]);
        }

        $this->flushPublicCache();

        return $this->engineReaction(1, [
            'message' => __tr('Question deleted.'),
        ]);
    }

    /**
     * Bulk-import questions from a textarea paste.
     * Splits on newlines, skips empty lines, dedupes within the deck.
     *---------------------------------------------------------------- */
    public function processBulkImport($deckIdOrUid, $rawText, $defaultCategoryTag = null)
    {
        $deck = $this->icebreakerRepository->fetchDeckById($deckIdOrUid);
        if (!$deck) {
            return $this->engineReaction(2, ['message' => __tr('Deck not found.')]);
        }

        $lines = preg_split('/\r\n|\r|\n/', (string) $rawText);
        $created = $this->icebreakerRepository->bulkImportQuestions(
            $deck,
            $lines,
            $defaultCategoryTag
        );

        $this->flushPublicCache();

        return $this->engineReaction(1, [
            'message' => __tr(':count question(s) imported.', [':count' => $created]),
            'created' => $created,
        ]);
    }

    /**
     * Persist question reorder from the admin drag-drop.
     *---------------------------------------------------------------- */
    public function processReorderQuestions($deckIdOrUid, array $orderedIds)
    {
        $deck = $this->icebreakerRepository->fetchDeckById($deckIdOrUid);
        if (!$deck) {
            return $this->engineReaction(2, ['message' => __tr('Deck not found.')]);
        }

        $updated = $this->icebreakerRepository->reorderQuestions($deck, $orderedIds);
        $this->flushPublicCache();

        return $this->engineReaction(1, [
            'updated' => $updated,
        ]);
    }

    /* ================================================================
       Internal helpers
       ================================================================ */

    /**
     * Format a deck model for public consumption (view or JSON payload).
     *---------------------------------------------------------------- */
    protected function formatDeckForPublic($deck, $includeMeta = false)
    {
        $data = [
            'id' => $deck->_id,
            'uid' => $deck->_uid,
            'name' => $deck->name,
            'slug' => $deck->slug,
            'caption' => $deck->caption,
            'category' => $deck->category,
            'variant' => $deck->variant,
            'cover_image_url' => $deck->cover_image_url,
            'question_count' => $deck->active_questions_count ?? $deck->activeQuestions->count(),
        ];

        if ($includeMeta) {
            $data['description'] = $deck->description;
            $data['vibe_label'] = $deck->vibe_label ?: 'All Levels';
        }

        return $data;
    }

    /**
     * Persist an uploaded cover image and return the stored filename.
     * Removes any previous image on the deck when replacing.
     *---------------------------------------------------------------- */
    protected function storeCoverImage($uploadedFile, $existingDeck = null)
    {
        try {
            $ext = strtolower($uploadedFile->getClientOriginalExtension()) ?: 'jpg';
            $filename = uniqid('deck_', true) . '.' . $ext;
            $targetDir = public_path('media-storage/card-decks');

            if (!is_dir($targetDir)) {
                @mkdir($targetDir, 0755, true);
            }

            $uploadedFile->move($targetDir, $filename);

            // Remove previous cover if we're replacing
            if ($existingDeck && !empty($existingDeck->cover_image)) {
                $this->deleteCoverImage($existingDeck->cover_image);
            }

            return $filename;
        } catch (\Throwable $e) {
            \Log::error('Icebreaker cover image upload failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete a cover image file from public storage.
     *---------------------------------------------------------------- */
    protected function deleteCoverImage($filename)
    {
        $path = public_path('media-storage/card-decks/' . $filename);
        if (is_file($path)) {
            @unlink($path);
        }
    }

    /**
     * Bust any cached public data so admin edits appear immediately on the site.
     * Currently the public views don't hit a named cache, but keeping this hook
     * means later caching additions have one central invalidation point.
     *---------------------------------------------------------------- */
    protected function flushPublicCache()
    {
        Cache::forget('icebreakers.public_decks');
        // Extend here if we add per-deck caches.
    }

    /* ================================================================
       Category helpers — categories are dynamic (admin can add any)
       ================================================================ */

    /**
     * Normalize a user-typed category string into a URL-safe slug.
     *   "Girls Night Out"  → "girls-night-out"
     *   "DATING"           → "dating"
     *   "  dating  "       → "dating"
     *   "all"              → "all" (special — not a real category, just a filter)
     *   null / ""          → null
     *---------------------------------------------------------------- */
    protected function normalizeCategorySlug($raw)
    {
        if (empty($raw)) {
            return null;
        }
        return \Illuminate\Support\Str::slug(trim($raw)) ?: null;
    }

    /**
     * Convert a slug back to a human-readable label for display.
     *   "girls-night-out" → "Girls Night Out"
     *   "dating"          → "Dating"
     *---------------------------------------------------------------- */
    protected function labelFromSlug($slug)
    {
        return \Illuminate\Support\Str::title(str_replace('-', ' ', (string) $slug));
    }

    /**
     * Build the public filter pills (All Decks + every DISTINCT category
     * currently in use on published decks). Falls back to the default set
     * only when no published decks exist yet.
     *---------------------------------------------------------------- */
    protected function buildPublicCategoryPills()
    {
        $slugs = CardDeck::published()
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category')
            ->filter()
            ->values()
            ->all();

        // Empty site? Show the sensible defaults so the UI isn't blank.
        if (empty($slugs)) {
            return array_merge(
                [['id' => 'all', 'label' => 'All Decks']],
                $this->fallbackCategories
            );
        }

        $pills = [['id' => 'all', 'label' => 'All Decks']];
        foreach ($slugs as $slug) {
            $pills[] = ['id' => $slug, 'label' => $this->labelFromSlug($slug)];
        }
        return $pills;
    }

    /**
     * Suggestions shown in the admin deck editor's category autocomplete.
     * Union of all existing categories (published + draft) plus the default
     * fallback set, deduped and alphabetized.
     *---------------------------------------------------------------- */
    protected function buildAdminCategorySuggestions()
    {
        $existing = CardDeck::whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->all();

        $defaults = array_column($this->fallbackCategories, 'id');
        $merged = array_values(array_unique(array_merge($defaults, $existing)));
        sort($merged);

        return array_map(fn($slug) => [
            'id' => $slug,
            'label' => $this->labelFromSlug($slug),
        ], $merged);
    }
}
