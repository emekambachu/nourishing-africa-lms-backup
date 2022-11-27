<?php

namespace App\Models\Yaedp;

use App\Models\ExportDiagnosticTool\ExportSelectedUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YaedpBusinessImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'yaedp_business_detail_id',
        'path',
        'image',
    ];

    public function user(){
        $this->belongsTo(ExportSelectedUser::class, 'user_id', 'id');
    }

    public function business(){
        $this->belongsTo(YaedpBusinessDetail::class, 'yaedp_business_detail_id', 'id');
    }
}
