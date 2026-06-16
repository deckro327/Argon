<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    protected $fillable = [
        'name',
        'description',
        'punctuality',
        'departure',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function report(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    public function workers(): HasMany
    {
        return $this->hasMany(Worker::class);
    }

}
