<?php

namespace App\Models\Yaedp;

use App\Models\ExportDiagnosticTool\ExportSelectedUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YaedpProductDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'type',
        'yaedp_value_chain_id',
        'source_of_material',
        'originally_produced',
        'nutrition_information_provided',
        'how_to_prepare',
        'weight_per_pack',
        'weight_per_bag',
        'capacity',
        'packaging_method',
        'quantity_available',
        'status',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ExportSelectedUser::class, 'user_id', 'id');
    }

    public function value_chain(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(YaedpValueChain::class, 'yaedp_value_chain_id', 'id');
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(YaedpProductImage::class, 'yaedp_product_detail_id', 'id');
    }

    public function parameter(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(YaedpProductParameter::class, 'yaedp_product_detail_id', 'id');
    }
}
