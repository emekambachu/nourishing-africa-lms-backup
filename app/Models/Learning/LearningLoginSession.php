<?php

namespace App\Models\Learning;

use App\Models\YaedpUser;
use App\Traits\IpTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearningLoginSession extends Model
{
    use IpTrait;

    protected $fillable = [
        'user_id',
		'learning_category_id',
        'email',
        'ip',
        'user_agent',
        'updated_at'
    ];

    public function yaedpUser(){
        $this->belongsTo(YaedpUser::class, 'email', 'email');
    }

}
