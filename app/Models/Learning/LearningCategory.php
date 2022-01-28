<?php

namespace App\Models\Learning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function learningModules(){
        return $this->hasMany(LearningModule::class, 'learning_category_id', 'id');
    }
    public function learningCourses(){
        return $this->hasMany(LearningCourse::class, 'learning_category_id', 'id');
    }
}
