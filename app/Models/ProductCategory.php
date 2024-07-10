<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
      'slug',
        'description',
        'parent_id',
       'level', 
       'banner_image', 
       'meta_title',
      'meta_description',
      'meta_tags',
         
      ];

     

    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }

    public function parent()
{
    return $this->belongsTo(ProductCategory::class, 'parent_id');
}
public function products(){
    return $this->belongsToMany(Product::class , 'product_product_category')->withPivot('created_at');
}
  public function filter_categories(){
      return $this->belongsToMany(FilterCategory::class , 'filter_category_product_category')->withPivot('created_at');
  }
}