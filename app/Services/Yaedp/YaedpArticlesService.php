<?php

namespace App\Services\Yaedp;
use App\Models\Yaedp\Article;


class YaedpArticlesService
{

    public static function getAll(){

        return   Article::where('type', '=', 'Yaedp')
        ->where('status', '=', 1)->whereNotNull('image_id');
    }

}