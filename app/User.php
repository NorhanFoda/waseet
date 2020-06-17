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
use App\Models\Stage;
use App\Models\Country;
use App\Models\City;
use App\Models\Material;
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
        // 'no_of_students', 'breif_ar', 'breif_en', 
        'stage_id', 'country_id', 'age',
        'edu_level', 
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

    public function image(){
        return $this->morphOne(Image::class, 'imageRef');
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

    public function stage(){
        return $this->belongsTo(Stage::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function materials(){
        return $this->belongsToMany(Material::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }
}
