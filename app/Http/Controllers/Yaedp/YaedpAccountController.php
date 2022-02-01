<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use App\Models\Learning\LearningCategory;
use App\Models\Learning\LearningCourse;
use App\Models\Learning\LearningModule;
use Illuminate\Http\Request;

class YaedpAccountController extends Controller
{
    public function __construct(){
        $this->middleware('auth:yaedp-users');
    }

    public function yaedpId(){
        return LearningCategory::where('slug', 'yaedp')->first()->id;
    }

    public function dashboard(){
        $data['getModules'] = LearningModule::with('learningCourses');
        $data['modules'] = $data['getModules']
            ->where('learning_category_id', $this->yaedpId())->get();
        $data['courses'] = LearningCourse::where('learning_category_id', $this->yaedpId())->get();

        return view('yaedp.account.index', $data);
    }

    public function modules(){
        $data['getModules'] = LearningModule::with('learningCourses');
        $data['modules'] = $data['getModules']
            ->where('learning_category_id', $this->yaedpId())
            ->orderBy('sort', 'asc')->get();

        return view('yaedp.account.modules', $data);
    }

    public function courses($id){
        return view('yaedp.account.courses');
    }

    public function course($id){
        return view('yaedp.account.course');
    }

    public function assignments(){
        return view('yaedp.account.assignments');
    }
}
