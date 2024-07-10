<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
  
   protected $fillable = [
        'name',
      'slug',
     'description',
     'short_description',
       'image', 
   
         
      ];
  
   public function blog_categories(){
      return $this->belongsToMany(BlogCategory::class , 'blog_blog_category')->withPivot('created_at');
  }
}
