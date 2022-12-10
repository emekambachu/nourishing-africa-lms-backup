<?php

namespace App\Models\Yaedp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YaedpGalleryVideo extends Model
{
    use HasFactory;
    protected $fillable = [
        'yaedp_gallery_id',
        'video',
    ];

    public function yaedp_gallery(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(YaedpGallery::class, 'yaedp_gallery_id', 'id');
    }
}
