<?php

namespace App\Models\Learning\Module;

use App\Models\Learning\Assessment\LearningAssessment;
use App\Models\Learning\Assessment\LearningAssignmentQuestion;
use App\Models\Learning\Course\LearningCourse;
use App\Models\Learning\Course\LearningCourseView;
use App\Models\Learning\LearningCategory;
use Illuminate\Database\Eloquent\Model;

class LearningModule extends Model
{
    protected $fillable = [
        'title',
        'number',
        'learning_category_id',
        'image',
        'description',
        'trainers',
        'teaching_methods',
        'start',
        'end',
        'introduction_video',
        'total_courses',
        'sort',
        'visible',
    ];

    public function yaedp_Id(){
        return LearningCategory::where('slug', 'yaedp')->first()->id;
    }

    public function learningAssignments(){
        return $this->hasMany(LearningAssignmentQuestion::class, 'learning_module_id', 'id');
    }
    public function learningCourses(){
        return $this->hasMany(LearningCourse::class, 'learning_module_id', 'id');
    }
    public function learningCourseViews(){
        return $this->hasMany(LearningCourseView::class, 'learning_module_id', 'id');
    }
    public function learningCategory(){
        return $this->belongsTo(LearningCategory::class, 'learning_category_id', 'id');
    }
    public function learningAssessment(){
        return $this->hasOne(LearningAssessment::class, 'learning_module_id', 'id');
    }

    public function nextModule(){
        return self::where('id', '>', $this->id)->orderBy('id','asc')->first();
    }
    public function previousModule(){
        return self::where('id', '<', $this->id)->orderBy('id','desc')->first();
    }
}
