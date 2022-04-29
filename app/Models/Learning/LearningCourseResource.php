<?php

namespace App\Models\Learning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningCourseResource extends Model
{
    protected $fillable = [
        'learning_category_id',
        'learning_module_id',
        'learning_course_id',
        'title',
        'document',
        'url',
    ];

    public function learning_course(){
        return $this->belongsTo(LearningCourse::class, 'learning_course_id', 'id');
    }

    public function learning_module(){
        return $this->belongsTo(LearningModule::class, 'learning_module_id', 'id');
    }

    public function learning_category(){
        return $this->belongsTo(LearningCategory::class, 'learning_category_id', 'id');
    }
}
