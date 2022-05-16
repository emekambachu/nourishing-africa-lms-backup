<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use App\Jobs\GeneralEmailJob;
use App\Jobs\SendEmailValidationJob;
use App\Models\Learning\LearningCategory;
use App\Models\Learning\LearningCourse;
use App\Models\Learning\LearningCourseView;
use App\Models\Learning\LearningModule;
use App\Models\Learning\LearningModuleView;
use App\Models\Learning\LearningDiscussion;
use App\Models\Learning\LearningDiscussionReply;
use App\Models\Learning\LearningDiscussionLike;
use App\Models\Learning\LearningProfileUpdateRequest;
use App\Models\YaedpUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use stdClass;

class YaedpAccountController extends Controller
{
    public function __construct(){
        $this->middleware('auth:yaedp-users');
    }

    public function yaedpId(){
        return LearningCategory::where('slug', 'yaedp')->first()->id;
    }

    public function dashboard(){
        $data['getModules'] = new LearningModule();
        $data['modules'] = $data['getModules']->with('learningCourses', 'learningCourseViews')
            ->has('learningCourses')
            ->where('learning_category_id', $this->yaedpId())
            ->latest()->get();

        $data['courses'] = LearningCourse::where('learning_category_id', $this->yaedpId())->get();

        $data['getCourseViews'] = new LearningCourseView();

        $data['countCompletedCourses'] = $data['getCourseViews']
            ->with('learningCourse', 'learningModule')->where([
            ['user_id', Auth::user()->id],
            ['status', 1],
        ])->count();

        $data['startedCourses'] = $data['getCourseViews']
            ->with('learningCourse')->has('learningCourse')
            ->where([
                ['user_id', Auth::user()->id],
            ])->orderBy('id', 'desc')
            ->limit(2)->get();

        $data['completedCourseViews'] = $data['getCourseViews']->where([
            ['user_id', Auth::user()->id],
            ['learning_category_id', $this->yaedpId()],
            ['status', 1]
        ])->get();


        $data['moduleProgress'] = []; // create empty array
        // Loop through modules
        foreach($data['modules'] as $mKey => $mValue){
            // loop through completed courses and get the number
            // of courses that has been completed for each module
            $data['moduleProgress'][$mKey]['count'] = 0; // create count key in loop
            if(count($data['completedCourseViews']) > 0){
                foreach($data['completedCourseViews'] as $cKey => $cValue){
                    if($cValue->learning_module_id === $mValue->id){
                        $data['moduleProgress'][$mKey]['count']++;
                    }
                }
            }

            // After looping the completedCourseViews
            // Assign array names to the percentage, id and name
            // Assign countCourseCompleted variable back to 0
            $data['moduleProgress'][$mKey]['percent'] = ($data['moduleProgress'][$mKey]['count'] / $mValue->learningCourses->count()) * 100;
            $data['moduleProgress'][$mKey]['moduleId'] = $mValue->id;
            $data['moduleProgress'][$mKey]['moduleTitle'] = $mValue->title;
        }

        // Module assessment
        $data['moduleAssessments'] = LearningModuleView::where([
            ['user_id', Auth::user()->id],
            ['status', 1],
            ['learning_category_id', $this->yaedpId()]
        ])->latest()->limit(1)->get();

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
        $course = $data['getCourses']->with('learningModule', 'learning_course_resources')->where([
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
                        ])->orderBy('id','desc')->limit(3)->get();

        $module = LearningModule::findOrFail($course->learning_module_id);

        // Check if course has been started by user
        $viewedCourse = LearningCourseView::where([
                            ['user_id', Auth::user()->id],
                            ['learning_course_id', $course->id],
                            ['learning_module_id', $course->learningModule->id],
                            ['learning_category_id', $course->learningCategory->id],
                        ])->first();

        // Check if module has been started by user
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
            // Once course has been viewed, add it to module view as started
            $viewedModule = new LearningModuleView();
            $viewedModule->user_id = Auth::user()->id;
            $viewedModule->learning_module_id = $course->learningModule->id;
            $viewedModule->learning_category_id = $course->learningCategory->id;
            $viewedModule->save();
        }

        // Courses trail on sidebar
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

        if($type == "comment"){
            LearningDiscussion::create([
                'user_id' => Auth::user()->id,
                'learning_category_id' => $request->learning_category_id,
                'learning_module_id' => $request->learning_module_id,
                'learning_course_id' => $request->learning_course_id,
                'message' => $request->message
            ]);
        }else if($type == "reply" || $type == "direct_comment_reply"){
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

        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        LearningProfileUpdateRequest::create($input);

        // Send email queue to YAEDP admin after submitting update request
        $data['name'] = Auth::user()->surname.' '.Auth::user()->first_name;
        $data['email_body'] = "<strong>{$data['name']}</strong> has sent a YAEDP profile update request.<br>
                                Click <a href=''>here</a> to go to the admin and access it";
        $adminEmails = ['embachu@nourishingafrica.com', 'reyinfunjowo@nourishingafrica.com', 'tkareem@nourishingafrica.com'];
        Mail::send('emails.index', $data, static function ($message) use ($data, $adminEmails) {
            $message->from('yaedp@nourishingafrica.com', 'Nourishing Africa | YAEDP');
            $message->to($adminEmails);
            $message->replyTo('yaedp@nourishingafrica.com', 'Nourishing Africa | YAEDP');
            $message->subject('YAEDP | Update request');
        });

        return response()->json([
            'success' => true,
            'message' => 'Update request sent'
        ]);

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
        //  'old_email' => ['required', 'email', 'exists:yedp_users,email'],
        //  'new_email' => ['required', 'email', 'unique:yedp_users,email'],
            'old_email' => ['required', 'email'],
            'new_email' => ['required', 'email'],
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                'error' => true,
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
        $data['email'] = $request->new_email;
        $data['name'] = Auth::user()->surname.' '.Auth::user()->first_name;
        Mail::send('emails.yaedp.email-verification', $data, static function ($message) use ($data) {
            $message->from('yaedp@nourishingafrica.com', 'Nourishing Africa | YAEDP');
            $message->to($data['email'], $data['name']);
            $message->replyTo('yaedp@nourishingafrica.com', 'Nourishing Africa | YAEDP');
            $message->subject('Email verification');
        });

        return response()->json([
            'success' => true,
            'message' => "Email update request has been sent to {$request->new_email}, check email"
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
}
