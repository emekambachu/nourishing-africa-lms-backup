<?php

namespace App\Models\Learning;

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
        'trainers',
        'sort',
        'visible',
    ];

    public function learningModule(){
        return $this->belongsTo(LearningModule::class, 'learning_module_id', 'id');
    }

    public function learningCategory(){
        return $this->belongsTo(LearningCategory::class, 'learning_category_id', 'id');
    }

    public function nextCourse(){
        return self::where('id', '>', $this->id)->orderBy('id','asc')->first();
    }

    public function previousCourse(){
        return self::where('id', '<', $this->id)->orderBy('id','desc')->first();
    }
}
