<?php
/**
* WaitlistSignup.php - Model file
*
* This file is part of the Waitlist component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Waitlist\Models;

use App\Yantrana\Base\BaseModel;
use App\Yantrana\Components\User\Models\User;

class WaitlistSignup extends BaseModel
{
    /**
     * @var string - The database table used by the model.
     */
    protected $table = 'waitlist_signups';

    /**
     * @var string - The primary key for the model.
     */
    protected $primaryKey = '_id';

    /**
     * Status constants
     */
    const STATUS_PENDING = 1;
    const STATUS_INVITED = 2;
    const STATUS_ACTIVATED = 3;
    const STATUS_EXPIRED = 4;

    /**
     * @var array - The attributes that should be casted to native types.
     */
    protected $casts = [
        '_id' => 'integer',
        'status' => 'integer',
        'priority_score' => 'integer',
        'user_id' => 'integer',
        'interest' => 'array',
        'invitation_sent_at' => 'datetime',
        'invitation_expires_at' => 'datetime',
        'activated_at' => 'datetime',
    ];

    /**
     * @var array - The attributes that are mass assignable.
     */
    protected $fillable = [
        'full_name',
        'email',
        'interest',
        'status',
        'priority_score',
        'invitation_sent_at',
        'invitation_token',
        'invitation_expires_at',
        'activated_at',
        'user_id',
        'notes'
    ];

    /**
     * Get the user that this waitlist signup was activated for.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }

    /**
     * Check if the signup is pending.
     */
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if the signup has been invited.
     */
    public function isInvited()
    {
        return $this->status === self::STATUS_INVITED;
    }

    /**
     * Check if the signup has been activated.
     */
    public function isActivated()
    {
        return $this->status === self::STATUS_ACTIVATED;
    }

    /**
     * Check if the invitation has expired.
     */
    public function isExpired()
    {
        return $this->status === self::STATUS_EXPIRED;
    }
}
