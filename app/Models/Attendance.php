<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'worker_id',
        'status',
        'punctuality',
        'departure',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function worker(): BelongsTo
    {
        return $this->belongsTo(Worker::class, 'worker_id');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'presente' => 'Presente',
            'ausente' => 'Ausente',
            'justificado' => 'Justificado',
            default => ucfirst(str_replace('_', ' ', (string) $this->status)),
        };
    }
}
