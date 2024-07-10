<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSection4New extends Model
{
    use HasFactory;
  
  protected $fillable = [
        'title',
        'url',
        'image',
      'title1',
        'url1',
        'image1',
      'title2',
        'url2',
        'image2',
           ];
}
