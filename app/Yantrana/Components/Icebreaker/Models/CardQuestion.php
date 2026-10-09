<?php
/**
* CardQuestion.php - Model file
*
* This file is part of the Icebreaker component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Icebreaker\Models;

use App\Yantrana\Base\BaseModel;

class CardQuestion extends BaseModel
{
    /**
     * @var string - The database table used by the model.
     */
    protected $table = 'card_questions';

    /**
     * @var string - The primary key for the model.
     */
    protected $primaryKey = '_id';

    /**
     * Status constants
     */
    const STATUS_ACTIVE = 1;
    const STATUS_HIDDEN = 0;

    /**
     * @var array - The attributes that should be casted to native types.
     */
    protected $casts = [
        '_id' => 'integer',
        'card_decks__id' => 'integer',
        'status' => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * @var array - The attributes that are mass assignable.
     */
    protected $fillable = [
        'card_decks__id',
        'question_text',
        'category_tag',
        'status',
        'sort_order',
    ];

    /**
     * Relationship: a question belongs to a deck.
     *---------------------------------------------------------------- */
    public function deck()
    {
        return $this->belongsTo(CardDeck::class, 'card_decks__id', '_id');
    }

    /**
     * Scope: only active questions.
     *---------------------------------------------------------------- */
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    /**
     * Check if the question is active.
     *---------------------------------------------------------------- */
    public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE;
    }
}
