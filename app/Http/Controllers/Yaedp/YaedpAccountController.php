<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use App\Models\Learning\LearningCategory;
use App\Models\Learning\LearningCourse;
use App\Models\Learning\LearningCourseView;
use App\Models\Learning\LearningModule;
use App\Models\Learning\LearningModuleView;
use App\Models\Learning\LearningDiscussion;
use App\Models\Learning\LearningDiscussionReply;
use App\Models\Learning\LearningDiscussionLike;
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
            ['status', 1],
        ])->count();
        $data['startedCourses'] = LearningCourseView::with('learningCourse')->where([
            ['user_id', Auth::user()->id],
            ['status', 0],
        ])->orderBy('id', 'asc')->limit(2)->get();

        return view('yaedp.account.index', $data);
    }

    public function modules(){
        $data['getModules'] = LearningModule::with('learningCourses');
        $data['modules'] = $data['getModules']
            ->where('learning_category_id', $this->yaedpId())
            ->orderBy('created_at', 'asc')->get();

        return view('yaedp.account.modules', $data);
    }

    public function courses($id){
        $data['module'] = LearningModule::findOrFail($id);

        $data['getCourses'] = new LearningCourse();
        $data['courses'] = $data['getCourses']->where([
            ['learning_module_id', $id],
            ['learning_category_id', $this->yaedpId()],
        ])->orderBy('created_at', 'asc')->get();

        return view('yaedp.account.courses', $data);
    }

    public function course($id){
        $data['getCourses'] = new LearningCourse();

        // Get current course
        $course = $data['getCourses']->with('learningModule')->where([
                                        ['id', $id],
                                        ['learning_category_id', $this->yaedpId()],
                                    ])->first();
        
        //Get Course Discussions
        $discussion = LearningDiscussion::with('learningDiscussionReplies')
                        ->where([
                            ['learning_course_id', $course->id],
                            ['learning_module_id', $course->learningModule->id],
                            ['learning_category_id', $course->learningCategory->id],
                            ['status', 1],
                        ])->limit(3)->get();                      

        $module = LearningModule::findOrFail($course->learning_module_id);

        // Check if course has been viewed
        $viewedCourse = LearningCourseView::where([
                            ['user_id', Auth::user()->id],
                            ['learning_course_id', $course->id],
                            ['learning_module_id', $course->learningModule->id],
                            ['learning_category_id', $course->learningCategory->id],
                        ])->first();

        $viewedModule = LearningModuleView::where([
            ['user_id', Auth::user()->id],
            ['learning_module_id', $course->learningModule->id],
            ['learning_category_id', $course->learningCategory->id],
        ])->first();

        // if course has not been viewed, add it before entering course page
        if(!$viewedCourse){
            // Save to course view table
            $viewedCourse = new LearningCourseView();
            $viewedCourse->user_id = Auth::user()->id;
            $viewedCourse->learning_course_id = $course->id;
            $viewedCourse->learning_module_id = $course->learningModule->id;
            $viewedCourse->learning_category_id = $course->learningCategory->id;
            $viewedCourse->save();
        }

        if(!$viewedModule){
            // Save to course view table
            $viewedModule = new LearningModuleView();
            $viewedModule->user_id = Auth::user()->id;
            $viewedModule->learning_module_id = $course->learningModule->id;
            $viewedCourse->learning_category_id = $course->learningCategory->id;
            $viewedCourse->save();
        }

        $courses = $data['getCourses']->with('learningModule')->where([
                ['learning_module_id', $course->learningModule->id],
                ['learning_category_id', $this->yaedpId()],
        ])->orderBy('created_at', 'asc')->get();

        return view('yaedp.account.course', compact('course', 'courses', 'module', 'discussion'));
    }

    public function courseComplete($id){
        // Get current course
        $getModuleCourses = new LearningCourse();

        $course = $getModuleCourses->with('learningModule', 'learningCategory')->where([
            ['id', $id],
            ['learning_category_id', $this->yaedpId()],
        ])->first();

        $getViewedCourses = new LearningCourseView();

        // Check if course has been viewed
        $viewedCourse = $getViewedCourses->where([
            ['user_id', Auth::user()->id],
            ['learning_course_id', $id],
            ['learning_module_id', $course->learning_module_id],
            ['learning_category_id', $course->learning_category_id],
            ['status', 0],
        ])->first();

        // if course has not been viewed, complete the course
        if($viewedCourse){
            $viewedCourse->status = 1;
            $viewedCourse->save();
        }

//      // Get user completed courses for the current module
//        $completedModuleCourses = $getViewedCourses->where([
//            ['user_id', Auth::user()->id],
//            ['learning_module_id', $course->learning_module_id],
//            ['learning_category_id', $course->learning_category_id],
//            ['status', 1],
//        ])->get();
//
//        // Get user courses for the current module
//        $moduleCourses = $getModuleCourses->where([
//            ['learning_module_id', $course->learning_module_id],
//            ['learning_category_id', $course->learning_category_id],
//        ])->get();
//
//        // compare the number of completed courses with the number of courses in the module
//        // if the numbers are equal, update module views to completed
//        if($completedModuleCourses->count() === $moduleCourses->count()){
//            LearningModuleView::update([
//                'user_id' => Auth::user()->id,
//                'learning_module_id' => $course->learning_module_id,
//                'learning_category_id' => $course->learning_category_id,
//                'status' => 1,
//            ]);
//        }

        return response()->json([
            'success'=>'Success'
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

    public function discussion(Request $request){
        $type = $request->type;

        if($type == "comment"){
            LearningDiscussion::create([
                'user_id' => Auth::user()->id,
                'learning_category_id' => $request->learning_category_id,
                'learning_module_id' => $request->learning_module_id,
                'learning_course_id' => $request->learning_course_id,
                'message' => $request->message
            ]);
        }else if($type == "reply"){
            LearningDiscussionReply::create([
                'user_id' => Auth::user()->id,
                'learning_discussion_id' => $request->reply_id,
                'message' => $request->message
            ]);
        }

        return response()->json([
            'response'=>'success'
        ]);
    }

    public function likeDiscussion(Request $request){
        $type = $request->type;
        $result = "";

        if($type == "comment"){
            $check = LearningDiscussionLike::where([
                ['user_id', Auth::user()->id],
                ['type', $request->type],
                ['learning_course_id', $request->learning_course_id],
                ['learning_discussion_id', $request->learning_discussion_id]
            ]);

            if($check->count() == 1){
                if($check->first()->status == 1){
                    LearningDiscussionLike::where([
                        ['user_id', Auth::user()->id],
                        ['type', $request->type],
                        ['learning_course_id', $request->learning_course_id],
                        ['learning_discussion_id', $request->learning_discussion_id]
                    ])->update([
                        'status' => 0
                    ]);

                    $result = "unlike";
                }
                else{
                    LearningDiscussionLike::where([
                        ['user_id', Auth::user()->id],
                        ['type', $request->type],
                        ['learning_course_id', $request->learning_course_id],
                        ['learning_discussion_id', $request->learning_discussion_id]
                    ])->update([
                        'status' => 1
                    ]);
                    $result = "like";
                }
            }
            else if($check->count() == 0){
                LearningDiscussionLike::create([
                    'user_id' => Auth::user()->id,
                    'type' => $request->type,
                    'learning_course_id' => $request->learning_course_id,
                    'learning_discussion_id' => $request->learning_discussion_id,
                    'status' => 1
                ]);
                $result = "like";
            }
        }
        else if($type == "reply"){
            $check = LearningDiscussionLike::where([
                ['user_id', Auth::user()->id],
                ['type', $request->type],
                ['learning_course_id', $request->learning_course_id],
                ['learning_discussion_id', $request->learning_discussion_id],
                ['learning_discussion_reply_id', $request->learning_discussion_reply_id]
            ]);

            if($check->count() == 1){
                if($check->first()->status == 1){
                    LearningDiscussionLike::where([
                        ['user_id', Auth::user()->id],
                        ['type', $request->type],
                        ['learning_course_id', $request->learning_course_id],
                        ['learning_discussion_id', $request->learning_discussion_id],
                        ['learning_discussion_reply_id', $request->learning_discussion_reply_id]
                    ])->update([
                        'status' => 0
                    ]);
                    $result = "unlike";
                }
                else{
                    LearningDiscussionLike::where([
                        ['user_id', Auth::user()->id],
                        ['type', $request->type],
                        ['learning_course_id', $request->learning_course_id],
                        ['learning_discussion_id', $request->learning_discussion_id],
                        ['learning_discussion_reply_id', $request->learning_discussion_reply_id]
                    ])->update([
                        'status' => 1
                    ]);
                    $result = "like";
                }
            }
            else if($check->count() == 0){
                LearningDiscussionLike::create([
                    'user_id' => Auth::user()->id,
                    'type' => $request->type,
                    'learning_course_id' => $request->learning_course_id,
                    'learning_discussion_id' => $request->learning_discussion_id,
                    'learning_discussion_reply_id' => $request->learning_discussion_reply_id,
                    'status' => 1
                ]);
                $result = "like";
            }
        }

        return response()->json([
            'response' => 'success',
            'result' => $result
        ]);
    }
}
