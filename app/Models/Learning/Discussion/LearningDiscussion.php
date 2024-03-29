<?php

namespace App\Models\Learning\Discussion;

use App\Models\Learning\Course\LearningCourse;
use App\Models\Learning\LearningCategory;
use App\Models\Learning\Module\LearningModule;
use App\Models\YaedpUser;
use Illuminate\Database\Eloquent\Model;

class LearningDiscussion extends Model
{
    protected $fillable = [
        'user_id',
        'learning_category_id',
        'learning_module_id',
        'learning_course_id',
        'message',
        'status',
    ];

    public function yaedpUser(){
        return $this->belongsTo(YaedpUser::class, 'user_id', 'id');
    }

    public function learningCategory(){
        return $this->belongsTo(LearningCategory::class, 'learning_category_id', 'id');
    }

    public function learningModule(){
        return $this->belongsTo(LearningModule::class, 'learning_module_id', 'id');
    }

    public function learningCourse(){
        return $this->belongsTo(LearningCourse::class, 'learning_course_id', 'id');
    }

    public function learningDiscussionReplies(){
        return $this->hasMany(LearningDiscussionReply::class, 'learning_discussion_id', 'id');
    }

    public static function getDiscussionCount($course){
        return LearningDiscussion::where([
                    ['learning_course_id', $course->id],
                    ['learning_module_id', $course->learningModule->id],
                    ['learning_category_id', $course->learningCategory->id],
                    ['status', 1],
                ])->count();
    }
}
