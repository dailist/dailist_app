<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $plan_type
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $started_at
 * @property \Illuminate\Support\Carbon|null $expired_at
 * @property string|null $midtrans_order_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'plan_type',
        'status',
        'started_at',
        'expired_at',
        'midtrans_order_id',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'expired_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Helper methods
    public function isActive()
    {
        return $this->status === 'active' &&
               (!$this->expired_at || $this->expired_at->isFuture());
    }

    public function checkAndUpdateStatus()
    {
        if ($this->expired_at && $this->expired_at->isPast() && $this->status === 'active') {
            $this->update(['status' => 'expired']);
        }
    }
}
