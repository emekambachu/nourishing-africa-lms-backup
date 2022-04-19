<?php

namespace App\Models\Learning;

use App\Models\YaedpUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningProfileUpdateRequest extends Model
{
    protected $fillable = [
        'user_id',
        'surname',
        'first_name',
        'mobile',
        'state_residence',
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
