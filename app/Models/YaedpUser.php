<?php

namespace App\Models;

use App\Models\Learning\LearningAssessment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'assignment_total',
        'token'
    ];

    public function learningAssessment(){
        return $this->hasOne(LearningAssessment::class, 'user_id', 'id');
    }
}
