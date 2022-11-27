<?php

namespace App\Models\Yaedp;

use App\Models\ExportDiagnosticTool\ExportSelectedUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YaedpProductImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'yaedp_product_detail_id',
        'path',
        'image',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ExportSelectedUser::class, 'user_id', 'id');
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(YaedpProductDetail::class, 'yaedp_product_detail_id', 'id');
    }
}
