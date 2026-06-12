<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Schedule;
use App\Models\Absence;
use App\Models\Attendance;
use App\Models\Area;
use App\Models\Report;
use App\Models\Certificateaofabsence;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'profile_image',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function image(): string
    {
        if ($this->profile_image) {
            return asset('storage/' . $this->profile_image);
        } else {
            return asset('img/theme/user.png');
        }
    }

    // Use attendances() for the hasMany relation to Attendance

    public function attendances (): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
    public function absences(): HasMany
    {
        return $this->hasMany(Absence::class);
    }

    public function area(): HasOne
    {
        return $this->hasOne(Area::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    public function certificateaofabsences(): HasMany
    {
        return $this->hasMany(Certificateaofabsence::class);
    }

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }



}
