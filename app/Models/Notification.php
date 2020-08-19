<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Notification extends Model
{
    protected $fillable = [
        'msg_ar', 'user_id', 'read', 'msg_en', 
        // 'image'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
