<?php

namespace App\Models\ExportDiagnosticTool;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExportDiagnosticQuestionCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function export_diagnostic_questions(){
        return $this->hasMany(ExportDiagnosticQuestion::class, 'export_diagnostic_question_id', 'id');
    }
}
