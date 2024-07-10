<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterCategory extends Model
{
    use HasFactory;
  
  protected $fillable = [
        'name',
      'slug',
        'parent_id',
       'level', 
         
      ];
  
     public function children()
    {
        return $this->hasMany(FilterCategory::class, 'parent_id');
    }

    public function parent()
{
    return $this->belongsTo(FilterCategory::class, 'parent_id');
}
public function products(){
    return $this->belongsToMany(Product::class , 'filter_category_product')->withPivot('created_at');
}
  public function product_categories(){
    return $this->belongsToMany(ProductCategory::class , 'filter_category_product_category')->withPivot('created_at');
}

}
