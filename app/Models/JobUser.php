<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class JobUser extends Model
{
    protected $fillable = [
        'user_id', 'job_id',
    ];
}
