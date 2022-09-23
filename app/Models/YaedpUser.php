<?php

namespace App\Models;

use App\Models\Learning\Assessment\LearningAssessment;
use App\Models\Learning\Course\LearningCourseView;
use App\Models\Learning\LearningDocumentUpload;
use App\Models\Learning\Module\LearningModuleView;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class YaedpUser extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

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

    // for vue.js, Vue.js can't read Camelcase, only snake_case
    public function state_residence(){
        return $this->belongsTo(State::class, 'state_residence', 'id');
    }

    public function stateResidence(){
        return $this->belongsTo(State::class, 'state_residence', 'id');
    }

    // for vue.js, Vue.js can't read Camelcase, only snake_case
    public function state_origin(){
        return $this->belongsTo(State::class, 'state_origin', 'id');
    }

    // for laravel, sometimes laravel can't read snake_case
    public function stateOrigin(){
        return $this->belongsTo(State::class, 'state_origin', 'id');
    }

    public function learningAssessment(){
        return $this->hasOne(LearningAssessment::class, 'user_id', 'id');
    }

    public function learning_assessment(){
        return $this->hasOne(LearningAssessment::class, 'user_id', 'id');
    }

    public function learningModuleAssessments(){
        return $this->hasMany(LearningModuleView::class, 'user_id', 'id');
    }

    public function learning_module_assessments(){
        return $this->hasMany(LearningModuleView::class, 'user_id', 'id');
    }

    public function document_uploads(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LearningDocumentUpload::class, 'yaedp_user_id', 'id');
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
