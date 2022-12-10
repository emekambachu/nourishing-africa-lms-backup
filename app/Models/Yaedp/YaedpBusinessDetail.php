<?php

namespace App\Models\Yaedp;

use App\Models\ExportDiagnosticTool\ExportSelectedUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YaedpBusinessDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'yaedp_value_chain_id',
        'name',
        'description',
        'date_of_establishment',
        'years_of_operation',
        'physical_address',
        'website',
        'linkedin',
        'facebook',
        'instagram',
        'twitter',
        'staff_size',
        'business_description'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ExportSelectedUser::class, 'user_id', 'id');
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(YaedpBusinessImage::class, 'yaedp_business_detail_id', 'id');
    }

    public function value_chain(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(YaedpValueChain::class, 'yaedp_value_chain_id', 'id');
    }
}
