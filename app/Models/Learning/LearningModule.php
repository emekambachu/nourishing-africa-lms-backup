<?php

namespace App\Models\Learning;

use Illuminate\Database\Eloquent\Model;

class LearningModule extends Model
{
    protected $fillable = [
        'title',
        'learning_category_id',
        'image',
        'description',
        'trainers',
        'teaching_methods',
        'start',
        'end',
        'sort',
        'visible',
    ];

    public function learningAssignments(){
        return $this->hasMany(LearningAssignmentQuestion::class, 'learning_module_id', 'id');
    }
    public function learningCourses(){
        return $this->hasMany(LearningCourse::class, 'learning_module_id', 'id');
    }
    public function learningCategory(){
        return $this->belongsTo(LearningCategory::class, 'learning_category_id', 'id');
    }

    public function nextModule(){
        return self::where('id', '>', $this->id)->orderBy('id','asc')->first();
    }
    public function previousModule(){
        return self::where('id', '<', $this->id)->orderBy('id','desc')->first();
    }
}
