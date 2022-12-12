<?php

namespace App\Models\Yaedp;

use App\Models\ExportDiagnosticTool\ExportSelectedUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YaedpProductParameter extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'yaedp_value_chain_id',
        'yaedp_product_detail_id',
        'moisture_content',
        'crude_fat',
        'protein_content',
        'oil_content',
        'admixture',
        'ffa',
        'foreign_matters',
        'fibre_content',
        'volatile_oil_content',
        'non_volatile_ether_extract',
        'proximate_content',
        'color',
        'dry_matter',
        'starch_yield',
        'amylose_content',
        'cynanide_content',
        'flour_particle_size',
        'nut_count',
        'kor',
        'defective_nuts',
        'slaty',
        'bean_count',
        'mould',
        'impurity',
        'cluster_bean',
        'broken_beans',
        'float_rate',
        'total_defective_grains',
        'extraneous_matter',
        'split_beans',
        'microbes',
        'aflatoxin',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ExportSelectedUser::class, 'user_id', 'id');
    }

    public function value_chain(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(YaedpValueChain::class, 'yaedp_value_chain_id', 'id');
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(YaedpProductDetail::class, 'yaedp_product_detail_id', 'id');
    }
}
