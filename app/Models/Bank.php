<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BankReceipt;

class Bank extends Model
{
    protected $fillable = [
        'name_ar', 'name_en', 'account_number', 'iban'
    ];

    public function image(){
        return $this->morphOne(Image::class, 'imageRef');
    }

    public function receipts(){
        return $this->hasMany(BankReceipt::class);
    }
}
