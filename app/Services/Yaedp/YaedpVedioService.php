<?php

namespace App\Services\Yaedp;
use App\Models\Yaedp\YaedpVideo;


class YaedpVedioService 
{
    public static function getAllVedios(){

        return  new YaedpVideo();

    }


}