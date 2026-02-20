<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Habit extends Model
{
    protected $fillable = [
        'user_id',
        'name'
    ];

    // A habit belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

     // A habit can have many habit logs.
     public function logs(): HasMany
    {
        return $this->hasMany(HabitLog::class);
    }
}
