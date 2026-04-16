<?php

namespace App\Yantrana\Components\User\Models;

use App\Yantrana\Base\BaseModel;

class UserGiftModel extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_gifts';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'payment_metadata' => 'array',
    ];
    protected $guarded = ['id'];

    /**
     * Get the user who sent the gift
     */
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_users__id', '_id');
    }

    /**
     * Get the user who received the gift
     */
    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_users__id', '_id');
    }

    /**
     * Get the icebreaker message associated with this gift
     */
    public function icebreaker()
    {
        return $this->belongsTo(GiftIcebreakerModel::class, 'icebreaker_id', 'id');
    }

    /**
     * Get the gift item details
     */
    public function item()
    {
        return $this->belongsTo(\App\Yantrana\Components\Item\Models\ItemModel::class, 'items__id', '_id');
    }
}
