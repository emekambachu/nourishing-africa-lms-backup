<?php

namespace App\Models\Learning;

use App\Models\YaedpUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningCourseView extends Model{

    protected $fillable = [
        'user_id',
        'learning_category_id',
        'learning_module_id',
        'learning_course_id',
        'started_module',
        'completed_module',
        'started_course',
        'completed_course',
    ];

    public function yaedpUser(){
        return $this->belongsTo(YaedpUser::class, 'user_id', 'id');
    }

    public function learningCourse(){
        return $this->belongsTo(LearningCourse::class, 'learning_course_id', 'id');
    }

    public function learningModule(){
        return $this->belongsTo(LearningModule::class, 'learning_module_id', 'id');
    }

}