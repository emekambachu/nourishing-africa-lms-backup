<?php

namespace App\Models\Yaedp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YaedpGallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'path',
        'image'
    ];
}
