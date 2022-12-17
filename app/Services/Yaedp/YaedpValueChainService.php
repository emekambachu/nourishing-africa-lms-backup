<?php

namespace App\Services\Yaedp;
use App\Models\Yaedp\YaedpValueChain;


class YaedpValueChainService
{
    public function yaedpValueChain(){
        return new YaedpValueChain();
    }

    public function getValuedChainByName($name){
        return $this->yaedpValueChain()->where('name', $name);
    }

}
