<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    
     protected $fillable = [
       'code',
       'type',
      'value', 
      'percent', 
      'image',
       'category' ,
        'min_amount'
        
     ];
     
      public function users()
    {
        return $this->belongsToMany(User::class, 'coupon_user')->withPivot('created_at');
    }
    
    public function findByCode($code)
    {
        return self::where('code',$code)->first();
    }
    
    
     public function discount($total)
    {
        if($this->type == 'amount'){
        return $this->value;
        }elseif($this->type == 'percentage'){
            return ($this->percent/100)* $total;
        }else {
            return 0;
        }
    }
 
}
