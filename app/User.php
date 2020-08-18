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
use App\Models\EduLevel;
use App\Models\EduType;
use App\Models\Nationality;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\BankReceipt;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone_main', 'password',
        'is_verified', 'allow_notification', 'api_token', 'api_token_create_date' , 'api_token_expire_date',
        'phone_secondary', 'code',
        'lat', 'long', 'address',
        'teaching_lat', 'teaching_long', 'teaching_address',
        'teaching_method',
        'exper_years', 'salary_month', 'salary_hour', 'age',
        'bio_ar', 'bio_en', 
        'edu_level_id', 'other_edu_level', 
        'edu_type_id', 'other_edu_type', 
        'stage_id', 'other_stage',
        'nationality_id', 'other_nationality',
        'approved',
        // 'country_id', 'city_id',  
        //  'organizayion_gender',
    ];

    protected $dates = ['api_token_create_date', 'api_token_expire_date'];

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

    // get the announced jobs of the announcing organization
    public function job_announces(){
        return $this->hasMany(Job::class);
    }

    // get the jobs that the job seeker(user) applied to it
    public function job_applications(){
        return $this->belongsToMany(Job::class);
    }

    // get the organizations that the job seeker applied to their announced jobs
    public function job_organizations(){
        return $this->belongsToMany(Self::class, 'organization_seeker', 'seeker_id', 'org_id');
    }

    //get the job seekers of specific organization
    public function org_applicants(){
        return $this->belongsToMany(Self::class, 'organization_seeker', 'org_id', 'seeker_id');
    }

    public function ratings(){
        return $this->morphMany(Rating::class, 'rateRef');
    }

    public function saved_jobs(){
        return $this->hasMany(Save::class)->where('saveRef_type', 'App\Models\Job');
    }

    public function saved_bags(){
        return $this->hasMany(Save::class)->where('saveRef_type', 'App\Models\Bag');
    }

    public function saved_teachers(){
        return $this->hasMany(Save::class)->where('saveRef_type', 'App\User');
    }

    public function saves(){
        return $this->morphMany(Save::class, 'saveRef');
    }

    public function rated_teachers(){
        return $this->hasMany(Rating::class)->where('rateRef_type','App\User');
    }

    public function rated_bags(){
        return $this->hasMany(Rating::class)->where('rateRef_type','App\Models\Bag');
    }

    public function document(){
        return $this->morphOne(Document::class, 'doucmentRef');
    }

    public function stage(){
        return $this->belongsTo(Stage::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function materials(){
        return $this->belongsToMany(Material::class)->withPivot('other_material');
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function edu_level(){
        return $this->belongsTo(EduLevel::class);
    }

    public function edu_type(){
        return $this->belongsTo(EduType::class);
    }

    public function nationality(){
        return $this->belongsTo(Nationality::class);
    }

    public function addresses(){
        return $this->hasMany(Address::class);
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }

    public function orders(){
        return $this->hasMany(Order::class)->orderBy('created_at', 'desc');
    }

    public function receipt(){
        return $this->hasOne(BankReceipt::class);
    }
}
