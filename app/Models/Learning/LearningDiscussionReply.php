<?php

namespace App\Models\Learning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningDiscussionReply extends Model
{
    //use HasFactory;

    protected $fillable = [
        'user_id',
        'learning_discussion_id',
        'message',
        'status',
    ];

    public static function getCount($id){
        return count(LearningDiscussionReply::where('learning_discussion_id', $id)->where('status', 1)->get());
    }

    public function learningDiscussion(){
        return $this->belongsTo(LearningDiscussion::class, 'learning_discussion_id', 'id');
    }
}
