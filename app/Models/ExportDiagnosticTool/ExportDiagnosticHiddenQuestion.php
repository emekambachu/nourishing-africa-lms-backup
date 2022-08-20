<?php

namespace App\Models\ExportDiagnosticTool;

use App\Models\YaedpUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportDiagnosticHiddenQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'yaedp_user_id',
        'export_diagnostic_user_id',
        'export_diagnostic_question_id',
        'export_diagnostic_option_id',
        'questions',
    ];

    public function yaedp_user(){
        return $this->belongsTo(YaedpUser::class, 'yaedp_user_id', 'id');
    }

    public function export_diagnostic_user(){
        return $this->belongsTo(ExportDiagnosticUser::class, 'export_diagnostic_user_id', 'id');
    }

    public function export_diagnostic_question(){
        return $this->belongsTo(ExportDiagnosticQuestion::class, 'export_diagnostic_question_id', 'id');
    }

    public function export_diagnostic_option(){
        return $this->belongsTo(ExportDiagnosticOption::class, 'export_diagnostic_option_id', 'id');
    }
}
