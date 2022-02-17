<?php

namespace App\Models\Learning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LearningDiscussionLike extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "type",
        "learning_course_id",
        "learning_discussion_id",
        "learning_discussion_reply_id",
        "status",
    ];

    public function learningDiscussion(){
        return $this->belongsTo(LearningDiscussion::class, 'learning_discussion_id', 'id');
    }

    public function learningDiscussionReply(){
        return $this->belongsTo(LearningDiscussionReply::class, 'learning_discussion_reply_id', 'id');
    }
    
    public function learningCourse(){
        return $this->belongsTo(LearningCourse::class, 'learning_course_id', 'id');
    }

    public static function check($type, $learning_course_id = 0, $learning_discussion_id = 0, $learning_discussion_reply_id = 0 ){
        $check = 99999;
        if($type == "comment"){
            $check = LearningDiscussionLike::where([
                ['user_id', Auth::user()->id],
                ['type', $type],
                ['learning_course_id', $learning_course_id],
                ['learning_discussion_id', $learning_discussion_id],
                ['status', 1],
            ])->count();
        }
        else if($type == "reply"){
            $check = LearningDiscussionLike::where([
                ['user_id', Auth::user()->id],
                ['type', $type],
                ['learning_course_id', $learning_course_id],
                ['learning_discussion_id', $learning_discussion_id],
                ['learning_discussion_reply_id', $learning_discussion_reply_id],
                ['status', 1],
            ])->count();
        }

        if($check == 1){
            return true;
        }else if($check == 0){
            return false;
        }else{
            return false;
        }
    }
}
