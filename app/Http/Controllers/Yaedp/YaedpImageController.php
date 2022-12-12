<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use App\Services\Yaedp\YaedpGalleryService;
use Illuminate\Http\Request;

class YaedpImageController extends Controller
{
    public function __construct(YaedpGalleryService $yaedpGallery){

    $this->yaedpGallery = $yaedpGallery;
       }


    public function index()
    {
        $data['photos'] = $this->yaedpGallery->getAllPhotos()->latest()->get();


       // dd($data['photos']);

        return view('yaedp.media.index', $data);
    }
}
