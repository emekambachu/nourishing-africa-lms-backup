<?php

namespace App\Services\Yaedp;
use App\Models\Yaedp\Story;


class YaedpArticlesService
{

    public static function getAll(){

        return   Story::where('type', 'Yaedp');
    }

}