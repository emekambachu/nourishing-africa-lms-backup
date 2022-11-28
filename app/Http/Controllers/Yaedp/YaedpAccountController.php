<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use App\Models\Learning\Course\LearningCourse;
use App\Models\Learning\Course\LearningCourseView;
use App\Models\Learning\Discussion\LearningDiscussion;
use App\Models\Learning\Discussion\LearningDiscussionLike;
use App\Models\Learning\Discussion\LearningDiscussionReply;
use App\Models\Learning\LearningCategory;
use App\Models\Learning\LearningProfileUpdateRequest;
use App\Models\Learning\Module\LearningModule;
use App\Models\Learning\Module\LearningModuleView;
use App\Models\YaedpUser;
use App\Services\AccountSettingsService;
use App\Services\Learning\Account\YaedpAccountService;
use App\Services\Learning\Account\YaedpAssessmentService;
use App\Services\Learning\Account\YaedpDiscussionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class YaedpAccountController extends Controller
{
    public function __construct(){
        $this->middleware('auth:yaedp-users');
    }

    public function yaedpId(){
        return LearningCategory::where('slug', 'yaedp')->first()->id;
    }

    public function dashboard(){

        $data['modules'] = YaedpAccountService::getCategoryModules()->get();
        $data['sumCourses'] = YaedpAccountService::getCategoryModules()->sum('total_courses');
        $data['countCompletedCourses'] = YaedpAccountService::getCompletedCourses()->count();
        $data['startedCourses'] = YaedpAccountService::getStartedCoursesWithLimit(2)->get();
        $data['completedCourseViews'] = YaedpAccountService::getCompletedCourses()->get();
        $data['moduleProgress'] = YaedpAccountService::getModuleProgress();
        $data['moduleAssessments'] = YaedpAssessmentService::getModuleAssessmentsWithLimit(2)->get();

        return view('yaedp.account.index', $data);
    }

    public function modules(){
        $data['modules'] = YaedpAccountService::getCategoryModules()
            ->orderBy('created_at', 'asc')->get();

        return view('yaedp.account.modules', $data);
    }

    public function courses($id){

        $data['module'] = YaedpAccountService::getCategoryModules()
            ->where('id', $id)->first();

        $data['courses'] = YaedpAccountService::getCoursesFromModuleId($id)
            ->orderBy('created_at', 'asc')->get();

        return view('yaedp.account.courses', $data);
    }

    public function course($id){
        // Get current course
        $data['course'] = YaedpAccountService::getCourseById($id);

        //Get Course Discussions
        $data['discussion'] = YaedpDiscussionService::getCourseDiscussions($data['course']->id, $data['course']->learning_module_id)
            ->orderBy('id','desc')->limit(3)->get();

        // Module for this course
        $data['module'] = LearningModule::findOrFail($data['course']->learning_module_id);

        // check if course has been viewed by user
        $viewedCourse = YaedpAccountService::getCourseViewFromUser(Auth::user()->id, $data['course']->id, $data['course']->learning_module_id);

        // check if module has been viewed by user
        $viewedModule = YaedpAccountService::getModuleViewFromUser(Auth::user()->id, $data['course']->learning_module_id);

        // if course has not been viewed, add it before entering course page
        if(!$viewedCourse){
            YaedpAccountService::addCourseViewByUser(Auth::user()->id, $data['course']->id, $data['module']->id);
        }
        if(!$viewedModule){
            YaedpAccountService::addModuleViewByUser(Auth::user()->id, $data['module']->id);
        }

        // Courses trail on sidebar
        $data['courses'] = YaedpAccountService::getCoursesFromModuleId($data['course']->learning_module_id)
            ->orderBy('created_at', 'asc')->get();

        // If module was started by this user
        $data['moduleStartedByUser'] = YaedpAccountService::moduleStartedByUser(Auth::user()->id, $data['course']->learning_module_id);

        return view('yaedp.account.course', $data);
    }

    public function courseComplete($id){

        try {
            $course = YaedpAccountService::getCourseById($id);
            YaedpAccountService::completeCourseViewForUser(Auth::user()->id, $id, $course->learning_module_id);
            return response()->json([
                'success'=>'Success'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success'=>$e->getMessage()
            ]);
        }
    }

    public function downloadCourseDocument($Id, $file_name){
        $file = LearningCourse::where('id', $Id)->firstOrFail();
        $path = public_path(). '/documents/learning/courses/'. $file_name;
        //        return response()->download($path, $document->original_filename, ['Content-Type' => $document->mime]);
        // view in browser
        return response()->file($path, ['Content-Type' => $file->mime]);
    }

    public function faq(){
        return view('yaedp.account.faq');
    }

    public function selfHelp(){
        return view('yaedp.account.self-help-videos');
    }

    public function aboutProgram(){
        return view('yaedp.account.about-program');
    }

    public function showDiscussions($id){
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
                        ])->orderBy('id','desc')->get();

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

        return view('yaedp.account.discussions', compact('course', 'courses', 'module', 'discussion'));
    }

    public function discussion(Request $request){
        $type = $request->type;

        if($type === "comment"){
            LearningDiscussion::create([
                'user_id' => Auth::user()->id,
                'learning_category_id' => $request->learning_category_id,
                'learning_module_id' => $request->learning_module_id,
                'learning_course_id' => $request->learning_course_id,
                'message' => $request->message
            ]);
        }else if($type === "reply" || $type === "direct_comment_reply"){
            LearningDiscussionReply::create([
                'user_id' => Auth::user()->id,
                'learning_discussion_id' => $request->reply_id,
                'message' => $request->message,
                'type' => $type,
                'reply_id' => $request->direct_reply_id,
            ]);
        }

        return response()->json([
            'response'=>'success'
        ]);
    }

    public function likeDiscussion(Request $request){
        $type = $request->type;
        $result = "";

        if($type === "comment"){
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
                }else{
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
        else if($type === "reply"){
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

    public function accountNotifications(){
        return view('yaedp.account.notifications');
    }

    public function accountSettings(){
        return view('yaedp.account.settings.index');
    }

    public function getUpdateRequest(){

        $updateRequest = LearningProfileUpdateRequest::with('yaedp_user')->where([
            ['user_id', Auth::user()->id],
        ])->first();

        if($updateRequest && $updateRequest->approved === 0){
            return response()->json([
                'success' => true,
                'message' => 'pending'
            ]);
        }

        return response()->json([
            'success' => false,
        ]);
    }

    public function submitUpdateProfileRequest(Request $request){
        try {
            // Submit profile request and email request to admin
           AccountSettingsService::submitProfileUpdateRequest($request);
           AccountSettingsService::emailProfileUpdateRequestToAdmin();
           return response()->json([
                'success' => true,
                'message' => 'Update request sent'
           ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }

    }

    public function updateProfile(Request $request){

        // Validate form fields
        $rules = array(
            'surname' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'mobile' => ['nullable', 'min:7'],
            'focus_area' => ['required', 'string'],
            'website' => ['nullable'],
            'linkedin' => ['nullable', 'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'facebook' => ['nullable', 'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'instagram' => ['nullable'],
            'twitter' => ['nullable'],
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                "errors" => $validator->getMessageBag()->toArray()
            ]);
        }

        $input = $request->all();
        $user = YaedpUser::findOrFail(Auth::user()->id);
        $user->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Profile Updated'
        ]);
    }

    public function updateEmail(Request $request){
        // Validate form fields
        $rules = array(
            'old_email' => ['required', 'email'],
            'new_email' => ['required', 'email'],
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                "errors" => $validator->getMessageBag()->toArray()
            ]);
        }

        $getUsers = new YaedpUser();
        $newEmailInUse = $getUsers->where('email', $request->new_email)->first();
        if($newEmailInUse){
            return response()->json([
                'success' => false,
                'message' => 'New email already in use'
            ]);
        }

        // I can include the verification and user token in the jobs too
        //Generate email verification token
        function verificationToken($length = 11){
            $characters = '0123456789ABCDEFG';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[random_int(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $user = YaedpUser::findOrFail(Auth::user()->id);
        $user->verification_token = verificationToken();
        $user->save();

        Session::put('new_email', $request->new_email); // Add new email to session
        $data['verification_token'] = $user->verification_token;
        $data['email'] = $request->old_email;
        $data['name'] = Auth::user()->surname.' '.Auth::user()->first_name;
        Mail::send('emails.yaedp.email-verification', $data, static function ($message) use ($data) {
            $message->from('yaedp@nourishingafrica.com', 'African Food Changemakers | YAEDP');
            $message->to($data['email'], $data['name']);
            $message->replyTo('yaedp@nourishingafrica.com', 'African Food Changemakers | YAEDP');
            $message->subject('YAEDP | Email verification');
        });

        return response()->json([
            'success' => true,
            'message' => "Email update request has been sent to {$request->old_email}, check email"
        ]);
    }

    public function emailConfirmationToken($token){

        $confirmed = YaedpUser::where('verification_token', $token)->first();

        if($confirmed && Session::has('new_email')){
            $confirmed->email = Session::get('new_email');
            $confirmed->save();
            Session::flash("success", "Email successfully changed, please login");
        }else{
            Session::flash('warning', 'Incorrect or expired verification token, try again.');
        }

        return view('yaedp.email-verification-confirmation');
    }

    public function updatePassword(Request $request){
        // Validate form fields
        $rules = array(
            'old_password' => ['required'],
            'new_password' => ['required'],
            'new_password_confirmation' => ['required'],
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                "errors" => $validator->getMessageBag()->toArray()
            ]);
        }

        if(!Hash::check($request->old_password, Auth::user()->password)) {
            return response()->json([
                'success' => false,
                "message" => 'Old password does not match'
            ]);
        }

        if($request->new_password !== $request->new_password_confirmation) {
            return response()->json([
                'success' => false,
                "message" => 'Password and password confirmation does not match'
            ]);
        }

        $user = YaedpUser::findOrFail(Auth::user()->id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'success' => true,
            "message" => 'Password Updated'
        ]);
    }

    public function unauthorized(){
        return view('yaedp.account.404');
    }
}
