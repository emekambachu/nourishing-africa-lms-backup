<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class YaedpAccountController extends Controller
{
    public function dashboard(){

        return view('yaedp.account.index');
    }

    public function courses(){

        return view('yaedp.account.course.index');
    }
}
