<?php

namespace App\Models\Learning;

use App\Models\YaedpUser;
use Illuminate\Database\Eloquent\Model;

class LearningModuleView extends Model
{
    protected $fillable = [
        'user_id',
        'learning_category_id',
        'learning_module_id',
        'status',
        'retake',
        'score',
        'percent',
        'passed',
    ];

    public function yaedpUser(){
        return $this->belongsTo(YaedpUser::class, 'user_id', 'id');
    }

    public function learningModule(){
        return $this->belongsTo(LearningModule::class, 'learning_module_id', 'id');
    }
}
