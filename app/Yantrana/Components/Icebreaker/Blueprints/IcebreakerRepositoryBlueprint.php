<?php
/**
* IcebreakerRepositoryBlueprint.php - Interface file
*
* This file is part of the Icebreaker component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Icebreaker\Blueprints;

interface IcebreakerRepositoryBlueprint
{
    /**
     * Fetch all published decks, optionally filtered by category.
     */
    public function fetchPublishedDecks($category = null);

    /**
     * Fetch a published deck by slug (with its active questions eager-loaded).
     */
    public function fetchPublishedBySlug($slug);

    /**
     * Fetch all decks for the admin panel (both draft and published).
     */
    public function fetchAllForAdmin();

    /**
     * Fetch a deck by ID or UID (admin use — returns drafts too).
     */
    public function fetchDeckById($idOrUid);

    /**
     * Store a new deck.
     */
    public function storeDeck($inputData);

    /**
     * Update an existing deck.
     */
    public function updateDeck($deck, $inputData);

    /**
     * Delete a deck (cascades to its questions via FK).
     */
    public function deleteDeck($deck);

    /**
     * Store a new question in a deck.
     */
    public function storeQuestion($deck, $inputData);

    /**
     * Update an existing question.
     */
    public function updateQuestion($question, $inputData);

    /**
     * Delete a question.
     */
    public function deleteQuestion($question);

    /**
     * Bulk-import questions into a deck from an array of lines.
     */
    public function bulkImportQuestions($deck, array $lines, $defaultCategoryTag = null);

    /**
     * Persist new question sort order for a deck.
     */
    public function reorderQuestions($deck, array $orderedIds);

    /**
     * Fetch a question by ID or UID.
     */
    public function fetchQuestionById($idOrUid);
}
