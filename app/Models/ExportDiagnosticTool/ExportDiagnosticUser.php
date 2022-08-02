<?php

namespace App\Models\ExportDiagnosticTool;

use App\Models\YaedpUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExportDiagnosticUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'yaedp_user_id',
        'score',
        'percent',
        'completed'
    ];

    public function user(){
        return $this->belongsTo(YaedpUser::class, 'yaedp_user_id', 'id');
    }

    public function export_diagnostic_answers(){
        return $this->hasMany(ExportDiagnosticAnswer::class, 'yaedp_user_id', 'id');
    }
}
