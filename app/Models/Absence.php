<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Absence extends Model
{
    protected $fillable = [
        'date_of_absence'
    ];

    public function report(): hasMany
    {
        return $this->HasMany(Report::class);
    }

    public function Workers(): BelongsTo
    {
        return $this->BelongsTo(Worker::class);
    }
}
