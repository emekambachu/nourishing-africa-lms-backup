<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Yaedp\YaedpVedioService;

class YaedpVideoController extends Controller
{
    

    public function __construct(YaedpVedioService $yaedpVedio){

        $this->yaedpVedio = $yaedpVedio;
    }

    public function index()
    {
    $data['vedios'] = $this->yaedpVedio->getAllVedios()->latest()->get(); 

    return view('yaedp/media/videos', $data);
    }
}
