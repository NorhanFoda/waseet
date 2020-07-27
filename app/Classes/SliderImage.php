<?php

namespace App\Classes;
use DB;

class SliderImage{

     static function getPossibleStatuses(){
        $type = DB::select(DB::raw('SHOW COLUMNS FROM images WHERE Field = "type"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        return $values;
    }
}
