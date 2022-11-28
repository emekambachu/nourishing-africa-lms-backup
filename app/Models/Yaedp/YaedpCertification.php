<?php

namespace App\Models\Yaedp;

use App\Models\ExportDiagnosticTool\ExportSelectedUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YaedpCertification extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'certificate_number',
        'issuing_organisation',
        'date_issued',
        'valid_to',
    ];

    public function user(){
        $this->belongsTo(ExportSelectedUser::class, 'user_id', 'id');
    }
}
