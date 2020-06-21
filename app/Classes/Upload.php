<?php

namespace App\Classes;

Class Upload{
    static function uploadImage($image){
        //Make image name unique
        $full_file_name = $image;
        $file_name = pathinfo($full_file_name, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();
        $file_name_to_store = $file_name.'_'.time().'.'.$extension;

        //Upload icon
        $path = $image->move(public_path('/images/'), $file_name_to_store);
        $url = url('/images/'.$file_name_to_store);
        return $url;
    }
}