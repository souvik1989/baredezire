<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ShipAddress;
use App\Models\Order;
use App\Models\State;
use App\Models\AdminUser;
use App\Models\Coupon;
use DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\orderConfirmAdmin;

class CartController extends Controller
{
public function addToCart(Request $request)
    {
       //dd($request->all());
        if (auth()->check()) {
        $action = $request->input('action');
        if ($action === 'cart') {
            $values = $request->validate([
                "size" => 'required',
                "quantity" => 'required',
                
            ]);
    
            $user=User::find(auth()->user()->id);
            $product=Product::find($request->id);
            if($user->carts->isEmpty()){
                //dd('hi');
                $cart= new Cart();
                $cart->user_id=auth()->user()->id;
                $cart->product_id=$request->id;
                $cart->quantity=$request->quantity;
                $cart->size=$request->size;
                $cart->save();
                // $cart->products()
                // ->sync($product, ['quantity' => $request->quantity]);
           
                }
            
            
        
           else{
          
            
                $cartItem = Cart::where('user_id',auth()->user()->id)->where('product_id',$product->id)->where('size',$request->size)->where('wishlist',0)->first();
                //dd($cartItem);
                if ($cartItem) {
                   
                    // If the product is already in the cart, increase the quantity
                   $cartItem->quantity= $cartItem->quantity+1;
                   $cartItem->save();
                    //$cartItem->pivot->update(['quantity' => $cartItem->pivot->quantity + 1]);
                    
                 
           }
           else {
            // If the product is not in the cart, add it with a quantity of 1
            //$user->carts()->attach($product->id, ['quantity' => 1]);
            $cart= new Cart();
        $cart->user_id=auth()->user()->id;
        $cart->product_id=$request->id;
        $cart->quantity=$request->quantity;
        $cart->size=$request->size;
        $cart->save();
        } 
    }
            //$notify[] = ['success', __('admin_messages.record.add')];
            return redirect()->route('cartView')->with('success', 'Added to the cart successfully!');
        } elseif ($action === 'buy') {
            //dd($request->all());
            $values = $request->validate([
                "size" => 'required',
                "quantity" => 'required',
                
            ]);

            $formData = $request->all();
            session(['form_data' => $formData]);
            return redirect()->route('shipAddress');
        }
        }
        else{
             
              $rules = [
            'id' => 'required', // Add any other validation rules as needed
            'size' => 'required',
            'quantity' => 'required|integer|min:1', // Adjust min value as needed
        ];

        // Validate the input data
        $validatedData = $request->validate($rules);

        $cart = session('cart', []);
        $existingProductIndex = null;

        // Check if the product with the same size is already in the session-based cart
        foreach ($cart as $index => $cartItem) {
            if ($cartItem['product_id'] == $validatedData['id'] && $cartItem['size'] == $validatedData['size']) {
                $existingProductIndex = $index;
                break;
            }
        }

        if ($existingProductIndex !== null) {
            // Product with the same size is already in the cart
            // Update the quantity for the existing product
            $cart[$existingProductIndex]['quantity'] += $validatedData['quantity'];
        } else {
            // Product is not in the cart; add a new item
            $cartItem = [
                'product_id' => $validatedData['id'],
                'size' => $validatedData['size'],
                'quantity' => $validatedData['quantity'],
            ];
            $cart[] = $cartItem;
        }

        // Update the session
        session(['cart' => $cart]);
             
        

        return redirect()->route('cartView')->with('success', 'Added to the cart successfully!');
        }
    } 


             public function increaseQuantity(Cart $cart)
            {
                try{
             
$cart->quantity=$cart->quantity+1;
$cart->save();

           
             return redirect()->back()->with('success', 'Quantity increased successfully!');
            //  return response()->json([
            //     'status' => Response::HTTP_OK,
            //     'product'=> $product,
            //     'product_id'=>$product->id,
            //     'quantity'=>$cart->quantity,
            //     'price'=>$product->original_price,
            //     'message' => 'Quantity increased successfully!',
            // ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => $th->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }
            }

            public function decreaseQuantity(Cart $cart)
            {
                //dd('hi');
                try{
              
                $cart->quantity=$cart->quantity-1;
$cart->save();
                
                
                return redirect()->back()->with('success', 'Quantity decreased successfully!');
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => Response::HTTP_NOT_FOUND,
                    'message' =>  $th->getMessage(),
                ], Response::HTTP_NOT_FOUND);
            }
            }

            public function removeCart()
            {
                try{
              
                $cart=Cart::where('user_id',auth()->user()->id)->where('wishlist',0)->delete();

                
                
                return redirect()->back()->with('success', 'Cart is Empty!');
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => Response::HTTP_NOT_FOUND,
                    'message' =>  $th->getMessage(),
                ], Response::HTTP_NOT_FOUND);
            }
            }

            public function removeItem(Cart $cart)
            {
                try{
              
                $cart->delete();

                
                
                return redirect()->back()->with('success', 'Item is deleted successfully!');
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => Response::HTTP_NOT_FOUND,
                    'message' =>  $th->getMessage(),
                ], Response::HTTP_NOT_FOUND);
            }
            }

            public function saveLater(Cart $cart)
            {
                try{
              
                  
                        $cart->wishlist = 1;
                        $cart->save();
            
                    

                
                
                return redirect()->back()->with('success', 'The product is added to wishlist!');
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => Response::HTTP_NOT_FOUND,
                    'message' =>  $th->getMessage(),
                ], Response::HTTP_NOT_FOUND);
            }
            }

            public function updateQuantity(Request $request)
    {
        try {
        $cart = Cart::find($request->cart_id);
        
            $cart->quantity = $request->quantity;
            $cart->save();
          
            $product=Product::find($cart->product_id);
            return response()->json([
                'status' => Response::HTTP_OK,
                'quantity'=>$request->quantity,
                'price'=>$product->original_price,
                'cart'=>$request->cart_id,
                'message' => 'Quantity is updated!',
            ], Response::HTTP_OK);
        } catch (\Throwable$th) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'Error Occured!',
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function wishToCart(Request $request)
    {
        //dd($request->all());
        $cartItem = Cart::where('user_id',auth()->user()->id)->where('product_id',$request->id)->where('size',$request->size)->where('wishlist',0)->first();
       // dd($cartItem);
        if ($cartItem) {
               
            // If the product is already in the cart, increase the quantity
           $cartItem->quantity= $cartItem->quantity+1;
            
           $cartItem->save();
            //$cartItem->pivot->update(['quantity' => $cartItem->pivot->quantity + 1]);
            
         
   }else{
        $cart = Cart::find($request->cart);
        $cart->wishlist=0;
        $cart->quantity=1;
        $cart->size= $request->size;
        $cart->save();
        //$notify[] = ['success', __('admin_messages.record.add')];
        
    } 
    return redirect()->route('cartView')->with('success', 'Added to the cart successfully!');
}



public function postCart(Request $request)
    {
        //dd($request->all());
     $state=State::where('country_id','101')->get();
        $formData = $request->all();
  //dd($formData);
        session(['form_data' => $formData]);
       
        //return view('frontend.contents.shipAddress',$data); 
    return redirect()->route('shipAddress');
}
// public function showNextView()
// {
//     $formData = session('form_data');
//     return view('next_view', ['formData' => $formData]);
// }
public function shipAddress()
    {
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();

        $data['address']=ShipAddress::where('user_id',auth()->user()->id)->first();
        $formData = session('form_data');
//dd($formData);
        if ($formData && isset($formData['total'])) {
            $data['total'] = $formData['total'];
        } else {
            $data['total'] = 0; // Default value if 'total' index is not set
        }
        if ($formData && isset($formData['discount'])) {
            $data['discount'] = $formData['discount'];
        } else {
            $data['discount'] = 0; // Default value if 'total' index is not set
        }
  if ($formData && isset($formData['offer'])) {
            $data['offer'] = $formData['offer'];
        } else {
            $data['offer'] = 0; // Default value if 'total' index is not set
        }
  if ($formData && isset($formData['offerqty'])) {
            $data['offerqty'] = $formData['offerqty'];
        } else {
            $data['offerqty'] = 0; // Default value if 'total' index is not set
        }
         if ($formData && isset($formData['action'])) {
            $data['action'] = $formData['action'];
        } else {
            $data['action'] = ""; // Default value if 'total' index is not set
        }

        if ($formData && isset($formData['id'])) {
            $data['product'] = $formData['id'];
        } else {
            $data['product'] = ""; // Default value if 'total' index is not set
        }

        if ($formData && isset($formData['size'])) {
            $data['size'] = $formData['size'];
        } else {
            $data['size'] = ""; // Default value if 'total' index is not set
        }


        if ($formData && isset($formData['giftWrap'])) {
            $data['giftWrap'] = $formData['giftWrap'];
        } else {
            $data['giftWrap'] = ""; // Default value if 'total' index is not set
        }
        $data['tax']=ceil((($data['total']- $data['discount'])*5)/100);
   $data['states']=State::where('country_id','101')->get();
  $data['gift_price']=35;
        //dd($data);
        return view('frontend.contents.shipAddress',$data);
}

public function saveAddress(Request $request)
    {
        //dd($request->all());
        $values = $request->validate([
           
            'first_name'=>'required|string|max:500',
            'last_name'=>'required|string|max:500',
            'email'=>'required|email|string|max:60',
            'mobile'=>'required|string|max:60',
            'billing_address_line1'=>'required|string|max:100',
            'billing_address_line2'=>'required|string|max:100',
            'billing_city'=>'required|string|max:100',
            'billing_state'=>'required|string|max:100',
            'billing_zip'=>'required|string|max:100',
            'billing_country'=>'required|string|max:100',
            'shipping_address_line1'=>'required|string|max:100',
            'shipping_address_line2'=>'required|string|max:100',
            'shipping_city'=>'required|string|max:100',
            'shipping_state'=>'required|string|max:100',
            'shipping_zip'=>'required|string|max:100',
            'shipping_country'=>'required|string|max:100',
        ]);
         $address=ShipAddress::where('user_id',auth()->user()->id)->first();
         if($address){
            $address->fill($values);
            $address->save();
            return redirect()->back()->with('success','Addresses Saved Successfully!');
         }else{
            $address=new ShipAddress();
            $address->fill($values);
            $address->user_id=auth()->user()->id;
            $address->save();
            return redirect()->back()->with('success','Addresses Updated Successfully!');
         }
    
}

public function paymentMode(Request $request)
    {
        //dd($request->all());
   $values = $request->validate([
    'shipping_detail' => 'required'
], [
    'shipping_detail.required' => 'Shipping details are required!'
]);
        $data = $request->all();
        session(['form_data' => $data]);
//dd('hi');
        //return view('frontend.contents.shipAddress',$data); 
    return redirect()->route('paymentSelect');
}

public function paymentSelect()
    {
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
         $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();

        $formData = session('form_data');

        if ($formData && isset($formData['total'])) {
            $data['total'] = $formData['total'];
        } else {
            $data['total'] = 0; // Default value if 'total' index is not set
        }
        if ($formData && isset($formData['discount'])) {
            $data['discount'] = $formData['discount'];
        } else {
            $data['discount'] = 0; // Default value if 'total' index is not set
        }
 if ($formData && isset($formData['offer'])) {
            $data['offer'] = $formData['offer'];
        } else {
            $data['offer'] = 0; // Default value if 'total' index is not set
        }
  if ($formData && isset($formData['offerqty'])) {
            $data['offerqty'] = $formData['offerqty'];
        } else {
            $data['offerqty'] = 0; // Default value if 'total' index is not set
        }
 if ($formData && isset($formData['action'])) {
            $data['action'] = $formData['action'];
        } else {
            $data['action'] = ""; // Default value if 'total' index is not set
        }
        if ($formData && isset($formData['product'])) {
            $data['product'] = $formData['product'];
        } else {
            $data['product'] = ""; // Default value if 'total' index is not set
        }

        if ($formData && isset($formData['size'])) {
            $data['size'] = $formData['size'];
        } else {
            $data['size'] = ""; // Default value if 'total' index is not set
        }
        if ($formData && isset($formData['gift'])) {
            $data['giftWrap'] = $formData['gift'];
        } else {
            $data['giftWrap'] = ""; // Default value if 'total' index is not set
        }
        $data['gift_price']=35;
        $data['tax']=ceil((($data['total']- $data['discount'])*5)/100);
        return view('frontend.contents.paymentMode',$data);
}

public function orderPlace(Request $request)
    {
  $admin=AdminUser::first();
       if($request->gross >0){
  if($request->action == 'buy'){
           // dd( $request->all());
            $order=new Order();
        $order->total_price=$request->gross;
        $order->user_id=auth()->user()->id;
        $order->payment_method=$request->payment_method;
    if(!empty($request->buyTwo)){
      $order->buy2get1=$request->buyTwo;
    }
     if (Session::has('coupon')) {
   $order->coupon_code=Session::get('coupon')['name'];
       $order->coupon_dis=$request->coupon_dis;
    $value = Session::get('coupon')['id'];
    $coupon=Coupon::find($value);
         $coupon->count=$coupon->count+1;
       $coupon->save();
    $coupon->users()->sync(auth()->user()->id);
     
     session()->forget('coupon');
     }
        $order->save();
           //$data['order_id']=$order->order_number;
$data['amount']=$request->gross;
           $data['order']=$order;
            $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();  
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
//dd($data);
        $order->products()->attach($request->product, [
            'quantity' => 1,
            'size'=>$request->size,
            'subtotal' => $request->gross,
        ]);
        if($request->payment_method =='cod'){
         // dd($order);
           $datas = [
              'order_no' => $order->order_number,
             'payment_method'=>'Cash on Delivery',
             'status'=>'Pending',
             
          ];


      Mail::to(auth()->user()->email)->send(new orderConfirmAdmin($datas));
      Mail::to($admin->order_email)->send(new orderConfirmAdmin($datas));
        return redirect()->route('orderlist')->with('success','Order Placed Successfully!');
        }else if($request->payment_method =='icici_pay'){
          //dd($data);
            return view('frontend.payment.paymentForm',$data);
        }else{
            return view('frontend.payment.phonepeForm',$data);
        }
        }else{
        $carts=Cart::where('user_id',auth()->user()->id)->where('wishlist',0)->get();
        $order=new Order();
        $order->total_price=$request->gross;
        $order->user_id=auth()->user()->id;
        $order->payment_method=$request->payment_method;
    if(!empty($request->buyTwo)){
      $order->buy2get1=$request->buyTwo;
    }
         if (Session::has('coupon')) {
   $order->coupon_code=Session::get('coupon')['name'];
            $order->coupon_dis=$request->coupon_dis;
    $value = Session::get('coupon')['id'];
    $coupon=Coupon::find($value);
           $coupon->count=$coupon->count+1;
       $coupon->save();
    $coupon->users()->sync(auth()->user()->id);
           
     session()->forget('coupon');
    //dd($value);
} 
        $order->save();
           
      $data['amount']=$request->gross;
           $data['order']=$order;   
            $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();  
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
       foreach ($carts as $cart) {
        $product=Product::find($cart->product_id);
        $order->products()->attach($cart->product_id, [
            'quantity' => $cart->quantity,
            'size'=>$cart->size,
            'subtotal' => $product->original_price*$cart->quantity,
        ]);
    }
    DB::table('carts')->where('user_id', auth()->user()->id)->where('wishlist',0)->delete();
     if($request->payment_method =='cod'){
       //dd($order);
       $datas = [
              'order_no' => $order->order_number,
             'payment_method'=>'Cash on Delivery',
         'status'=>'pending',
             
          ];
       
      Mail::to(auth()->user()->email)->send(new orderConfirmAdmin($datas));
      Mail::to($admin->order_email)->send(new orderConfirmAdmin($datas));
        return redirect()->route('orderlist')->with('success','Order Placed Successfully!');
        }else if($request->payment_method =='icici_pay'){
          //dd($data);
            return view('frontend.payment.paymentForm',$data);
        }else{
            return view('frontend.payment.phonepeForm',$data);
        }
        }
}else{
  return redirect()->back()->with('warning', 'Cannot place an order with a total price of 0.');
}
}

public function addToWish(Request $request)
    {
     
        $product=Product::find($request->id);
        $cartItem = Cart::where('user_id',auth()->user()->id)->where('product_id',$product->id)->where('wishlist',1)->first();
        if ($cartItem) {
                return response()->json([
                'status' => Response::HTTP_OK,
               
                'message' => 'Product is already in Wishlist!',
            ], Response::HTTP_OK);
            
            return redirect()->back()->with('warning', 'Product is already in Wishlist!');  
         
   }else{
    $cart= new Cart();
    $cart->user_id=auth()->user()->id;
    $cart->product_id=$request->id;
    $cart->wishlist=1;
    $cart->save();
     return response()->json([
                'status' => Response::HTTP_OK,
               
                'message' => 'Product is added to Wishlist!',
            ], Response::HTTP_OK);
    return redirect()->back()->with('success', 'Product is added to Wishlist!');  
   }
        
    
        
    } 
  public function removeWish(Request $request)
    {
        //dd($request->all());

        $product=Product::find($request->id);
        $cartItem = Cart::where('user_id',auth()->user()->id)->where('product_id',$product->id)->where('wishlist',1)->first();
        if ($cartItem) {
            
            $cartItem->delete();
                return response()->json([
                'status' => Response::HTTP_OK,
               
                'message' => 'Removed from Wishlist!',
            ], Response::HTTP_OK);
            
            
         
   }else{
   
     return response()->json([
                'status' => Response::HTTP_OK,
               
                'message' => 'Product is not in Wishlist!',
            ], Response::HTTP_OK);
   
   }
        
        
        
    } 

 public function updateQuantitySession(Request $request)
{
    $index = $request->input('index'); // Get the index from the request
    $newQuantity = $request->input('quantity'); // Get the new quantity from the request

    // Retrieve the current session cart
    $cart = session('cart', []);

    if (isset($cart[$index])) {
        // Update the quantity in the cart
        $cart[$index]['quantity'] = $newQuantity;
        session(['cart' => $cart]);

        // Calculate the updated price (if needed)
        // For example:
        // $product = Product::find($cart[$index]['product_id']);
        // $price = $product->original_price * $newQuantity;

        return response()->json([
                'status' => Response::HTTP_OK,
               
                'message' => 'Quantity is updated!',
            ], Response::HTTP_OK);
    }

    return response()->json(['status' => 'error', 'message' => 'Cart item not found.']);
}



public function removeCartItem($index)
{
    // Get the session cart
    $cart = session('cart', []);

    // Check if the item exists in the session cart
    if (isset($cart[$index])) {
        // Remove the item from the session cart
        unset($cart[$index]);

        // Update the session cart
        Session::put('cart', $cart);
    }

    // Redirect back to the cart view or any other appropriate page
    return redirect()->route('cartView')->with('success', 'Item removed from cart.');
}


public function removeCartSession()
{
    // Clear the session-based cart
    Session::forget('cart');

    return redirect()->route('cartView')->with('success', 'Cart is cleared!');
}





}