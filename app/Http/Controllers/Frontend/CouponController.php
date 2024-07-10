<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Order;
use Symfony\Component\HttpFoundation\Response;
class CouponController extends Controller
{
       public function couponCheck(Request $request)
{
    $coupon = Coupon::where('code', $request->code)->first();
    $amt=$coupon->min_amount;
//dd($request->all());
    if (!$coupon) {
        // dd($coupon);
        return redirect()->back()->with('warning', 'Coupon Not Valid 1!');
       
    }
    
    if($coupon->status != 1){
        return redirect()->back()->with('warning', 'Coupon Expired!');
    }
if($coupon->category == 'welcome'){
    $order=Order::where('user_id',auth()->user()->id)->get();
    //dd($order);
    if($order->isEmpty()){
        
        if($amt !== null){
            if($amt>$request->total){
                 return redirect()->back()->with('warning', 'Minimum purchase amount is '.$amt.' to avail this coupon! ');
            }else{
                 session()->put('coupon', [
        'id' => $coupon->id,
        'name' => $coupon->code,
        'discount' => $coupon->discount($request->total),
    ]);
     return redirect()->back()->with('success', 'Coupon Applied successfully1!');
            }
        }else{
             session()->put('coupon', [
        'id' => $coupon->id,
        'name' => $coupon->code,
        'discount' => $coupon->discount($request->total),
    ]);
     return redirect()->back()->with('success', 'Coupon Applied successfully!');
        }
    }else{
         return redirect()->back()->with('warning', 'This coupon is not applicable !');
    }
}else{
    // Check if the current user has already used the coupon
    foreach ($coupon->users as $user) {
        //dd($coupon->users);
        if ($user->id == auth()->user()->id) {
          
            return redirect()->back()->with('warning', 'Coupon Not Valid2!');
        }
    }
    
 if($amt !== null){
            if($amt>$request->total){
                 return redirect()->back()->with('warning', 'Minimum purchase amount is '.$amt.' to avail this coupon! ');
            }else{
                 session()->put('coupon', [
        'id' => $coupon->id,
        'name' => $coupon->code,
        'discount' => $coupon->discount($request->total),
    ]);
     return redirect()->back()->with('success', 'Coupon Applied successfully3!');
            }
        }else{
    session()->put('coupon', [
        'id' => $coupon->id,
        'name' => $coupon->code,
        'discount' => $coupon->discount($request->total),
    ]);

    return redirect()->back()->with('success', 'Coupon Applied successfully4!');
        }
}
}

    
    
     public function couponRemove()
    {try{
         session()->forget('coupon');
         return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Coupon Removed Successfully!',
        ], Response::HTTP_OK);
         
    }catch (\Throwable$th) {
        return response()->json([
            'status' => Response::HTTP_NOT_FOUND,
            'message' => 'Error Occured!',
        ], Response::HTTP_NOT_FOUND);
    }
       
    }
}
