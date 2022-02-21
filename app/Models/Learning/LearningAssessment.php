<?php

namespace App\Models\Learning;

use App\Models\YaedpUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningAssessment extends Model
{
    protected $fillable = [
        'user_id',
        'learning_category_id',
        'score',
        'percent',
        'passed',
        'certificate_downloads',
        'certificate_id',
    ];

    public function yaedpUser(){
        return $this->belongsTo(YaedpUser::class, 'user_id', 'id');
    }

    public function learningCategory(){
        return $this->belongsTo(LearningCategory::class, 'learning_category_id', 'id');
    }
}
