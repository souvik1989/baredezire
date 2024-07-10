<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerImage extends Model
{
   use HasFactory;
    protected $fillable = [
        'banner_image',
        'description',
        'title'
    ];
  
  public function home1_section()
{
    return $this->belongsTo(Home1Section::class);
}
}
