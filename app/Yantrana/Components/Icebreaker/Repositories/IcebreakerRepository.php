<?php
/**
* IcebreakerRepository.php - Repository file
*
* This file is part of the Icebreaker component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Icebreaker\Repositories;

use App\Yantrana\Base\BaseRepository;
use App\Yantrana\Components\Icebreaker\Blueprints\IcebreakerRepositoryBlueprint;
use App\Yantrana\Components\Icebreaker\Models\CardDeck;
use App\Yantrana\Components\Icebreaker\Models\CardQuestion;
use Illuminate\Support\Str;

class IcebreakerRepository extends BaseRepository implements IcebreakerRepositoryBlueprint
{
    /**
     * Constructor.
     *-----------------------------------------------------------------------*/
    public function __construct()
    {
    }

    /**
     * Fetch all published decks, optionally filtered by category.
     *---------------------------------------------------------------- */
    public function fetchPublishedDecks($category = null)
    {
        $query = CardDeck::published()
            ->orderBy('sort_order')
            ->orderBy('_id');

        if (!empty($category) && $category !== 'all') {
            $query->category($category);
        }

        return $query->withCount(['activeQuestions'])->get();
    }

    /**
     * Fetch a published deck by slug, with its active questions eager-loaded.
     * Returns null if the deck is missing or unpublished.
     *---------------------------------------------------------------- */
    public function fetchPublishedBySlug($slug)
    {
        return CardDeck::published()
            ->where('slug', $slug)
            ->with(['activeQuestions'])
            ->first();
    }

    /**
     * Admin: fetch all decks (published + draft) with question counts.
     *---------------------------------------------------------------- */
    public function fetchAllForAdmin()
    {
        return CardDeck::orderBy('sort_order')
            ->orderBy('_id', 'desc')
            ->withCount(['questions', 'activeQuestions'])
            ->get();
    }

    /**
     * Admin: fetch a deck by ID or UID.
     *---------------------------------------------------------------- */
    public function fetchDeckById($idOrUid)
    {
        $query = CardDeck::query()->with(['questions']);

        if (is_numeric($idOrUid)) {
            return $query->where('_id', $idOrUid)->first();
        }

        return $query->where('_uid', $idOrUid)->first();
    }

    /**
     * Store a new deck. Auto-generates a unique slug from the name if not provided.
     *---------------------------------------------------------------- */
    public function storeDeck($inputData)
    {
        $deck = new CardDeck;

        // Auto slug if none supplied, and guarantee uniqueness
        if (empty($inputData['slug'])) {
            $inputData['slug'] = $this->generateUniqueSlug($inputData['name'] ?? 'deck');
        } else {
            $inputData['slug'] = $this->generateUniqueSlug($inputData['slug']);
        }

        // Default sort_order = end of list
        if (!isset($inputData['sort_order'])) {
            $inputData['sort_order'] = (int) (CardDeck::max('sort_order') ?? 0) + 1;
        }

        $keyValues = [
            'name',
            'slug',
            'caption',
            'description',
            'category',
            'variant',
            'cover_image',
            'vibe_label',
            'status',
            'sort_order',
        ];

        if ($deck->assignInputsAndSave($inputData, $keyValues)) {
            activityLog('New card deck created: ' . $deck->name);
            return $deck;
        }

        return false;
    }

    /**
     * Update an existing deck. Preserves current slug unless explicitly changed.
     *---------------------------------------------------------------- */
    public function updateDeck($deck, $inputData)
    {
        // If slug changed, re-uniquify (excluding this deck's own row)
        if (isset($inputData['slug']) && $inputData['slug'] !== $deck->slug) {
            $inputData['slug'] = $this->generateUniqueSlug($inputData['slug'], $deck->_id);
        }

        $keyValues = [
            'name',
            'slug',
            'caption',
            'description',
            'category',
            'variant',
            'cover_image',
            'vibe_label',
            'status',
            'sort_order',
        ];

        if ($deck->assignInputsAndSave($inputData, $keyValues)) {
            activityLog('Card deck updated: ' . $deck->name);
            return $deck;
        }

        return false;
    }

    /**
     * Delete a deck. Cascades to questions via foreign key.
     *---------------------------------------------------------------- */
    public function deleteDeck($deck)
    {
        $name = $deck->name;

        if ($deck->delete()) {
            activityLog('Card deck deleted: ' . $name);
            return true;
        }

        return false;
    }

    /**
     * Store a new question in a deck.
     *---------------------------------------------------------------- */
    public function storeQuestion($deck, $inputData)
    {
        $question = new CardQuestion;

        // Default sort_order = end of deck
        if (!isset($inputData['sort_order'])) {
            $inputData['sort_order'] = (int) ($deck->questions()->max('sort_order') ?? 0) + 1;
        }

        $inputData['card_decks__id'] = $deck->_id;

        $keyValues = [
            'card_decks__id',
            'question_text',
            'category_tag',
            'status',
            'sort_order',
        ];

        if ($question->assignInputsAndSave($inputData, $keyValues)) {
            return $question;
        }

        return false;
    }

    /**
     * Update an existing question.
     *---------------------------------------------------------------- */
    public function updateQuestion($question, $inputData)
    {
        $keyValues = [
            'question_text',
            'category_tag',
            'status',
            'sort_order',
        ];

        if ($question->assignInputsAndSave($inputData, $keyValues)) {
            return $question;
        }

        return false;
    }

    /**
     * Delete a question.
     *---------------------------------------------------------------- */
    public function deleteQuestion($question)
    {
        return (bool) $question->delete();
    }

    /**
     * Bulk-import questions from an array of lines (one question per line).
     * Empty lines are skipped, duplicates within the same deck are skipped.
     *---------------------------------------------------------------- */
    public function bulkImportQuestions($deck, array $lines, $defaultCategoryTag = null)
    {
        $created = 0;
        $currentMaxOrder = (int) ($deck->questions()->max('sort_order') ?? 0);

        // Cache existing question texts for dedup within this deck
        $existing = $deck->questions()->pluck('question_text')->map(fn($t) => trim($t))->all();

        foreach ($lines as $rawLine) {
            $text = trim($rawLine);
            if ($text === '' || in_array($text, $existing, true)) {
                continue;
            }

            $currentMaxOrder++;

            $stored = $this->storeQuestion($deck, [
                'question_text' => $text,
                'category_tag' => $defaultCategoryTag,
                'status' => CardQuestion::STATUS_ACTIVE,
                'sort_order' => $currentMaxOrder,
            ]);

            if ($stored) {
                $created++;
                $existing[] = $text;
            }
        }

        if ($created > 0) {
            activityLog("Bulk imported {$created} question(s) into deck: " . $deck->name);
        }

        return $created;
    }

    /**
     * Persist a new sort order for a deck's questions.
     * @param  array  $orderedIds  Array of question _id values in the new order.
     *---------------------------------------------------------------- */
    public function reorderQuestions($deck, array $orderedIds)
    {
        $updated = 0;

        foreach ($orderedIds as $position => $questionId) {
            $affected = CardQuestion::where('card_decks__id', $deck->_id)
                ->where('_id', (int) $questionId)
                ->update(['sort_order' => $position + 1]);

            if ($affected) {
                $updated++;
            }
        }

        return $updated;
    }

    /**
     * Fetch a question by ID or UID.
     *---------------------------------------------------------------- */
    public function fetchQuestionById($idOrUid)
    {
        if (is_numeric($idOrUid)) {
            return CardQuestion::where('_id', $idOrUid)->first();
        }

        return CardQuestion::where('_uid', $idOrUid)->first();
    }

    /**
     * Internal: generate a unique slug for the decks table.
     *---------------------------------------------------------------- */
    protected function generateUniqueSlug($seed, $ignoreId = null)
    {
        $base = Str::slug($seed) ?: 'deck';
        $slug = $base;
        $suffix = 2;

        while (
            CardDeck::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('_id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $suffix;
            $suffix++;
        }

        return $slug;
    }
}
