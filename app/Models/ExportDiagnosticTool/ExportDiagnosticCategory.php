<?php

namespace App\Models\ExportDiagnosticTool;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExportDiagnosticCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sort'
    ];

    public function export_diagnostic_questions(){
        return $this->hasMany(ExportDiagnosticQuestion::class, 'export_diagnostic_category_id', 'id');
    }
}
