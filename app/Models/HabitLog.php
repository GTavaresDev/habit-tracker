<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HabitLog extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'habit_id',
        'completed_at'
    ];

    // A habit log belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // A habit log belongs to a habit
    public function habit(): BelongsTo
    {
        return $this->belongsTo(Habit::class);
    }
}
