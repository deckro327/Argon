<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Student
 *
 * @property $id
 * @property $name
 * @property $surname
 * @property $email
 * @property $age
 * @property $created_at
 * @property $updated_at
 *
 * @property Carrer[] $carrers
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Student extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'surname', 'email', 'age'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carrers()
    {
        return $this->hasMany(\App\Models\Carrer::class, 'id', 'students_id');
    }
    

}
