<?php

namespace App\Services\Yaedp;
use App\Models\Yaedp\YaedpGallery;


class YaedpGalleryService 
{
    public static function getAllPhotos(){

        return  new YaedpGallery();
    }


}