<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Image;
use App\Models\Job;
use App\Models\Reservation;
use App\Models\Rating;
use App\Models\Save;
use App\Models\JobApplication;
use App\Models\Document;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'phone', 'country_id', 'address', 
        'exper_years', 'salary_month', 'salary_hour',
        'no_of_students', 'breif_ar', 'breif_en',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function images(){
        return $this->morphMany(Image::class, 'imagable');
    }

    public function job_announces(){
        return $this->hasMany(Job::class);
    }

    public function job_applications(){
        return $this->belongsToMany(Job::class);
    }

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }

    public function ratings(){
        return $this->morphMany(Rating::class, 'ratable');
    }

    public function saves(){
        return $this->morphMany(Save::class, 'savable');
    }

    public function documents(){
        return $this->hasMany(Document::class);
    }
}
