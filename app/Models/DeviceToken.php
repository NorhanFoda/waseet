<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class DeviceToken extends Model
{
    protected $fillable = [
        'user_id',
        'token',
        'device_id',
        'platform_type',
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
