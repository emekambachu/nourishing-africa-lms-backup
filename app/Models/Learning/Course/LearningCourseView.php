<?php

namespace App\Models\Learning\Course;

use App\Models\Learning\Module\LearningModule;
use App\Models\Learning\Module\LearningModuleView;
use App\Models\YaedpUser;
use Illuminate\Database\Eloquent\Model;

class LearningCourseView extends Model{

    protected $fillable = [
        'user_id',
        'learning_category_id',
        'learning_module_id',
        'learning_course_id',
        'learning_module_view_id',
        'status',
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

    public function learningModuleView(){
        return $this->belongsTo(LearningModuleView::class, 'learning_module_view_id', 'id');
    }

}
