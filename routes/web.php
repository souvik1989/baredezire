<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\GoogleController;
use App\Http\Controllers\Frontend\PhonepeController;
use App\Http\Controllers\Frontend\SortController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/cache-clear', function () {
    Artisan::call('optimize:clear');
    Artisan::call('view:cache');
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    return 'Cache Cleared';
});
Route::get('/storage-link', function () {
	Artisan::call('storage:link');
    return 'Storage Linked';
});
Route::post('search-product', [DashboardController::class,'searchProductList'])->name('searchlist');
Route::get('/product/share/{id}', [DashboardController::class,'shareProduct'])->name('product.share');
Route::post('return', [DashboardController::class,'returnProduct'])->name('returnProduct');
Route::get('/', [DashboardController::class,'index'])->name('dashboard');
Route::get('products/{slug}', [DashboardController::class,'productDetail'])->name('productDetail');
//Route::get('all-product', [DashboardController::class,'allProduct'])->name('allProduct');
Route::post('payment-response', [PaymentController::class, 'responsePayment'])->name('payment.response');
Route::any('phonepe-response',[PhonepeController::class,'response'])->name('phonepe.response'); 
Route::post('add-to-cart', [CartController::class,'addToCart'])->name('addToCart'); 
Route::get('cart-view', [DashboardController::class,'cartView'])->name('cartView');
Route::post('update-quantity-session', [CartController::class,'updateQuantitySession'])->name('quantity.session');
Route::delete('remove-cart-item/{index}', [CartController::class,'removeCartItem'])->name('removeCartItem');
Route::delete('cart-delete-session', [CartController::class,'removeCartSession'])->name('removeCartSession');

Route::get('terms-conditions', [DashboardController::class,'terms'])->name('terms');
Route::get('privacy-policy', [DashboardController::class,'privacy'])->name('privacy');
Route::get('return-policy', [DashboardController::class,'returnPolicy'])->name('returnPolicy');
Route::get('contact-us', [DashboardController::class,'contactUs'])->name('contactUs');
Route::get('shipping-policy', [DashboardController::class,'shippingPolicy'])->name('shippingPolicy');
Route::get('about-us', [DashboardController::class,'aboutUs'])->name('aboutUs');
Route::get('blogs', [DashboardController::class,'blogs'])->name('blogs');
Route::get('blogs/{slug}', [DashboardController::class,'blogDetails'])->name('blog-details');
Route::get('bloglist/{slug}', [DashboardController::class,'blogCatDetails'])->name('blogcat-details');
//Route::get('category-product/{category}', [DashboardController::class,'catProductDetail'])->name('category-product');
//Route::get('maincategory-product/{category}', [DashboardController::class,'allProductList'])->name('maincategory-product');

Route::get('category/{slug}', [DashboardController::class,'allProductList'])->name('maincategory-product');
Route::get('category/{parent}/{name}', [DashboardController::class,'catProductDetail'])->name('category-product') ;

Route::get('sorting/{category}/{sorting}', [SortController::class,'sorting'])->name('main.sorting');
Route::get('sorting/{parent}/{category}/{sorting}', [SortController::class,'sortingCategory'])->name('category.sorting');
Route::get('fetch-products',[DashboardController::class,'fetchAllFilterProducts'])->name('filter.fetchProducts');
Route::get('fetch-category-products',[DashboardController::class,'fetchCategoryFilterProducts'])->name('filter.cat.fetchProducts');

Route::get('/search', [DashboardController::class,'autocomplete'])->name('autocomplete.search');
Route::post('pincode-check', [DashboardController::class,'pincode'])->name('pincode');
Route::post('email-check', [DashboardController::class,'emailCheck'])->name('emailCheck');
Route::get('login', [LoginController::class,'showLoginForm'])->name('loginForm');
Route::get('forgot-password', [LoginController::class,'showForgetPwdForm'])->name('forgotPwdForm');
Route::post('forget-password', [DashboardController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [DashboardController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [DashboardController::class, 'submitResetPasswordForm'])->name('reset.password.post');
//Route::get('register#tabs-2', [RegisterController::class,'showRegisterForm'])->name('registerForm');
Route::post('register', [RegisterController::class,'creates'])->name('register');
Route::post('login', [LoginController::class,'login'])->name('login');
Route::get('account-verify/{token}', [RegisterController::class, 'verifyAccount'])->name('user.verify'); 

Route::get('auth/google/redirect', [GoogleController::class, 'handleGoogleRedirect'])->name('google.handle'); 
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']); 


Route::get('auth/facebook/redirect', [GoogleController::class, 'handleFacebookRedirect'])->name('facebook.handle'); 
Route::get('auth/facebook/callback', [GoogleController::class, 'handleFacebookCallback']); 

Route::middleware('auth','EmailVerified')->group(function () {
    Route::get('my-profile', [DashboardController::class,'profile'])->name('myProfile');
    Route::get('wishlist', [DashboardController::class,'wishlist'])->name('wishlist');
    Route::get('order-list', [DashboardController::class,'orderlist'])->name('orderlist');
    Route::get('order-detail/{order}', [DashboardController::class,'orderdetail'])->name('orderdetail');
    Route::post('logout',  [LoginController::class,'logout'])->name('logout');
    //Route::get('cart-view', [DashboardController::class,'cartView'])->name('cartView');
    
    Route::post('contact', [DashboardController::class,'saveContactDetail'])->name('contact');
    Route::post('profile-manage', [DashboardController::class,'manageProfile'])->name('profile.update');
    Route::post('password-manage', [DashboardController::class,'managePassword'])->name('password.update');
//Route::post('add-to-cart', [CartController::class,'addToCart'])->name('addToCart');
Route::post('add-to-wish', [CartController::class,'addToWish'])->name('addToWish');
  Route::post('remove-wish', [CartController::class,'removeWish'])->name('removeWish');
Route::post('wish-to-cart', [CartController::class,'wishToCart'])->name('wishToCart');
Route::post('cart-proceed', [CartController::class,'postCart'])->name('postCart');
Route::post('/cart/increase/{cart}', [CartController::class,'increaseQuantity'])->name('cart.increase');
Route::post('/cart/decrease/{cart}', [CartController::class,'decreaseQuantity'])->name('cart.decrease');
Route::post('update-quantity', [CartController::class,'updateQuantity'])->name('update.quantity');
Route::delete('cart-delete', [CartController::class,'removeCart'])->name('removeCart');
Route::delete('cart-item-delete/{cart}', [CartController::class,'removeItem'])->name('removeItem');
Route::post('save-later/{cart}', [CartController::class,'saveLater'])->name('saveLater');
Route::get('ship-address', [CartController::class,'shipAddress'])->name('shipAddress');
Route::post('save-address', [CartController::class,'saveAddress'])->name('saveAddress');
Route::post('payment-mode', [CartController::class,'paymentMode'])->name('paymentMode');
Route::post('initiate-payment', [PaymentController::class, 'initiatePayment'])->name('payment.initiate');  
//Route::post('payment-response', [PaymentController::class, 'responsePayment'])->name('payment.response');  
  
Route::get('payment-modes', [CartController::class,'paymentSelect'])->name('paymentSelect');
Route::post('order-place', [CartController::class,'orderPlace'])->name('orderPlace');
Route::post('cancel-order/{order}', [DashboardController::class,'cancelOrder'])->name('cancel.order');
Route::post('post-review', [DashboardController::class,'postReview'])->name('postReview');
Route::post('coupon', [App\Http\Controllers\Frontend\CouponController::class,'couponCheck'])->name('couponCheck');
Route::post('coupon-remove', [App\Http\Controllers\Frontend\CouponController::class,'couponRemove'])->name('coupon.remove');
Route::post('track', [DashboardController::class,'track'])->name('track');
Route::post('phonepe',[PhonepeController::class,'phonePe'])->name('phonepe.payment');

});
// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('admin')->group(function () {

    Route::get('', [App\Http\Controllers\Admin\DashboardController::class,'dashboard'])->middleware('auth:admin')->name('adminHome');


    Route::namespace('Admin')->group(function () {
        Route::get('login', [App\Http\Controllers\Admin\LoginController::class,'showLoginForm'])->name('admin.login');
        Route::post('login', [App\Http\Controllers\Admin\LoginController::class,'login']);


        // Route::get('forget-password','LoginController@showForgetPasswordForm')->name('forget.password');
        // Route::post('forget-password', 'LoginController@submitForgetPasswordForm')->name('forget.password.submit');
        // Route::get('reset-password/{token}',  'LoginController@showResetPasswordForm')->name('reset.password');
        // Route::post('reset-password','LoginController@submitResetPasswordForm')->name('reset.password.submit');
    });


    Route::namespace('App\Http\Controllers\Admin')->middleware(['auth:admin'])->group(function () {

        Route::post('logout', [App\Http\Controllers\Admin\LoginController::class,'logout'])->name('admin.logout');

        Route::get('changePassword', [App\Http\Controllers\Admin\PasswordController::class,'showChangePassword'])->name('admin.showChangePassword');
        Route::post('changePassword', [App\Http\Controllers\Admin\PasswordController::class,'changePassword'])->name('admin.changeDefaultPassword');


        Route::get('admin-profile', [App\Http\Controllers\Admin\AdminUserController::class,'showAdminProfile'])->name('showAdminProfile');
        Route::post('admin-profile', [App\Http\Controllers\Admin\AdminUserController::class,'changeAdminProfile'])->name('changeAdminProfile');

        Route::resource('siteSetting', SiteSettingController::class);
        Route::put('product-category/status/{product}',[App\Http\Controllers\Admin\ProductCategoryController::class,'status'])->name('category.status');
        Route::resource('product-category', ProductCategoryController::class);
        Route::put('products/status/{product}',[App\Http\Controllers\Admin\ProductController::class,'status'])->name('product.is_featured');
         Route::put('products/featured/{product}',[App\Http\Controllers\Admin\ProductController::class,'changeFeatured'])->name('product.status');
       Route::put('products/offer/{product}',[App\Http\Controllers\Admin\ProductController::class,'changeOffer'])->name('product.is_offer');
        Route::resource('product', ProductController::class);
        Route::delete('remove-product-image',[App\Http\Controllers\Admin\ProductController::class,'removeImage'])->name('product.removeImage');
       Route::put('blog-category/status/{blog}',[App\Http\Controllers\Admin\BlogCategoryController::class,'status'])->name('blogcategory.status');
      Route::resource('blog-category', BlogCategoryController::class);
          Route::put('blog/status/{blog}',[App\Http\Controllers\Admin\BlogController::class,'status'])->name('blog.status');
         Route::put('blog/featured/{blog}',[App\Http\Controllers\Admin\BlogController::class,'changeFeatured'])->name('blog.is_featured');
       Route::put('blog/popular/{blog}',[App\Http\Controllers\Admin\BlogController::class,'changePopular'])->name('blog.is_popular');
       Route::resource('blog', BlogController::class);
       Route::resource('blog-banner', BlogBannerController::class);
       Route::put('filter-category/status/{product}',[App\Http\Controllers\Admin\FilterCategoryController::class,'status'])->name('filter.category.status');
       Route::resource('filter-category', FilterCategoryController::class);
      Route::post('delete-selected-rows', 'ProductCategoryController@deleteSelectedRows')->name('delete-selected-rows');
      
       Route::post('delete-selected-rows-product', 'ProductController@deleteSelectedRows')->name('delete-selected-rows-product');

        Route::resource('color', ColorController::class);
        Route::resource('product-size', ProductSizeController::class);
      Route::resource('page', PageController::class);

 Route::resource('order', OrderController::class);
        Route::put('coupon/status/{coupon}',[App\Http\Controllers\Admin\CouponController::class,'status'])->name('coupon.status');
       Route::resource('coupon', CouponController::class);
      
        Route::get('order/tracking/{order}',[App\Http\Controllers\Admin\OrderController::class,'tracking'])->name('order.tracking');
       Route::patch('order/tracking/{order}',[App\Http\Controllers\Admin\OrderController::class,'trackingPost'])->name('order.track');
       Route::get('order/{orderId}/summary', [App\Http\Controllers\Admin\OrderController::class,'downloadOrderSummary'])
    ->name('order.summary');
        Route::post('order/payment',[App\Http\Controllers\Admin\OrderController::class,'payment'])->name('order.payment');
        Route::post('order/status',[App\Http\Controllers\Admin\OrderController::class,'status'])->name('order.status');
        Route::post('image-upload', [TinymceImageUploadController::class,'uploadImage'])->name('admin.image-upload');
     Route::put('inventory/status/{inventory}',[App\Http\Controllers\Admin\InventoryController::class,'status'])->name('inventory.status');
       
       Route::resource('inventory', InventoryController::class);
        Route::resource('customer', CustomerController::class);
        // Route::resource('siteSetting', 'App\Http\Controllers\Admin\SiteSettingController', [
        //     'names' => 'siteSetting',
        //     'except' => [
        //         'show',
        //         'create',
        //         'store'
        //     ]
        // ]);

        Route::get('menu', 'DashboardController@menu')->name('menu');




        Route::get('menu', 'DashboardController@menu')->name('menu');

        Route::get('contacts', 'DashboardController@contacts')->name('contacts');
        // Route::delete('contact/{id}', 'DashboardController@deleteContact')->name('deleteContact');
        // Route::delete('deleteContacts', 'DashboardController@deleteContacts')->name('deleteContacts');

        // Route::get('contact-detail/{contactDetail}', 'DashboardController@contactDetail')->name('contactDetail');




        Route::resource('homeBanner', 'HomeBannerController', [
            'names' => 'homeBanner',
            'except' => [
                'show',
            ]
        ]);
        Route::patch('banner-status/{homeBanner}', 'HomeBannerController@bannerStatus')->name('homeBanner.status');





        Route::resource('homeSection1', HomeSection1Controller::class);
        // Route::patch('homeSection1-status/{homeSection1}', 'HomeSection\HomeSection1Controller@sectionStatus')->name('homeSection1.status');




        Route::resource('homeSection2', HomeSection2Controller::class, [
            'names' => 'homeSection2',
            'except' => [
                'show',
            ]
        ]);
        // Route::patch('homeSection2-status/{homeSection2}', 'HomeSection\HomeSection2Controller@sectionStatus')->name('homeSection2.status');






        Route::resource('homeSection3', HomeSection3Controller::class, [
            'names' => 'homeSection3',
            'except' => [
                'show',
            ]
        ]);
        // Route::patch('homeSection3-status/{homeSection3}', 'HomeSection\HomeSection3Controller@sectionStatus')->name('homeSection3.status');
        // Route::put('update-title-homeSection3', 'HomeSection\HomeSection3Controller@updateTitle')->name('homeSection3.updateTitle');



        Route::resource('homeSection4', HomeSection4Controller::class, [
            'names' => 'homeSection4',
            'except' => [
                'show',
                
            ]
        ]);





        Route::resource('homeSection5', HomeSection5Controller::class, [
            'names' => 'homeSection5',
            'except' => [
                'show',
            ]
        ]);
        // Route::patch('homeSection5-status/{homeSection5}', 'HomeSection\HomeSection5Controller@sectionStatus')->name('homeSection5.status');
        // Route::put('update-title-homeSection5', 'HomeSection\HomeSection5Controller@updateTitle')->name('homeSection5.updateTitle');




        Route::resource('homeSection6', HomeSection6Controller::class, [
            'names' => 'homeSection6',
            'except' => [
                'show',
            ]
        ]);
        // Route::patch('homeSection6-status/{homeSection6}', 'HomeSection\HomeSection6Controller@sectionStatus')->name('homeSection6.status');
        // Route::put('update-title-homeSection6', 'HomeSection\HomeSection6Controller@updateTitle')->name('homeSection6.updateTitle');




        Route::resource('homeSection7', HomeSection7Controller::class, [
            'names' => 'homeSection7',
            'except' => [
                'show',
               
            ]
        ]);

        Route::resource('homeSection8', HomeSection8Controller::class, [
            'names' => 'homeSection8',
            'except' => [
                'show',
               
            ]
        ]);


        // Route::get('homeSection8', 'HomeSection\HomeSection8Controller@index')->name('homeSection8.index');
        // Route::put('update-title-homeSection8', 'HomeSection\HomeSection8Controller@updateTitle')->name('homeSection8.updateTitle');




        Route::resource('homeSection9', HomeSection9Controller::class, [
            'names' => 'homeSection9',
            'except' => [
                'show',
               
            ]
        ]);
      
      
      Route::resource('homeSectionNew1', HomeSectionNew1Controller::class, [
            'names' => 'homeSectionNew1',
            'except' => [
                'show',
               
            ]
        ]);
      
        Route::resource('homeSectionNew2', HomeSectionNew2Controller::class, [
            'names' => 'homeSectionNew2',
            'except' => [
                'show',
               
            ]
        ]);
        Route::resource('homeSectionNew3', HomeSectionNew3Controller::class, [
            'names' => 'homeSectionNew3',
            'except' => [
                'show',
               
            ]
        ]);
      
       Route::resource('homeSectionNew4', HomeSectionNew4Controller::class, [
            'names' => 'homeSectionNew4',
            'except' => [
                'show',
               
            ]
        ]);
      
       Route::resource('homeSectionNew5', HomeSectionNew5Controller::class, [
            'names' => 'homeSectionNew5',
            'except' => [
                'show',
               
            ]
        ]);
      
           Route::resource('banner',BannerImageController::class);
        Route::patch('banner-status/{banner}', 'BannerImageController@bannerStatus')->name('banner.status');


        // Route::resource('homeSection10', 'HomeSection\HomeSection10Controller', [
        //     'names' => 'homeSection10',
        //     'except' => [
        //         'show',
        //         'create',
        //         'store',
        //         'edit',
        //         'destroy'
        //     ]
        // ]);




        // Route::resource('homeSection11', 'HomeSection\HomeSection11Controller', [
        //     'names' => 'homeSection11',
        //     'except' => [
        //         'show',
        //     ]
        // ]);
        // Route::patch('homeSection11-status/{homeSection11}', 'HomeSection\HomeSection11Controller@sectionStatus')->name('homeSection11.status');
        // Route::put('update-title-homeSection11', 'HomeSection\HomeSection11Controller@updateTitle')->name('homeSection11.updateTitle');







        // Route::resource('homeSection12', 'HomeSection\HomeSection12Controller', [
        //     'names' => 'homeSection12',
        //     'except' => [
        //         'show',
        //     ]
        // ]);
        // Route::patch('homeSection12-status/{homeSection12}', 'HomeSection\HomeSection12Controller@sectionStatus')->name('homeSection12.status');
        // Route::put('update-title-homeSection12', 'HomeSection\HomeSection12Controller@updateTitle')->name('homeSection12.updateTitle');



        // Route::resource('homeSection13', 'HomeSection\HomeSection13Controller', [
        //     'names' => 'homeSection13',
        //     'except' => [
        //         'show',
        //     ]
        // ]);
        // Route::patch('homeSection13-status/{homeSection13}', 'HomeSection\HomeSection13Controller@sectionStatus')->name('homeSection13.status');




        // Route::resource('homeSection14', 'HomeSection\HomeSection14Controller', [
        //     'names' => 'homeSection14',
        //     'except' => [
        //         'show',
        //         'create',
        //         'store',
        //         'edit',
        //         'destroy'
        //     ]
        // ]);

        // Route::resource('homeSection15', 'HomeSection\HomeSection15Controller', [
        //     'names' => 'homeSection15',
        //     'except' => [
        //         'show',
        //         'create',
        //         'store',
        //         'edit',
        //         'destroy'
        //     ]
        // ]);




        // Route::resource('homeSection16', 'HomeSection\HomeSection16Controller', [
        //     'names' => 'homeSection16',
        //     'except' => [
        //         'show',
        //     ]
        // ]);
        // Route::patch('homeSection16-status/{homeSection16}', 'HomeSection\HomeSection16Controller@sectionStatus')->name('homeSection16.status');
        // Route::put('update-title-homeSection16', 'HomeSection\HomeSection16Controller@updateTitle')->name('homeSection16.updateTitle');


        Route::resource('video-category', 'VideoCategoryController', [
            'names' => 'video-category',
            'except' => [
                'show',
            ]
        ]);
        Route::patch('video-category-status/{category}', 'VideoCategoryController@videoCategoryStatus')->name('video-category.status');
        Route::resource('channel-category', 'ChannelCategoryController', [
            'names' => 'channel-category',
            'except' => [
                'show',
            ]
        ]);
        Route::patch('channel-category-status/{category}', 'ChannelCategoryController@channelCategoryStatus')->name('channel-category.status');



        Route::resource('faq', 'FaqController', [
            'names' => 'faq',
            'except' => [
                'show',
            ]
        ]);
        Route::patch('faq-status/{faq}', 'FaqController@faqStatus')->name('faq.status');
        Route::put('update-faq-text', 'FaqController@textUpdate')->name('faqText.update');



        Route::resource('testimonial', 'TestimonialController', [
            'names' => 'testimonial',
            'except' => [
                'show',
            ]
        ]);
        Route::patch('testimonial-status/{testimonial}', 'TestimonialController@testimonialStatus')->name('testimonial.status');
        Route::put('update-testimonial-text', 'TestimonialController@textUpdate')->name('testimonialText.update');



        Route::resource('socialLink', 'SocialLinkController', [
            'names' => 'socialLink',
            'except' => [
                'show',
            ]
        ]);
        Route::patch('socialLink-status/{socialLink}', 'SocialLinkController@socialLinkStatus')->name('socialLink.status');


    });
});
