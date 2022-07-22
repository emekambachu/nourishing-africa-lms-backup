<?php

namespace App\Models\Learning;

use App\Models\YaedpUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LearningProfileUpdateRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'learning_category_id',
        'surname',
        'first_name',
        'mobile',
        'state_residence',
        'business',
        'location',
        'business_address',
        'focus_area',
        'value_chain',
        'website',
        'facebook',
        'instagram',
        'linkedin',
        'twitter',
        'reason',
        'approved'
    ];

    public function yaedp_user(){
        return $this->belongsTo(YaedpUser::class, 'user_id', 'id');
    }
}
