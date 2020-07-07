<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Address extends Model
{
    protected $fillable = ['country_id', 'city_id', 'address', 'postal_code'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
