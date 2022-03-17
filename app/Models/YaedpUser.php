<?php

namespace App\Models;

use App\Models\Learning\LearningAssessment;
use App\Models\Learning\LearningCourseView;
use App\Models\Learning\LearningModule;
use App\Models\Learning\LearningModuleView;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class YaedpUser extends Authenticatable
{
    use Notifiable;
    protected $guard = 'yaedp-users';
    protected $table = 'yedp_users';

    protected $fillable = [
        'cohort',
        'surname',
        'first_name',
        'slug',
        'id_card',
        'email',
        'password',
        'mobile',
        'dob',
        'gender',
        'state_origin',
        'state_residence',
        'education_level',
        'registering_as',
        'score',
        'business',
        'busstop_landmark',
        'location',
        'business_address',
        //'business_description',
        'business_running',
        'company_legal',
        'company_type',
        'registration_number',
        'registration_number_doc',
        'business_association',
        'business_association_name',
        'value_chain',
        'focus_area',
        'production_capacity',
        'referred_by',
        'website',
        'facebook',
        'instagram',
        'linkedin',
        'twitter',
        'mark_status',
        'token',
    ];

    public function learningAssessment(){
        return $this->hasOne(LearningAssessment::class, 'user_id', 'id');
    }

    public function learningModuleAssessments(){
        return $this->hasMany(LearningModuleView::class, 'user_id', 'id');
    }

    public static function startedModule($moduleId){
        return LearningModuleView::where([
            ['user_id', Auth::user()->id],
            ['learning_module_id', $moduleId],
        ])->first();
    }

    public static function startedCourse($courseId, $moduleId){
        return LearningCourseView::where([
            ['user_id', Auth::user()->id],
            ['learning_course_id', $courseId],
            ['learning_module_id', $moduleId],
        ])->first();
    }

    public static function getUserFullName($id){
        if($id == 0) return "Admin";
        
        $user = YaedpUser::find($id);
        $firstName = $user->first_name ?? NULL;
        $lastName = $user->surname ?? "Anonymous";
        return $firstName." ".$lastName;
    }

    public static function exhaustedRetakes($moduleId){
        return LearningAssessment::where([
            ['user_id', Auth::user()->id],
            ['learning_module_id', $moduleId],
            ['retake', 2],
        ])->first();
    }
}
