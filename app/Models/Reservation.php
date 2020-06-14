<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'date', 'time', 'day_duration',
        'student_name', 'birth_date','phone', 
        'email', 'address', 'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
