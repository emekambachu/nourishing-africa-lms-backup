<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use App\Models\Learning\LearningCategory;
use App\Models\Learning\LearningCourse;
use App\Models\Learning\LearningCourseView;
use App\Models\Learning\LearningModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $data['countCompletedCourses'] = LearningCourseView::where([
            ['user_id', Auth::user()->id],
            ['completed_course', 1],
        ])->count();
        $data['startedCourses'] = LearningCourseView::with('learningCourse')->where([
            ['user_id', Auth::user()->id],
            ['started_course', 1],
        ])->orderBy('id', 'asc')->limit(2)->get();

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

        $data['module'] = LearningModule::findOrFail($id);
        $data['getCourses'] = LearningCourse::with('learningModule', 'learningCategory');
        $data['courses'] = $data['getCourses']->where([
            ['learning_module_id', $id],
            ['learning_category_id', $this->yaedpId()],
        ])->orderBy('sort')->get();

        return view('yaedp.account.courses', $data);
    }

    public function course($id){
        $data['getCourses'] = new LearningCourse();

        // Get current course
        $course = $data['getCourses']->with('learningModule')->where([
                                        ['id', $id],
                                        ['learning_category_id', $this->yaedpId()],
                                    ])->first();

        // Check if course has been viewed
        $viewedCourse = LearningCourseView::where([
                            ['user_id', Auth::user()->id],
                            ['learning_course_id', $course->id],
                            ['learning_module_id', $course->learningModule->id],
                            ['learning_category_id', $course->learningCategory->id],
                        ])->first();

        // if course has not been viewed, add it before entering course page
        if(!$viewedCourse){
            $viewedCourse = new LearningCourseView();
            $viewedCourse->user_id = Auth::user()->id;
            $viewedCourse->learning_course_id = $course->id;
            $viewedCourse->learning_module_id = $course->learningModule->id;
            $viewedCourse->learning_category_id = $course->learningCategory->id;
            $viewedCourse->save();
        }


        $courses = $data['getCourses']->with('learningModule')->where([
                ['learning_module_id', $course->learningModule->id],
                ['learning_category_id', $this->yaedpId()],
        ])->orderBy('sort')->get();

        return view('yaedp.account.course', compact('course', 'courses'));
    }

    public function courseComplete($id){
        // Get current course
        $course = LearningCourse::with('learningModule', 'learningCategory')->where([
            ['id', $id],
            ['learning_category_id', $this->yaedpId()],
        ])->first();

        // Check if course has been viewed
        $viewedCourse = LearningCourseView::where([
            ['user_id', Auth::user()->id],
            ['learning_course_id', $id],
            ['learning_module_id', $course->learningModule->id],
            ['learning_category_id', $course->learningCategory->id],
        ])->first();

        // if course has not been viewed, add it before entering course page
        if($viewedCourse){
            $viewedCourse->completed_course = 1;
            $viewedCourse->save();
        }

        return response()->json([
            'success'=>'Success',
        ]);
    }

    public function downloadCourseDocument($Id, $file_name){
        $file = LearningCourse::where('id', $Id)->firstOrFail();
        $path = public_path(). '/documents/learning/courses/'. $file_name;
        //        return response()->download($path, $document->original_filename, ['Content-Type' => $document->mime]);
        // view in browser
        return response()->file($path, ['Content-Type' => $file->mime]);
    }

    public function moduleAssignments(){
        return view('yaedp.account.assignments.index');
    }

    public function moduleAssignment($id){
        return view('yaedp.account.assignments.show');
    }
}
