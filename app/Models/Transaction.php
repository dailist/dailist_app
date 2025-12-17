<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'subscription_id',
        'amount',
        'status',
        'snap_token',
        'midtrans_order_id',
        'midtrans_transaction_id',
        'payment_type',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    // Helper methods
    public function isSuccess()
    {
        return $this->status === 'success';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }
}
