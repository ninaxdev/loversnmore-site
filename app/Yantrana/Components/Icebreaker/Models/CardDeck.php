<?php
/**
* CardDeck.php - Model file
*
* This file is part of the Icebreaker component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Icebreaker\Models;

use App\Yantrana\Base\BaseModel;

class CardDeck extends BaseModel
{
    /**
     * @var string - The database table used by the model.
     */
    protected $table = 'card_decks';

    /**
     * @var string - The primary key for the model.
     */
    protected $primaryKey = '_id';

    /**
     * Status constants
     */
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    /**
     * Cover variants — each gives the deck a distinct personality on the grid.
     *   solid        → deep purple cover, white elements (hero/anchor deck)
     *   soft         → light lavender cover, purple elements (gentle sibling)
     *   white-purple → white cover with purple outline heart + ink type (airy)
     *   white-pink   → white cover with pink outline heart + ink type (playful)
     */
    const VARIANT_SOLID = 'solid';
    const VARIANT_SOFT = 'soft';
    const VARIANT_WHITE_PURPLE = 'white-purple';
    const VARIANT_WHITE_PINK = 'white-pink';

    /**
     * Category values (extensible via admin)
     */
    const CATEGORY_DATING = 'dating';
    const CATEGORY_COUPLES = 'couples';
    const CATEGORY_FRIENDS = 'friends';

    /**
     * @var array - The attributes that should be casted to native types.
     */
    protected $casts = [
        '_id' => 'integer',
        'status' => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * @var array - The attributes that are mass assignable.
     */
    protected $fillable = [
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

    /**
     * Relationship: a deck has many questions.
     *---------------------------------------------------------------- */
    public function questions()
    {
        return $this->hasMany(CardQuestion::class, 'card_decks__id', '_id')
                    ->orderBy('sort_order');
    }

    /**
     * Relationship: only active questions.
     *---------------------------------------------------------------- */
    public function activeQuestions()
    {
        return $this->hasMany(CardQuestion::class, 'card_decks__id', '_id')
                    ->where('status', CardQuestion::STATUS_ACTIVE)
                    ->orderBy('sort_order');
    }

    /**
     * Scope: only published decks (public visible).
     *---------------------------------------------------------------- */
    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    /**
     * Scope: filter by category slug.
     *---------------------------------------------------------------- */
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Public-facing cover image URL, or null if no image uploaded.
     * When null, the frontend falls back to the color-only variant.
     *---------------------------------------------------------------- */
    public function getCoverImageUrlAttribute()
    {
        if (empty($this->cover_image)) {
            return null;
        }

        return asset('media-storage/card-decks/' . $this->cover_image);
    }

    /**
     * Check if the deck is published.
     *---------------------------------------------------------------- */
    public function isPublished()
    {
        return $this->status === self::STATUS_PUBLISHED;
    }
}
