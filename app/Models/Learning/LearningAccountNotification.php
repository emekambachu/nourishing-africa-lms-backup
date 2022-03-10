<?php

namespace App\Models\Learning;

use App\Models\YaedpUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningAccountNotification extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'route',
        'title',
        'description',
        'opened'
    ];

    public function user(){
        return $this->belongsTo(YaedpUser::class, 'user_id', 'id');
    }
}
