<?php

namespace App\Models\Yaedp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YaedpVideo extends Model
{
    use HasFactory;
    protected $fillable = [
      'title',
      'video'
    ];
}
