<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'quantity',
        'date,hour',
        'details',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function certificateaofabsence(): BelongsTo
    {
        return $this->belongsTo(Certificateaofabsence::class);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function absence (): BelongsTo
    {
        return $this->belongsTo(Absence::class);
    }

    // public function user(): HasMany
    // {
    //     return $this->hasMany(User::class);
    // }
}
