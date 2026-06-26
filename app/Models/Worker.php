<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

 class Worker extends Model
{
    protected $table = 'workers';

    protected $fillable = ['name', 'surname', 'email', 'age', 'area_id'];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}

public function Report(): HasMany
{
    return $this->hasMany(Report::class);
}

public function Schedule(): HasOne
{
    return $this->hasOne(Schedule::class);
}

public function Absences(): HasMany
{
    return $this->hasMany(Absence::class);
}

public function Attendance(): HasMany
{
    return $this->hasMany(Attendance::class);
}

}
