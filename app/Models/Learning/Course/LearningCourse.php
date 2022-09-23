<?php

namespace App\Models\Learning\Course;

use App\Models\Learning\LearningCategory;
use App\Models\Learning\Module\LearningModule;
use Illuminate\Database\Eloquent\Model;

class LearningCourse extends Model
{
    protected $fillable = [
        'title',
        'learning_category_id',
        'learning_module_id',
        'image',
        'video',
        'study_timer',
        'document_one',
        'document_two',
        'description',
        'teaching_methods',
        'trainer',
        'trainer_image',
        'trainer_bio',
        'sort',
        'visible',
    ];

    public function learningModule(){
        return $this->belongsTo(LearningModule::class, 'learning_module_id', 'id');
    }

    public function learningCategory(){
        return $this->belongsTo(LearningCategory::class, 'learning_category_id', 'id');
    }

    public function learning_course_resources(){
        return $this->hasMany(LearningCourseResource::class, 'learning_course_id', 'id');
    }

    public function nextCourse($moduleId){
        return self::where([
            ['id', '>', $this->id],
            ['learning_module_id', '=', $moduleId],
        ])->orderBy('id','asc')->first();
    }

    public function previousCourse($moduleId){
        $previous = self::where([
            ['id', '<', $this->id],
            ['learning_module_id', '=', $moduleId],
        ])->orderBy('id','desc')->first();

        if($previous){
            return $previous;
        }

        return null;
    }
}
