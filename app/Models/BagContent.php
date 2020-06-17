<?php

namespace App\MOdels;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bag;

class BagContent extends Model
{
    protected $fillable = ['bag_id', 'path'];

    public function bag(){
        return $this->belongsTo(Bag::class);
    }
}
