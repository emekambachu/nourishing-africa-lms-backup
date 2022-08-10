<?php

namespace App\Models\ExportDiagnosticTool;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExportDiagnosticQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'export_diagnostic_category_id',
        'question',
        'type',
        'points',
        'sort',
        'conditional',
    ];

    public function export_diagnostic_category(){
        return $this->belongsTo(ExportDiagnosticCategory::class, 'export_diagnostic_category_id', 'id');
    }

    public function export_diagnostic_answer(){
        return $this->hasOne(ExportDiagnosticAnswer::class, 'export_diagnostic_question_id', 'id');
    }

    public function export_diagnostic_options(){
        return $this->hasMany(ExportDiagnosticOption::class, 'export_diagnostic_question_id', 'id');
    }
}
