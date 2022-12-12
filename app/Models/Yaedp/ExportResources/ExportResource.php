<?php

namespace App\Models\Yaedp\ExportResources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportResource extends Model
{
    use HasFactory;
    protected $fillable = [
      'export_resource_category_id',
      'website',
      'email',
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ExportResourceCategory::class, 'export_resource_category_id', 'id');
    }

    public function locations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ExportResourceLocation::class, 'export_resource_id', 'id');
    }

    public function services(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ExportResourceService::class, 'export_resource_id', 'id');
    }
}
