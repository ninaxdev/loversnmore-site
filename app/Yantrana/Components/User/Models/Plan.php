<?php

namespace App\Yantrana\Components\User\Models;

use App\Yantrana\Base\BaseModel;

class Plan extends BaseModel
{
    protected $table = 'plans';
    protected $primaryKey = '_id';

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
