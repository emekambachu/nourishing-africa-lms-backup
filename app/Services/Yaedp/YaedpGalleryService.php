<?php

namespace App\Services\Yaedp;
use App\Models\Yaedp\YaedpGallery;


class YaedpGalleryService 
{
    public static function getAllPhotos(){

        return   YaedpGallery::has('images');
    }

    public static function getAllVideos(){

        return   YaedpGallery::has('videos');
    }


}