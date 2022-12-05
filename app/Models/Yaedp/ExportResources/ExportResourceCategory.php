<?php

namespace App\Models\Yaedp\ExportResources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportResourceCategory extends Model
{
    use HasFactory;
    protected $fillable = [
      'name'
    ];
}
