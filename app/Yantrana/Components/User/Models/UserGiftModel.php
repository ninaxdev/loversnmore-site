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
    protected $casts = [];
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
}
