<?php

namespace App\Models\Learning;

use App\Models\YaedpUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningDocumentUpload extends Model
{
    use HasFactory;
    protected $fillable = [
      'yaedp_user_id',
      'title',
      'document',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(YaedpUser::class, 'yaedp_user_id', 'id');
    }
}
