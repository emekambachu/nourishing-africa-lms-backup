<?php

namespace App\Models\Learning\Assessment;

use Illuminate\Database\Eloquent\Model;

class LearningAssignmentAnswer extends Model
{
    protected $fillable = [
        'user_id',
        'learning_module_id',
        'learning_category_id',
        'learning_assignment_question_id',
        'answer',
        'passed',
    ];

    public function learningAssignmentsQuestion(){
        return $this->belongsTo(LearningAssignmentQuestion::class, 'learning_assignment_question_id', 'id');
    }
}
