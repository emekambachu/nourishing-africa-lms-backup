<?php

namespace App\Models\ExportDiagnosticTool;

use App\Models\YaedpUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExportDiagnosticAnswer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'yaedp_user_id',
        'export_diagnostic_user_id',
        'export_diagnostic_question_id',
        'answer',
        'points',
    ];

    public function user(){
        return $this->belongsTo(YaedpUser::class, 'yaedp_user_id', 'id');
    }

    public function export_diagnostic_user(){
        return $this->belongsTo(ExportDiagnosticUser::class, 'export_diagnostic_user_id', 'id');
    }

    public function export_diagnostic_question(){
        return $this->belongsTo(ExportDiagnosticQuestion::class, 'export_diagnostic_question_id', 'id');
    }

}
