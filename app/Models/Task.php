<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $description
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $due_date
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Task extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helper methods
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isOverdue()
    {
        return $this->due_date &&
               $this->due_date->isPast() &&
               $this->status === 'pending';
    }
}
