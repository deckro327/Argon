<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Certificateaofabsence extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'date_of_issue',
        'duration',
        'reason',
    ];

    public function report(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
