<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Document extends Model
{
    protected $fillable = ['user_id', 'path'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
