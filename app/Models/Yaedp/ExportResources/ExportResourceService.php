<?php

namespace App\Models\Yaedp\ExportResources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportResourceService extends Model
{
    use HasFactory;
    protected $fillable = [
        'export_resource_id',
        'name',
        'description',
    ];

    public function export_resource(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ExportResource::class, 'export_resource_id', 'id');
    }
}
