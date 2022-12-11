<?php

namespace App\Services\Yaedp;
use App\Models\Yaedp\Article;


class YaedpArticlesService
{

    public static function getAll(){

        return  new Article();
    }

}