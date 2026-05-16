<?php

namespace App\Yantrana\Components\User\Models;

use App\Yantrana\Base\BaseModel;

class GiftIcebreakerModel extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gift_icebreakers';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'integer',
    ];

    protected $guarded = ['id'];

    /**
     * Timestamps
     */
    public $timestamps = false;

    /**
     * Scope to get only active icebreakers
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope to get icebreakers for a specific gift item,
     * falling back to generic (gift_item_id = null) ones.
     */
    public function scopeForGift($query, $giftItemId)
    {
        return $query->where(function ($q) use ($giftItemId) {
            $q->where('gift_item_id', $giftItemId)
              ->orWhereNull('gift_item_id');
        });
    }
}
