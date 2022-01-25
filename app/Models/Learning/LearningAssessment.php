<?php

namespace App\Models\Learning;

use App\Models\YaedpUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningAssessment extends Model
{
    protected $fillable = [
        'user_id',
        'learning_category_id',
        'learning_module_id',
        'surname',
        'email',
        'first_name',
        'cohort',
        'business',
        'state_of_origin',
        'location',
        'gender',
        'value_chain',
        'focus_area',
        'score'
    ];

    public function yaedpUser(){
        return $this->belongsTo(YaedpUser::class, 'user_id', 'id');
    }
}
