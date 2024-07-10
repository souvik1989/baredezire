<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
        return view('frontend.contents.login',$data);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        $user = User::where('email',request()->email)->first(); // adding code
        if($user){
        if ($user->is_email_verified == 0) {
            
            Auth::logout();
            return redirect("login")->with('warning', 'Your email is not verified. Please check your email for a verification link.');
        }
       }
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
           $this->addSessionCartToDatabaseCart();
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        //$request->session()->invalidate();

        return redirect()->route('dashboard');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    public function showForgetPwdForm()
    {
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
        return view('frontend.contents.forgetPassword',$data);
    }
  
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
}
