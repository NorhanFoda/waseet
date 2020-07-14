<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StaticPage;

class Goal extends Model
{
    protected $fillable = ['title_ar', 'title_en', 'text_ar', 'text_en'];

    public function page(){
        return $this->belongsTo(StaticPage::class);
    }
}
