<?php

namespace App\Models\ExportDiagnosticTool;

use App\Models\YaedpUser;
use App\Models\Yaedp\YaedpBusinessDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportSelectedUser extends Model
{
    use HasFactory;
    protected $table = 'yaedp_selected_users';

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'business_name',
        'state',
        'gender',
        'value_chain',
        'focus-area'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(YaedpUser::class, 'email', 'email');
    }

    public function business(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(YaedpBusinessDetail::class, 'user_id', 'id');
    }
}
