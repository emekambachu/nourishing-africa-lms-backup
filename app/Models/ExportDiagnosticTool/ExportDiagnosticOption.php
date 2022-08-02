<?php

namespace App\Models\ExportDiagnosticTool;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportDiagnosticOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'export_diagnostic_question_id',
        'export_diagnostic_category_id',
        'option',
        'sort',
        'points',
    ];

    public function export_diagnostic_category(){
        return $this->belongsTo(ExportDiagnosticCategory::class, 'export_diagnostic_category_id', 'id');
    }

    public function export_diagnostic_question(){
        return $this->belongsTo(ExportDiagnosticQuestion::class, 'export_diagnostic_question_id', 'id');
    }
}
