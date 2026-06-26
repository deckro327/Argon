<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'date',
        'time',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public function report(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    public function Workers(): BelongsTo
    {
        return $this->belongsTo(Worker::class);
    }
}
