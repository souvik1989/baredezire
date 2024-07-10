<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\FilterCategory;
use App\Models\Product;
use App\Models\Home1Section;
use App\Models\Home2Section;
use App\Models\Home3Section;
use App\Models\Home4Section;
use App\Models\Home5Section;
use App\Models\Home6Section;
use App\Models\Home7Section;
use App\Models\Home8Section;
use App\Models\Home9Section;
use App\Models\HomeSection1New;
use App\Models\HomeSection2New;
use App\Models\HomeSection3New;
use App\Models\HomeSection4New;
use App\Models\HomeSection5New;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\AdminUser;
use App\Models\Contact;
use App\Models\Pincode;
use App\Models\Page;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogBanner;
use App\Models\EmailCheck;
use App\Models\ShipAddress;
use App\Models\Coupon;
use Illuminate\Support\Facades\Hash;
use DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactDetail;
use App\Mail\ForgetPasswordMail;
use App\Mail\ReturnRequestMail;
use App\Mail\cancelOrderMail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\Review;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
class DashboardController extends Controller
{
    public function index()
    {
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();  
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')->orderBy('name', 'asc')
       ->get();
        $cat1Products = collect();
        $data['section1']= Home1Section::first();
      // $data['content'] = json_decode( $data['section1']->banner_id);
        $data['section2']= Home2Section::first();
        $data['section3']= Home3Section::first();
        $data['section4']= Home4Section::first();
        $data['section5']= Home5Section::first();
        $data['section6']= Home6Section::first();
        $data['section7']= Home7Section::first();
        $data['section8']= Home8Section::first();
        $data['section9']= Home9Section::first();
        $data['section10']= HomeSection1New::all();
       $data['section11']= HomeSection2New::all(); 
      $data['section12']= HomeSection3New::first();
      $data['section13']= HomeSection4New::first();
       $data['section14']= HomeSection5New::first();
        $data['products']=Product::with('product_images')->where('is_featured',0)->where('is_delete','1')->orderBy('created_at', 'DESC')->get();
      if ($mainCategory = ProductCategory::with('children.children.products','filter_categories')->where('name', 'Panties')->first()) {
    foreach ($mainCategory->children as $subCategory) {
        // Check if $subCategory is null
        if ($subCategory) {
            foreach ($subCategory->children as $subSubCategory) {
                // Check if $subSubCategory is null
                if ($subSubCategory) {
                    $cat1Products = $cat1Products->concat($subSubCategory->products->where('is_delete', 1));
                }
            }
        }
    }
}
      
      $data['products2']=$cat1Products;
        
        //dd(  $allProducts);
// $data['main_categories']=ProductCategory::where('level','0')->orderBy('created_at')->get();
// //dd($data['main_categories']);
// $data['filter_categories']=DB::select('select a.name as parent, b.name as child,c.name as subchild from `product_categories` a join `product_categories` b join `product_categories` c where a.id = b.parent_id and b.id=c.parent_id');
// //dd($data['filter_categories']);
// // $sub_catagories = DB::table('books_categories')
// // ->join('sub_catagories','sub_catagories.catId','=','books_categories.catId')->get();

// $data['sub_categories']=ProductCategory::where('level','2')->orderBy('created_at')->get();
        return view('frontend.contents.index',$data);
    } 

//     function buildTree($categories, $parentId = null)
// {
//     $tree = [];

//     foreach ($categories as $category) {
//         if ($category->parent_id === $parentId) {
//             $tree[] = [
//                 'id' => $category->id,
//                 'name' => $category->name,
//                 'children' => buildTree($categories, $category->id),
//             ];
//         }
//     }

//     return $tree;
// }

// $nestedCategories = buildTree($categories);

// return $nestedCategories;
  
   public function terms()
    {
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();  
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();

        $data['terms']= Page::first();
     
        

        return view('frontend.contents.terms',$data);
    } 
  
     public function privacy()
    {
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();  
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();

        $data['privacy']= Page::first();
     
        

        return view('frontend.contents.privacy',$data);
    } 
  
     public function aboutUs()
    {
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();  
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();

        $data['about']= Page::first();
     
        

        return view('frontend.contents.aboutUs',$data);
    } 
     public function shippingPolicy()
    {
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();  
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();

        $data['shipping']= Page::first();
     
        

        return view('frontend.contents.shippingPolicy',$data);
    } 
  
     public function returnPolicy()
    {
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();  
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();

        $data['return']= Page::first();
     
        

        return view('frontend.contents.returnPolicy',$data);
    } 


   public function productDetail($slug)
    {
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
       $data['product']=Product::with('product_images','product_sizes','reviews')->where('is_delete', 1)->where('slug',$slug)->first();
    // dd($data['product']);
       $sumOfRatings = Review::where('product_id', $data['product']->id)->sum('rating');
$revCount=Review::where('product_id',$data['product']->id)->get();
$data['countRatings']=count($revCount);

$data['avgRating']=$data['countRatings']>0? $sumOfRatings/$data['countRatings'] :0;
       $product_categories = $data['product']->product_categories()->pluck('product_category_id');
    // dd($product_categories);
       $data['similar_products'] = Product::whereHas('product_categories', function ($query) use($product_categories) {
        $query->whereIn('product_category_id', $product_categories);
    })->where('status', '1')->with('product_images')->where('slug','!=',$slug)->where('is_delete', 1)->get();
//(  $data['avgRating']);
       $url = route('productDetail', $slug);

    // Generate WhatsApp share link
    $data['whatsappUrl'] = 'https://api.whatsapp.com/send?text=' . urlencode('Check out this product: ' . $url);
     // Generate email share link
    $data['emailLink'] = 
'mailto:RecipientEmailAddress?subject=Checkout this product&body=' . urlencode( $url);
    // Generate Facebook share link
    $data['fbLink'] = 'http://www.facebook.com/sharer/sharer.php?u=' . urlencode($url);

    // Generate Twitter share link
    $data['twLink'] = 'https://twitter.com/intent/tweet?text=' . urlencode('Check out this product: ' . $url);

    // Generate Telegram share link
    $data['tgLink'] =  'https://t.me/share/url?url=' . urlencode($url);
        return view('frontend.contents.product-detail',$data);
    } 

    public function allProduct()
    {
       

        return view('frontend.contents.allproduct');
    } 

   
    public function cartView()
    {
       // $user=User::find(auth()->user()->id);
        $price=0;
        $sell_price=0;
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
      
         if (auth()->check()) {
             $user=User::find(auth()->user()->id);
        $data['carts'] = Cart::where('user_id',auth()->user()->id)->where('wishlist',0)->get();
        foreach( $data['carts'] as $cart){
            $product=Product::find($cart->product_id);
            $price+=$cart->quantity*$product->original_price;
            $sell_price+=$cart->quantity*$product->selling_price;
           $discount=$price-$sell_price;
        }
           } else {
    // If the user is not authenticated, retrieve the session-based cart
    $data['sessionCart'] = session('cart', []);

    // Check if the session cart is not empty before calculating
    if (!empty($data['sessionCart'])) {
        foreach ($data['sessionCart'] as $cartItem) {
            $product = Product::find($cartItem['product_id']);
            $price += $cartItem['quantity'] * $product->original_price;
            $sell_price += $cartItem['quantity'] * $product->selling_price;
            $discount = $price - $sell_price;
            
        }
    }
}
  $data['coupons'] =Coupon::where('status',1)->get();      
$data['price']=$price ?? 0;
$data['discount']=$discount ?? 0;
$data['tax']=ceil((($data['price']-$data['discount'])*5)/100);
$data['percent']=($price!=0)?floor(($discount/$price)*100):00;
//dd($price);
        return view('frontend.contents.cartView',$data);
    } 
    public function profile()
    {
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();

       // $data['wishlists']=Cart::where('user_id',auth()->user()->id)->where('wishlist',1)->get();
//dd( $data['wishlists']);
        return view('frontend.contents.profile',$data);
    } 

    public function catProductDetail($parent,$slug)
    {
       //$name = str_replace(' ', '-', urldecode($name));
     // dd($name);
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
        
      $data['category'] = ProductCategory::where('slug', $slug)->with('filter_categories')->first();
       $filterCategories =  $data['category']->filter_categories;
      //dd($filterCategories);
       $parentCategoriesWithChildren = [];
      foreach ($filterCategories as $filterCategory) {
    // Check if the filter category has a parent
    if ($filterCategory->parent) {
        // Get the parent category name
        $parentCategoryName = $filterCategory->parent->name;

        // Check if the parent category exists in the associative array
        if (!isset($parentCategoriesWithChildren[$parentCategoryName])) {
            // If not, initialize an empty array for the children
            $parentCategoriesWithChildren[$parentCategoryName] = [];
        }

        // Add the current filter category as a child of the parent category
        $parentCategoriesWithChildren[$parentCategoryName][] = $filterCategory;
    }
      }
     // dd($parentCategoriesWithChildren);
$data['categoryProducts'] = Product::whereHas('product_categories', function ($query) use ($slug) {
    $query->where('product_categories.slug', $slug);
})->where('is_delete', 1)->get();
      $filteredCategories = collect([]);
foreach ($data['categoryProducts'] as $product) {
    foreach ($product->filter_categories as $filterCategory) {
        if ($filterCategory->parent) {
          $parentName = optional($filterCategory->parent)->name;
            if ($parentName !== null) {
              
              if (!$filteredCategories->has($parentName)) {
                    $filteredCategories->put($parentName, collect());
                }
                $filteredCategories->get($parentName)->push($filterCategory->name);
            }
        } else {
            $filteredCategories[$filterCategory->name] = [];
        }
    }
}
$data['f_categories'] = FilterCategory::where('status',"1")->orderByDesc('created_at')->get();
//dd($filteredCategories);
$data['filteredCategories'] = $filteredCategories;
 $data['parentCategoriesWithChildren']=$parentCategoriesWithChildren;
//dd($data['filteredCategories']);
    $data['data_count']=$data['categoryProducts']->count();
    $data['section9']= Home9Section::first();
        return view('frontend.contents.productInner',$data);
    } 

   /* public function allProductList($name,$id)
    {
        $allProducts = collect();
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
        
       $data['category']=ProductCategory::find($id);

       $mainCategory = ProductCategory::with('children.children.products')
       ->find($id);
       //dd( $mainCategory);
       foreach ($mainCategory->children as $subCategory) {
    
    
        foreach ($subCategory->children as $subSubCategory) {
            $allProducts = $allProducts->concat($subSubCategory->products->where('is_delete', 1));
        }
    }
$data['allProducts']= $allProducts;
    $data['data_count']=$data['allProducts']->count();
    $data['section9']= Home9Section::first();
        return view('frontend.contents.allproduct',$data);
    } */
  public function allProductList($slug)
{
    $allProducts = collect();
    $data['categories'] = ProductCategory::with(['children' => function ($query) {
        $query->where('status', '1');
    }])->whereNull('parent_id')->where('status', '1')->get();
    $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status', '1')->get();
    $data['mainCategories'] = ProductCategory::with('children.children')->where('level', '0')->where('status', '1')
        ->get();

    $data['category'] = ProductCategory::where('slug',$slug)->first();
$parentCategoriesWithChildren = [];

// Loop through each filter category to categorize them by parent

    // Check if $mainCategory is null
   if ($mainCategory = ProductCategory::with('children.children.products','filter_categories')->where('slug', $slug)->first()) {
    foreach ($mainCategory->children as $subCategory) {
        // Check if $subCategory is null
        if ($subCategory) {
            foreach ($subCategory->children as $subSubCategory) {
                // Check if $subSubCategory is null
                if ($subSubCategory) {
                    $allProducts = $allProducts->concat($subSubCategory->products->where('is_delete', 1));
                }
            }
        }
    }
}
$filterCategories = $mainCategory->filter_categories;
    foreach ($filterCategories as $filterCategory) {
    // Check if the filter category has a parent
    if ($filterCategory->parent) {
        // Get the parent category name
        $parentCategoryName = $filterCategory->parent->name;

        // Check if the parent category exists in the associative array
        if (!isset($parentCategoriesWithChildren[$parentCategoryName])) {
            // If not, initialize an empty array for the children
            $parentCategoriesWithChildren[$parentCategoryName] = [];
        }

        // Add the current filter category as a child of the parent category
        $parentCategoriesWithChildren[$parentCategoryName][] = $filterCategory;
    }
}

    $data['allProducts'] = $allProducts;
    $data['parentCategoriesWithChildren']=$parentCategoriesWithChildren;
    $data['data_count'] = $data['allProducts']->count();
    $data['section9'] = Home9Section::first();
    return view('frontend.contents.allproduct', $data);
}

public function fetchAllFilterProducts(Request $request)
{
      $allProducts = collect();
     $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
    $filterCategoryIds = $request->filter_category_ids;
   $id=$request->category_id;
    $filters = FilterCategory::whereIn('id', $filterCategoryIds)->pluck('name','id');
    $filterForm=FilterCategory::whereIn('id', $filterCategoryIds)->pluck('name')->toArray();
// $filtersQueryString = http_build_query(['filters' => $filterForm]);

    
    $data['selectedQueryNames'] = $filterForm;
   
    $filterCategoryNames = $filters->toArray();

    // Pass the filter category names to the view
    $data['selectedFilterNames'] = $filterCategoryNames;
    // Fetch products based on filter category IDs
    $products = Product::whereHas('filter_categories', function ($query) use ($filterCategoryIds) {
        $query->whereIn('filter_category_id', $filterCategoryIds);
    })->get();
    //dd($products);
     $data['category']=ProductCategory::find($id);
    $mainCategory = ProductCategory::with('children.children.products','filter_categories')
       ->find($id);
   $filterCategories = $mainCategory->filter_categories;


$parentCategoriesWithChildren = [];


foreach ($filterCategories as $filterCategory) {
  
    if ($filterCategory->parent) {
       
        $parentCategoryName = $filterCategory->parent->name;

       
        if (!isset($parentCategoriesWithChildren[$parentCategoryName])) {
          
            $parentCategoriesWithChildren[$parentCategoryName] = [];
        }

       
        $parentCategoriesWithChildren[$parentCategoryName][] = $filterCategory;
    }
}
foreach ($mainCategory->children as $subCategory) {
    foreach ($subCategory->children as $subSubCategory) {
        $subSubCategoryProducts = $subSubCategory->products()->whereHas('filter_categories', function ($query) use ($filterCategoryIds) {
            $query->whereIn('filter_category_id', $filterCategoryIds);
        }, '=', count($filterCategoryIds))->get();
      $uniqueProducts = $subSubCategoryProducts->reject(function ($product) use ($allProducts) {
            return $allProducts->contains('id', $product->id);
        });

        $allProducts = $allProducts->merge($uniqueProducts);
    }
}
//dd($allProducts);
$data['allProducts']= $allProducts;
    $data['data_count']=$data['allProducts']->count();
    $data['section9']= Home9Section::first();
    $data['parentCategoriesWithChildren']=$parentCategoriesWithChildren;
    // Return products as JSON response
   //return response()->json($products);
      return view('frontend.contents.allproduct',$data);
        // return Redirect::route('frontend.contents.allproduct',$data);

}

public function fetchCategoryFilterProducts(Request $request)
{
     $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
    $filterCategoryIds = $request->filter_category_ids;
   $id=$request->category_id;
    $filters = FilterCategory::whereIn('id', $filterCategoryIds)->pluck('name','id');
    $filterForm=FilterCategory::whereIn('id', $filterCategoryIds)->pluck('name')->toArray();
// $filtersQueryString = http_build_query(['filters' => $filterForm]);

    
    $data['selectedQueryNames'] = $filterForm;
   
    $filterCategoryNames = $filters->toArray();

    // Pass the filter category names to the view
    $data['selectedFilterNames'] = $filterCategoryNames;
    // Fetch products based on filter category IDs
   
    //dd($products);
     $data['category']=ProductCategory::with('filter_categories')->find($id);
    
   $filterCategories = $data['category']->filter_categories;


$parentCategoriesWithChildren = [];


foreach ($filterCategories as $filterCategory) {
  
    if ($filterCategory->parent) {
       
        $parentCategoryName = $filterCategory->parent->name;

       
        if (!isset($parentCategoriesWithChildren[$parentCategoryName])) {
          
            $parentCategoriesWithChildren[$parentCategoryName] = [];
        }

       
        $parentCategoriesWithChildren[$parentCategoryName][] = $filterCategory;
    }
}
$categoryProducts = Product::whereHas('product_categories', function ($query) use ($id) {
    $query->where('product_categories.id', $id);
})->whereHas('filter_categories', function ($query) use ($filterCategoryIds) {
    $query->whereIn('filter_category_id', $filterCategoryIds);
}, '=', count($filterCategoryIds))->get();

 $data['categoryProducts'] = $categoryProducts;
     $data['data_count']=$data['categoryProducts']->count();
    $data['section9']= Home9Section::first();
    $data['parentCategoriesWithChildren']=$parentCategoriesWithChildren;
    // Return products as JSON response
   //return response()->json($products);
      return view('frontend.contents.productInner',$data);
        // return Redirect::route('frontend.contents.allproduct',$data);

}
    public function wishlist()
    {
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();

        $data['wishlists']=Cart::where('user_id',auth()->user()->id)->where('wishlist',1)->get();
//dd( $data['wishlists']);
        return view('frontend.contents.wishlist',$data);
    } 


    public function orderlist()
    {
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();

        //$data['orderlists']=Order::where('user_id',auth()->user()->id)->orderByDesc('created_at')->get();
     $data['orderlists'] = Order::where('user_id', auth()->user()->id)
    ->where('total_price', '<>', 0) // Fix the condition here
    ->whereNotIn('payment_status', ['cancelled', 'failed'])
       ->whereHas('products')
    ->orderByDesc('created_at')
    ->get();
//dd( $data['orderlists']);
        return view('frontend.contents.orderList',$data);
    } 
    public function orderdetail(Order $order)
    {
        $price=0;
        $sell_price=0;
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();

        $data['detail']=$order;
       
        foreach( $data['detail']->products as $prod){
            $product=Product::find($prod->id);
            $quantity=$data['detail']->products()
            ->where('products.id', $prod->id)
            ->first()
            ->pivot
            ->quantity;
            $price+=$quantity*$product->original_price;
            $sell_price+=$quantity*($product->selling_price);
           $discount=$price-$sell_price;
        }
      
$data['price']=$price ?? 0;
$data['discount']=$discount ?? 0;
$data['tax']=ceil((($data['price']-$data['discount'])*5)/100);
//dd( $data['wishlists']);
        return view('frontend.contents.orderDetail',$data);
    } 


//     public function autocomplete(Request $request)
// {
//     $search = $request->input('query');
   
//     $products = ProductCategory::where('name', 'LIKE', "%$search%")->where('level','2')
//         ->orWhereHas('products', function ($query) use ($search) {
//             $query->where('name', 'LIKE', "%$search%")->where('status','1');
//         })->where('status','1')
//         ->limit(5)
//         ->get();
// //dd( $products);
//     return response()->json($products);
 
// }

public function autocomplete(Request $request)
    {
        $search = $request->input('query');
   
    $results = [];

    // Search for product categories
    $categories = ProductCategory::where('name', 'LIKE', "%$search%")
        ->where('level', '2')
        ->where('status', '1')
        ->limit(5)
        ->get();

    // Search for products
    $products = Product::where('name', 'LIKE', "%$search%")
        ->where('status', '1')
        ->limit(5)
        ->get();

    // Add the categories and products to the results array
    foreach ($categories as $category) {
        $results[] = [
            'label' => $category->name,
            'type' => 'Category',
            'value' => $category->id,
        ];
    }

    foreach ($products as $product) {
        $results[] = [
            'label' => $product->name,
            'type' => 'Product',
            'value' => $product->id,
        ];
    }

    return response()->json($results);
    }

public function cancelOrder(Request $request,Order $order)
{
  $admin=AdminUser::first();
    $values = $request->validate([
        "notes" => 'nullable|string|max:5000',
        
        
    ]);
    $order->notes=$values['notes'];
    $order->status='cancelled';
    $order->cancelled_at=now();
    $order->payment_status='cancelled';
    $order->save();
  $currentDateTime = Carbon::now();
$formattedDateTime = $currentDateTime->format('jS M, Y h:i A');
  $data = [
              'order_no' => $order->order_number,
    'dates'=>$formattedDateTime,
          ];


      Mail::to(auth()->user()->email)->send(new cancelOrderMail($data));
   Mail::to($admin->order_email)->send(new cancelOrderMail($data));
    return redirect()->back()->with('success', 'Your Ordered is cancelled!');
}
public function contactUs()
{
    $data['categories'] = ProductCategory::with(['children' => function ($query) {
        $query->where('status', '1');
    }])->whereNull('parent_id')->where('status','1')->get();
    $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
    return view('frontend.contents.contact',$data);
}

public function saveContactDetail(Request $request)
{

    $values = $request->validate([
         "name" => "required|string|max:100",
         "subject"=>"required|string",
         "email" => "required|email|max:100",
         'phone'=>'nullable|string|min:10|max:30',
         "message" => "nullable|string|regex:/^[\.\w,!?'\s-]*$/|max:500",
     ]);
     
     
     $contact = new Contact();
     $contact->name = $request->name;
     $contact->email = $request->email;
     $contact->phone = $request->phone;
     $contact->subject= $request->subject;
     $contact->message= $request->message;
     $contact->save();


     
         $admin = AdminUser::first();
         $email_to = $admin->email;
         Mail::to($email_to)->send(new ContactDetail($contact));
     
    

         return redirect()->back()->with('success', 'Thanks for contacting. We will get back to you soon!');
     
}


public function manageProfile(Request $request)
{
    //dd($request->all());

    $values = $request->validate([
        "name" => 'required|string|max:50',
        "email" => "required|email|string|max:60",
         'phone'=>'nullable|string|min:10|max:30',
         'billing_address_line1'=>'nullable|string|max:100',
            'billing_address_line2'=>'nullable|string|max:100',
            'billing_city'=>'nullable|string|max:100',
            'billing_state'=>'nullable|string|max:100',
            'billing_zip'=>'nullable|string|max:100',
            'billing_country'=>'nullable|string|max:100',
        
     ]);
     
     
     $user =User::find(auth()->user()->id);
     $user->name = $request->name;
     $user->email = $request->email;
     $user->phone = $request->phone;
     $user->save();
     
     $address=ShipAddress::where('user_id',auth()->user()->id)->first();
     if(!$address){
         $address2=new ShipAddress();
         $address2->billing_address_line1=$request->billing_address_line1;
         $address2->billing_address_line2=$request->billing_address_line2;
         $address2->billing_city=$request->billing_city;
         $address2->billing_state=$request->billing_state;
         $address2->billing_zip=$request->billing_zip;
         $address2->billing_country=$request->billing_country;
         $address2->user_id=auth()->user()->id;
         $address2->save();
         
     }else{
          $address->billing_address_line1=$request->billing_address_line1;
         $address->billing_address_line2=$request->billing_address_line2;
         $address->billing_city=$request->billing_city;
         $address->billing_state=$request->billing_state;
         $address->billing_zip=$request->billing_zip;
         $address->billing_country=$request->billing_country;
       
         $address->save();
     }
     

         return redirect()->back()->with('success', 'Profile information has been changed succefully!');
     
}


public function managePassword(Request $request)
    {
        $changed = false;
        $values = $request->validate([

            "old_password"=>"required",
            "password"=>"required|min:6|different:old_password",
            "con_password"=>"required|same:password",

        ]);

        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error","Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' =>Hash::make($request->password)
        ]);

        return back()->with("success", "Password changed successfully!");

    }
 public function pincode(Request $request)
    {
        try{
        $values = $request->validate([

            "pincode"=>"required|string",
           

        ]);
        $today = Carbon::now();
        

      $pincode=Pincode::where('pincode',$request->pincode)->first();
      if($pincode){
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Standard delivery by '.$today->addDays(3)->format('jS M, Y'),
        ], Response::HTTP_OK);
      }else{
        return response()->json([
            'status' => Response::HTTP_NOT_FOUND,
            'message' => 'Standard delivery by '.$today->addDays(3)->format('jS M, Y'),
        ], Response::HTTP_OK);
      }
      
    }catch (\Throwable$th) {
        return response()->json([
            'status' => Response::HTTP_NOT_FOUND,
            'message' => 'Error Occured!',
        ], Response::HTTP_NOT_FOUND);
    }
      //dd($pincode);
      

       

    }
    public function emailCheck(Request $request)
    {
       
        $values = $request->validate([

            "email" => "required|email|string|max:60",
           

        ]);

      $email=EmailCheck::where('email',$request->email)->first();
      if($email){
        return back()->with("warning", "Email is already there with us.We will contact with you soon!");
      }else{
        $email= new EmailCheck();
        $email->email=$request->email;
        $email->save();
        return back()->with("success", "Thanks for your response.We will contact with you soon!");
      }
      
    

    }
    
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $user=User::where('email',$request->email)->first();
        //dd($user->user_role_id);
        

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
          ]);
          $data = [
              'token' => $token,
          ];


      Mail::to($request->email)->send(new ForgetPasswordMail($data));

        return redirect()->back()->with('success','We have e-mailed your password reset link!');
    }
    public function showResetPasswordForm($token) {
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
       $data['token']=$token;
       //dd( $data['token']);
        return view('frontend.contents.forgetPasswordLink', $data);
     }

     /**
      * Write code on Method
      *
      * @return response()
      */
     public function submitResetPasswordForm(Request $request)
     {

//dd($request->token);
         $request->validate([
             'email' => 'required|email|exists:users',
             'password' => 'required|string|min:6|confirmed',
             'password_confirmation' => 'required'
         ]);

         $user=User::where('email',$request->email)->first();
        

         $updatePassword = DB::table('password_resets')
                             ->where([
                               'email' => $request->email,
                               'token' => $request->token
                             ])
                             ->first();

         if(!$updatePassword){
             return back()->withInput()->with('error', 'Invalid token!');
         }

         $user = User::where('email', $request->email)
                     ->update(['password' => Hash::make($request->password)]);

         DB::table('password_resets')->where(['email'=> $request->email])->delete();

         return redirect()->route('login')->with('success', 'Your password has been changed!');
     }
     
     
     public function searchProductList(Request $request)
    {
       //$searchWord = $request->input('search');
      // if (is_null($searchWord)) {
        $searchWord = $request->input('search');
    //}

        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
        
       //$data['category']=ProductCategory::find($id);

     //  $mainCategory = ProductCategory::with('children.children.products')
      // ->find($id);
       //dd( $mainCategory);
    //   foreach ($mainCategory->children as $subCategory) {
    
    
    //     foreach ($subCategory->children as $subSubCategory) {
    //         $allProducts = $allProducts->concat($subSubCategory->products);
    //     }
    // }
    $data['searchword']=$searchWord;
$data['allProducts'] = Product::
    where(function($query) use ($searchWord) {
        $query->where('name', 'LIKE', '%' . $searchWord . '%')
              ->orWhere('sku', 'LIKE', '%' . $searchWord . '%');
    })
    ->where('status', '1')
    ->where('is_delete', '1')
    ->get();
    //dd($data['allProducts']);
    $data['data_count']=$data['allProducts']->count();
    $data['section9']= Home9Section::first();
        return view('frontend.contents.search',$data);
    } 

      public function returnProduct(Request $request)
      {
         $order=Order::find($request->id);
         $admin=AdminUser::first();
        
         if($order){
              $data = [
              'name' => auth()->user()->name,
              'order_no'=>$order->order_number ,
              'date'=>$order->updated_at->format('jS M, Y'),
          ];


      Mail::to($admin->email)->send(new ReturnRequestMail($data));

      
         }
          $order->status='return_requested';
       $order->save();
          return redirect()->back()->with('success','We have e-mailed your return request to admin!you will be notified shortly!');
      }
     
     
      public function postReview(Request $request)
     {

//dd($request->all());
         $request->validate([
             'review' => 'required|string|max:255',
             'rating' => 'required',
             
         ]);

       $product_id=$request->id;
        

        $review=Review::where('product_id',$request->id)->where('user_id',auth()->user()->id)->first();
if($review){
    return redirect()->back()->with('warning', 'You have already reviewed the product!');
}else{
    
    $hasProduct = auth()->user()->orders()->whereHas('products', function ($query) use ($product_id) {
        $query->where('products.id', $product_id);
    })->exists();
    if ($hasProduct) {
      $rev=new Review();
      $rev->product_id= $product_id;
      $rev->user_id=auth()->user()->id;
      $rev->review=$request->review;
      $rev->rating=$request->rating;
      $rev->save();
      return redirect()->back()->with('success', 'Product reviewed successfully!');

    } else {
        return redirect()->back()->with('warning', 'You have to buy it to review this product!');
    }

    
         

        
     }

    }
    
      public function track(Request $request)
      {
          $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
        $waybillNumber=$request->tracking_no;
        //dd($waybillNumber);
       
         $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => 'Token 911970bda7864072eb3da20e5896abd36f349932',
    ])->get("https://track.delhivery.com/api/v1/packages/json/?waybill=". $waybillNumber);
//dd( $response->json());
    // Check if the request was successful (status code 200)
    if ($response->successful()) {
        //$dataa = $response->json();
      $data['shipments']= $response->json();
     return view('frontend.contents.track', $data);
    } else {
        // Handle the case where the request was not successful
        $error = $response->json();
        return response()->json(['error' => $error], $response->status());
    }
      }
  
     public function blogs()
    {
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();  
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();

       $data['latest_blogs']=Blog::latest()->take(4)->get();
     $data['category']=BlogBanner::first();
     $data['featured_blogs']=Blog::where('is_featured','0')->take(4)->get();
         $data['popular_blogs']=Blog::where('is_popular','0')->take(4)->get();

        return view('frontend.contents.blogs',$data);
    } 
  
    public function blogDetails(Request $request, $slug)
{
    $data['categories'] = ProductCategory::with(['children' => function ($query) {
        $query->where('status', '1');
    }])->whereNull('parent_id')->where('status', '1')->get();

    $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status', '1')->get();

    $data['mainCategories'] = ProductCategory::with('children.children')
        ->where('level', '0')->where('status', '1')
        ->get();

    $data['blog'] = Blog::where('slug', $slug)->first();

    // Exclude the current blog by adding whereNotIn
    $excludeCurrentBlog = Blog::where('slug', $slug)->pluck('id');

    $data['latest_blogs'] = Blog::whereNotIn('id', $excludeCurrentBlog)
        ->latest()
        ->take(2)
        ->get();

    $data['category'] = BlogBanner::first();
       $data['b_categories']=BlogCategory::orderBy('created_at','desc')->get();
    
    $data['featured_blogs'] = Blog::whereNotIn('id', $excludeCurrentBlog)
        ->where('is_featured', '0')
        ->take(2)
        ->get();

    $data['popular_blogs'] = Blog::whereNotIn('id', $excludeCurrentBlog)
        ->where('is_popular', '0')
        ->take(2)
        ->get();

    return view('frontend.contents.blogDetails', $data);
}
public function blogCatDetails(Request $request, $slug)
{
    $data['categories'] = ProductCategory::with(['children' => function ($query) {
        $query->where('status', '1');
    }])->whereNull('parent_id')->where('status', '1')->get();

    $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status', '1')->get();

    $data['mainCategories'] = ProductCategory::with('children.children')
        ->where('level', '0')->where('status', '1')
        ->get();

   

    // Exclude the current blog by adding whereNotIn
   

    $data['category'] = BlogCategory::where('slug', $slug)->first();
$data['categoryBlogs'] = Blog::whereHas('blog_categories', function ($query) use ($slug) {
    $query->where('blog_categories.slug', $slug);
})->where('status', 1)->get();


    
    
   

    return view('frontend.contents.blogCatDetails', $data);
}
  
   public function shareProduct($id)
{
    // Retrieve product details from the database based on $id
    $product = Product::find($id);

    // Generate shareable link for the product detail page
    $url = route('productDetail', $id);

    // Generate WhatsApp share link
    $whatsappUrl = 'https://api.whatsapp.com/send?text=' . urlencode('Check out this product: ' . $url);

    // You can add similar logic for other social platforms like email, Facebook, Twitter

    return view('product.share', compact('product', 'whatsappUrl'));
}


}