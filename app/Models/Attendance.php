<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'quantity',
        'date,hour',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
