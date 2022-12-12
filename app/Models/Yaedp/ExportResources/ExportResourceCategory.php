<?php

namespace App\Models\Yaedp\ExportResources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportResourceCategory extends Model
{
    use HasFactory;
    protected $fillable = [
      'name',
      'slug'
    ];

    public function export_resources(){
        return $this->hasMany(ExportResource::class, 'export_resource_category_id', 'id');
    }
}
