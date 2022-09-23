<?php

namespace App\Models\Learning;

use App\Models\Learning\Course\LearningCourse;
use App\Models\Learning\Module\LearningModule;
use Illuminate\Database\Eloquent\Model;

class LearningCategory extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    public function learningModules(){
        return $this->hasMany(LearningModule::class, 'learning_category_id', 'id');
    }
    public function learningCourses(){
        return $this->hasMany(LearningCourse::class, 'learning_category_id', 'id');
    }
}
