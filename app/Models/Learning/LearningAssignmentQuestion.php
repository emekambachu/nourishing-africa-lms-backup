<?php

namespace App\Models\Learning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningAssignmentQuestion extends Model
{
    protected $fillable = [
        'learning_module_id',
        'learning_category_id',
        'question',
        'question_type',
        'option_one',
        'option_two',
        'option_three',
        'option_four',
        'option_five',
        'option_six',
    ];

    public function learningAssignmentsAnswer(){
        return $this->hasOne(LearningAssignmentAnswer::class, 'learning_assignment_question_id', 'id');
    }

}
