<?php

namespace App\Models\Yaedp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YaedpValueChain extends Model
{
    use HasFactory;
    protected $fillable = [
      'name'
    ];

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(YaedpProductDetail::class, 'yaedp_value_chain_id', 'id');
    }
}
