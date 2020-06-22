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

    static function uploadVideo($video){
        //Make image name unique
        $full_file_name = $video;
        $file_name = pathinfo($full_file_name, PATHINFO_FILENAME);
        $extension = $video->getClientOriginalExtension();
        $file_name_to_store = $file_name.'_'.time().'.'.$extension;

        //Upload icon
        $path = $video->move(public_path('/videos/'), $file_name_to_store);
        $url = url('/videos/'.$file_name_to_store);
        return $url;
    }

    static function deleteImage($path){
        $file_name = pathinfo($path, PATHINFO_FILENAME);
        $extension = substr($path,strrpos($path,'.'));
        $full_name = $file_name.$extension;
        $file_path = 'images/'.$full_name;
        if(\File::exists($file_path)){
            \File::delete($file_path);
            return true;
        }
        return false;
    }

    static function deleteVideo($path){
        $file_name = pathinfo($path, PATHINFO_FILENAME);
        $extension = substr($path,strrpos($path,'.'));
        $full_name = $file_name.$extension;
        $file_path = 'videos/'.$full_name;
        if(\File::exists($file_path)){
            \File::delete($file_path);
            return true;
        }
        return false;
    }
}