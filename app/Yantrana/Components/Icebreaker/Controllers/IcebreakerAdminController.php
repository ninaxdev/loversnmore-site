<?php
/**
 * IcebreakerAdminController.php - Admin controller
 *
 * This file is part of the Icebreaker component.
 *-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Icebreaker\Controllers;

use App\Yantrana\Base\BaseController;
use App\Yantrana\Components\Icebreaker\IcebreakerEngine;
use App\Yantrana\Components\Icebreaker\Requests\DeckStoreRequest;
use App\Yantrana\Components\Icebreaker\Requests\QuestionStoreRequest;
use Illuminate\Http\Request;

class IcebreakerAdminController extends BaseController
{
    /**
     * @var IcebreakerEngine
     */
    protected $icebreakerEngine;

    public function __construct(IcebreakerEngine $icebreakerEngine)
    {
        $this->icebreakerEngine = $icebreakerEngine;
    }

    /* ================================================================
       Deck-level views
       ================================================================ */

    /**
     * GET /admin/manage/icebreakers/decks — list of all decks
     *---------------------------------------------------------------- */
    public function index()
    {
        $processReaction = $this->icebreakerEngine->prepareAdminIndex();

        return $this->loadManageView('manage.icebreakers.index', $processReaction['data']);
    }

    /**
     * GET /admin/manage/icebreakers/decks/create — new-deck form
     *---------------------------------------------------------------- */
    public function create()
    {
        $processReaction = $this->icebreakerEngine->prepareAdminEditor(null);

        return $this->loadManageView('manage.icebreakers.editor', $processReaction['data']);
    }

    /**
     * POST /admin/manage/icebreakers/decks — store new deck
     *---------------------------------------------------------------- */
    public function store(DeckStoreRequest $request)
    {
        $processReaction = $this->icebreakerEngine->processStoreDeck(
            $request->except('cover_image'),
            $request->file('cover_image')
        );

        $flashType = $processReaction['reaction_code'] === 1 ? 'success' : 'error';
        $message   = $processReaction['data']['message'] ?? __tr('Something went wrong.');

        if ($processReaction['reaction_code'] === 1 && !empty($processReaction['data']['deck'])) {
            return redirect()
                ->route('manage.icebreakers.decks.edit', ['deck' => $processReaction['data']['deck']->_uid])
                ->with($flashType, $message);
        }

        return redirect()
            ->route('manage.icebreakers.decks.create')
            ->withInput()
            ->with($flashType, $message);
    }

    /**
     * GET /admin/manage/icebreakers/decks/{deck}/edit — edit an existing deck
     *---------------------------------------------------------------- */
    public function edit($deckUidOrId)
    {
        $processReaction = $this->icebreakerEngine->prepareAdminEditor($deckUidOrId);

        if ($processReaction['reaction_code'] !== 1) {
            return redirect()
                ->route('manage.icebreakers.decks.index')
                ->with('error', $processReaction['data']['message']);
        }

        return $this->loadManageView('manage.icebreakers.editor', $processReaction['data']);
    }

    /**
     * PUT /admin/manage/icebreakers/decks/{deck} — update deck
     *---------------------------------------------------------------- */
    public function update(DeckStoreRequest $request, $deckUidOrId)
    {
        $processReaction = $this->icebreakerEngine->processStoreDeck(
            $request->except('cover_image'),
            $request->file('cover_image'),
            $deckUidOrId
        );

        $flashType = $processReaction['reaction_code'] === 1 ? 'success' : 'error';
        $message   = $processReaction['data']['message'] ?? __tr('Something went wrong.');

        return redirect()
            ->route('manage.icebreakers.decks.edit', ['deck' => $deckUidOrId])
            ->with($flashType, $message);
    }

    /**
     * DELETE /admin/manage/icebreakers/decks/{deck} — delete deck
     *---------------------------------------------------------------- */
    public function destroy($deckUidOrId)
    {
        $processReaction = $this->icebreakerEngine->processDeleteDeck($deckUidOrId);

        $flashType = $processReaction['reaction_code'] === 1 ? 'success' : 'error';
        $message   = $processReaction['data']['message'] ?? __tr('Something went wrong.');

        return redirect()
            ->route('manage.icebreakers.decks.index')
            ->with($flashType, $message);
    }

    /* ================================================================
       Question-level actions (AJAX from the deck editor)
       ================================================================ */

    /**
     * POST /admin/manage/icebreakers/decks/{deck}/questions — add a question
     *---------------------------------------------------------------- */
    public function storeQuestion(QuestionStoreRequest $request, $deckUidOrId)
    {
        $processReaction = $this->icebreakerEngine->processStoreQuestion(
            $deckUidOrId,
            $request->only(['question_text', 'category_tag', 'status'])
        );

        return response()->json($this->wrapReaction($processReaction));
    }

    /**
     * PUT /admin/manage/icebreakers/questions/{question} — update question
     *---------------------------------------------------------------- */
    public function updateQuestion(QuestionStoreRequest $request, $questionUidOrId)
    {
        $processReaction = $this->icebreakerEngine->processUpdateQuestion(
            $questionUidOrId,
            $request->only(['question_text', 'category_tag', 'status'])
        );

        return response()->json($this->wrapReaction($processReaction));
    }

    /**
     * DELETE /admin/manage/icebreakers/questions/{question} — delete question
     *---------------------------------------------------------------- */
    public function destroyQuestion($questionUidOrId)
    {
        $processReaction = $this->icebreakerEngine->processDeleteQuestion($questionUidOrId);

        return response()->json($this->wrapReaction($processReaction));
    }

    /**
     * POST /admin/manage/icebreakers/decks/{deck}/questions/bulk — bulk import
     *---------------------------------------------------------------- */
    public function bulkImportQuestions(Request $request, $deckUidOrId)
    {
        $request->validate([
            'raw_text' => 'required|string',
            'category_tag' => 'nullable|string|max:40',
        ]);

        $processReaction = $this->icebreakerEngine->processBulkImport(
            $deckUidOrId,
            $request->input('raw_text'),
            $request->input('category_tag')
        );

        $flashType = $processReaction['reaction_code'] === 1 ? 'success' : 'error';
        $message   = $processReaction['data']['message'] ?? __tr('Something went wrong.');

        return redirect()
            ->route('manage.icebreakers.decks.edit', ['deck' => $deckUidOrId])
            ->with($flashType, $message);
    }

    /**
     * POST /admin/manage/icebreakers/decks/{deck}/questions/reorder — persist drag-drop order
     *---------------------------------------------------------------- */
    public function reorderQuestions(Request $request, $deckUidOrId)
    {
        $request->validate([
            'ordered_ids'   => 'required|array',
            'ordered_ids.*' => 'integer',
        ]);

        $processReaction = $this->icebreakerEngine->processReorderQuestions(
            $deckUidOrId,
            $request->input('ordered_ids')
        );

        return response()->json($this->wrapReaction($processReaction));
    }

    /* ================================================================
       Helper: shape the engine reaction into a JSON response
       ================================================================ */
    protected function wrapReaction(array $processReaction): array
    {
        return [
            'success' => $processReaction['reaction_code'] === 1,
            'message' => $processReaction['data']['message'] ?? null,
            'data'    => $processReaction['data'] ?? [],
        ];
    }
}
