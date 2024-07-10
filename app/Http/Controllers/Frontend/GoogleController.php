<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class GoogleController extends Controller
{
     protected function addSessionCartToDatabaseCart()
{
    // Get the user ID of the currently logged-in user
    $userId = Auth::user()->id;

    // Retrieve the session cart
    $sessionCart = Session::get('cart', []);

    foreach ($sessionCart as $cartItem) {
        // Check if the same product with the same size is in the database cart
       
        $existingCart = Cart::where('user_id', $userId)
            ->where('product_id', $cartItem['product_id'])
            ->where('size', $cartItem['size'])
            ->first();

        if ($existingCart) {
            // If the product exists, update the quantity
            $existingCart->quantity += $cartItem['quantity'];
            $existingCart->save();
        } else {
            // If the product doesn't exist, create a new cart item
            // dd( $cartItem['size']);
            Cart::create([
                'user_id' => $userId,
                'product_id' => $cartItem['product_id'],
                'size' => $cartItem['size'],
                'quantity' => $cartItem['quantity'],
                // You may need to add other fields like 'wishlist' as needed
            ]);
        }
    }

    // Clear the session cart after transferring its contents to the database cart
    Session::forget('cart');
}
  
  
  public function handleGoogleRedirect(){
       
        return Socialite::driver('google')->redirect();
     }
  
     public function handleGoogleCallback(){
       
       try{
         
         $user = Socialite::driver('google')->user();
         //dd($user);
         $existedUser=User::where('email',$user->email)->where('oauth_id',$user->id)->where('oauth_type','google')->first();
         $existedEmail=User::where('email',$user->email)->first();
         $unique_id = User::orderBy('id', 'desc')->first();
        $number = str_replace('BDR','', $unique_id ? $unique_id->unique_id  : 0
    );
    if ($number == 0) {
        $number = 'BDR0000001';
    } else {
        $number = "BDR" . sprintf("%07d", $number + 1);
    }
         
         if($existedUser){
           
           Auth::login($existedUser);
           $this->addSessionCartToDatabaseCart();

           return redirect()->route('cartView');
         }else if($existedEmail){
            Auth::login($existedEmail);
           $this->addSessionCartToDatabaseCart();

           return redirect()->route('cartView');
         }else{
         
         $newUser=User::create([
            'name' => $user->name,
            'email' =>$user->email,
           'is_email_verified'=>1,
           // 'phone' =>$user->phone,
            'unique_id'=>$number,
           'oauth_id'=>$user->id,
           'oauth_type'=>'google',
            'password' => Hash::make($user->id),
        ]);
         
          Auth::login($newUser);
           $this->addSessionCartToDatabaseCart();

           return redirect()->route('cartView');
         }
       }catch(Exception $e){
         
       }
     }
  
   public function handleFacebookRedirect(){
       
        return Socialite::driver('facebook')->redirect();
     }
  
     public function handleFacebookCallback(){
       
       try{
         
         $user = Socialite::driver('facebook')->user();
         //dd($user);
         $existedUser=User::where('email',$user->email)->where('oauth_id',$user->id)->where('oauth_type','facebook')->first();
         $existedEmail=User::where('email',$user->email)->first();
         $unique_id = User::orderBy('id', 'desc')->first();
        $number = str_replace('BDR','', $unique_id ? $unique_id->unique_id  : 0
    );
    if ($number == 0) {
        $number = 'BDR0000001';
    } else {
        $number = "BDR" . sprintf("%07d", $number + 1);
    }
         
         if($existedUser){
           
           Auth::login($existedUser);
           $this->addSessionCartToDatabaseCart();

           return redirect()->route('cartView');
         }else if($existedEmail){
            Auth::login($existedEmail);
           $this->addSessionCartToDatabaseCart();

           return redirect()->route('cartView');
         }else{
         
         $newUser=User::create([
            'name' => $user->name,
            'email' =>$user->email,
         'is_email_verified'=>1,
            'unique_id'=>$number,
           'oauth_id'=>$user->id,
           'oauth_type'=>'google',
            'password' => Hash::make($user->id),
        ]);
         
          Auth::login($newUser);
           $this->addSessionCartToDatabaseCart();

           return redirect()->route('cartView');
         }
       }catch(Exception $e){
         
       }
     }
}
