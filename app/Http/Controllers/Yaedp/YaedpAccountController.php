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

        return view('yaedp.account.courses.index');
    }

    public function assignments(){

        return view('yaedp.account.assignments.index');
    }
}
