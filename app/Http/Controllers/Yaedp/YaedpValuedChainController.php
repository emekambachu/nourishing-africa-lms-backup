<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Yaedp\YaedpValuedChainService;

class YaedpValuedChainController extends Controller
{
    
    public function __construct(YaedpValuedChainService $yaedpValuedChain){

        $this->yaedpValuedChain = $yaedpValuedChain;
    }
}
