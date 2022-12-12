<?php

namespace App\Models\Yaedp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YaedpGallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
    ];

    public function images(){
        return $this->hasMany(YaedpGalleryImage::class, 'yaedp_gallery_id', 'id');
    }

    public function videos(){
        return $this->hasMany(YaedpGalleryVideo::class, 'yaedp_gallery_id', 'id');
    }
}
