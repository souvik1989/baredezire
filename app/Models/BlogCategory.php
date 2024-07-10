<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
  
  protected $fillable = [
        'name',
      'slug',
       'image', 
   
         
      ];
  
  public function blogs(){
    return $this->belongsToMany(Blog::class , 'blog_blog_category')->withPivot('created_at');
}
  
}
