<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;
    protected $fillable = [
        'size',
        'type',
        
    ];

    public function products(){
        return $this->belongsToMany(Product::class , 'product_product_size')->withPivot('created_at');
    }
  
   public function inventories(){
        return $this->hasMany(Inventory::class);
    }
}
