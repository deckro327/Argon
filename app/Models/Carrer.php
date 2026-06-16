<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Carrer extends Model
{


    protected $perPage = 20;

    protected $fillable = ['name', 'code', 'students_id'];


    public function worker()
    {
        return $this->belongsTo(Worker::class, 'students_id', 'id');
    }


}
