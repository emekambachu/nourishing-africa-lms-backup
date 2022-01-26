<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class YaedpAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:yaedp-users');
    }

    public function dashboard(){

        return view('yaedp.account.index');
    }

    public function modules(){

        return view('yaedp.account.modules.index');
    }

    public function courses(){

        return view('yaedp.account.modules.courses');
    }

    public function course(){

        return view('yaedp.account.modules.course');
    }

    public function assignments(){

        return view('yaedp.account.modules.assignments');
    }
}
