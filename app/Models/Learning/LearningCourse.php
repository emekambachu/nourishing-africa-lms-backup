<?php

namespace App\Models\Learning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningCourse extends Model
{
    protected $fillable = [
        'title',
        'learning_category_id',
        'learning_module_id',
        'image',
        'description',
        'visible',
    ];

    public function learningModule(){
        return $this->belongsTo(LearningModule::class, 'learning_module_id', 'id');
    }

    public function learningCategory(){
        return $this->belongsTo(LearningCategory::class, 'learning_category_id', 'id');
    }
}
