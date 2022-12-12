<?php

namespace App\Services\Yaedp;
use App\Models\Yaedp\YaedpValueChain;


class YaedpValuedChainService
{

    public static function getAll(){

        return  new YaedpValueChain();
    }

    public static function getValuedChainByName($name){

        return   YaedpValueChain::where('name',$name);
    }

}