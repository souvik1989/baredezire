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

class SortController extends Controller
{
    
    public function sorting(Request $request, $slug, $sorting)
    {
        // Handle sorting logic based on the sorting type
        switch ($sorting) {
            case 'low-to-high':
                $allProducts = collect();
        $filtersQueryString=[];
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
         
           $data['selectedQueryNames'] = $filtersQueryString;
       $data['category']=ProductCategory::where('slug',$slug)->first();

         $mainCategory = ProductCategory::with('children.children.products','filter_categories')
       ->where('slug',$slug)->first();
   $filterCategories = $mainCategory->filter_categories;


$parentCategoriesWithChildren = [];
if($filterCategories !== null){
// Loop through each filter category to categorize them by parent
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
 $data['parentCategoriesWithChildren']=$parentCategoriesWithChildren;
}else{
  $data['parentCategoriesWithChildren']='';
}
       //dd( $mainCategory);
       foreach ($mainCategory->children as $subCategory) {
    
    
        foreach ($subCategory->children as $subSubCategory) {
            $allProducts = $allProducts->concat($subSubCategory->products);
        }
    }
$data['allProducts']= $allProducts->sortBy('selling_price');
    $data['data_count']=$data['allProducts']->count();
    $data['section9']= Home9Section::first();
                break;
            case 'high-to-low':
               $allProducts = collect();
         $filtersQueryString=[];
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
        
           $data['selectedQueryNames'] = $filtersQueryString;
       $data['category']=ProductCategory::where('slug',$slug)->first();

       $mainCategory = ProductCategory::with('children.children.products','filter_categories')
       ->where('slug',$slug)->first();
   $filterCategories = $mainCategory->filter_categories;


$parentCategoriesWithChildren = [];

// Loop through each filter category to categorize them by parent
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

 $data['parentCategoriesWithChildren']=$parentCategoriesWithChildren;
       //dd( $mainCategory);
       foreach ($mainCategory->children as $subCategory) {
    
    
        foreach ($subCategory->children as $subSubCategory) {
            $allProducts = $allProducts->concat($subSubCategory->products);
        }
    }
$data['allProducts']= $allProducts->sortByDesc('selling_price');
    $data['data_count']=$data['allProducts']->count();
    $data['section9']= Home9Section::first();
       
                break;
            case 'new-arrivals':
                 $allProducts = collect();
         $filtersQueryString=[];
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
        
           $data['selectedQueryNames'] = $filtersQueryString;
       $data['category']=ProductCategory::where('slug',$slug)->first();

        $mainCategory = ProductCategory::with('children.children.products','filter_categories')
       ->where('slug',$slug)->first();
   $filterCategories = $mainCategory->filter_categories;


$parentCategoriesWithChildren = [];

// Loop through each filter category to categorize them by parent
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
 $data['parentCategoriesWithChildren']=$parentCategoriesWithChildren;
       //dd( $mainCategory);
       foreach ($mainCategory->children as $subCategory) {
    
    
        foreach ($subCategory->children as $subSubCategory) {
            $allProducts = $allProducts->concat($subSubCategory->products);
        }
    }
$data['allProducts'] = $allProducts
    ->filter(function ($product) {
        return $product->status == 1;
    })
    ->sortByDesc('created_at')
    ->take(20);
    $data['data_count']=$data['allProducts']->count();
    $data['section9']= Home9Section::first();
                break;
            case 'most-viewed':
               $allProducts = collect();
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
         $filtersQueryString=[];
           $data['selectedQueryNames'] = $filtersQueryString;
       $data['category']=ProductCategory::where('slug',$slug)->first();

        $mainCategory = ProductCategory::with('children.children.products','filter_categories')
       ->where('slug',$slug)->first();
   $filterCategories = $mainCategory->filter_categories;


$parentCategoriesWithChildren = [];

// Loop through each filter category to categorize them by parent
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
 $data['parentCategoriesWithChildren']=$parentCategoriesWithChildren;
       //dd( $mainCategory);
       foreach ($mainCategory->children as $subCategory) {
    
    
        foreach ($subCategory->children as $subSubCategory) {
            $allProducts = $allProducts->concat($subSubCategory->products);
        }
    }
$data['allProducts'] = $allProducts
    ->filter(function ($product) {
        return $product->status == 1;
    })
    ->sortByDesc('view')->take(20);
    $data['data_count']=$data['allProducts']->count();
    $data['section9']= Home9Section::first();
                break;
            default:
                $allProducts = collect();
         $filtersQueryString=[];
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
        
           $data['selectedQueryNames'] = $filtersQueryString;
       $data['category']=ProductCategory::where('slug',$slug)->first();

        $mainCategory = ProductCategory::with('children.children.products','filter_categories')
       ->where('slug',$slug)->first();
   $filterCategories = $mainCategory->filter_categories;


$parentCategoriesWithChildren = [];

// Loop through each filter category to categorize them by parent
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
 $data['parentCategoriesWithChildren']=$parentCategoriesWithChildren;
       //dd( $mainCategory);
       foreach ($mainCategory->children as $subCategory) {
    
    
        foreach ($subCategory->children as $subSubCategory) {
            $allProducts = $allProducts->concat($subSubCategory->products);
        }
    }
$data['allProducts'] = '';
   
    $data['section9']= Home9Section::first();
                break;
        }
 $data['segment'] = $request->segment(1);
        return view('frontend.contents.allproduct',$data);
    }
    
    
      public function sortingCategory(Request $request,$parent, $slug, $sorting)
    {
        // Handle sorting logic based on the sorting type
        switch ($sorting) {
            case 'low-to-high':
               $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
        
       $data['category']=ProductCategory::with('filter_categories')->where('slug',$slug)->first();
       $filterCategories =  $data['category']->filter_categories;
       
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

 $data['parentCategoriesWithChildren']=$parentCategoriesWithChildren;
       
       $categoryProducts = Product::whereHas('product_categories', function ($query) use ($slug) {
        $query->where('product_categories.slug', $slug);
    })->get();
$data['categoryProducts']=$categoryProducts->sortByDesc('selling_price');
    $data['data_count']=$data['categoryProducts']->count();
    $data['section9']= Home9Section::first();
      
                break;
            case 'high-to-low':
                   $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
        
       $data['category']=ProductCategory::with('filter_categories')->where('slug',$slug)->first();
       $filterCategories =  $data['category']->filter_categories;
       
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

 $data['parentCategoriesWithChildren']=$parentCategoriesWithChildren;
       
       $categoryProducts = Product::whereHas('product_categories', function ($query) use ($slug) {
        $query->where('product_categories.slug', $slug);
    })->get();
$data['categoryProducts']=$categoryProducts->sortBy('selling_price');
    $data['data_count']=$data['categoryProducts']->count();
    $data['section9']= Home9Section::first();
                break;
            case 'new-arrivals':
                  $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
        
       $data['category']=ProductCategory::with('filter_categories')->where('slug',$slug)->first();
       $filterCategories =  $data['category']->filter_categories;
       
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

 $data['parentCategoriesWithChildren']=$parentCategoriesWithChildren;
       
       $categoryProducts = Product::whereHas('product_categories', function ($query) use ($slug) {
        $query->where('product_categories.slug', $slug);
    })->get();
$data['categoryProducts']=$categoryProducts
->filter(function ($product) {
        return $product->status == 1;
    })
    ->sortByDesc('created_at')
    ->take(20);
    $data['data_count']=$data['categoryProducts']->count();
    $data['section9']= Home9Section::first();
      

                break;
            case 'most-viewed':
               $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
        
       $data['category']=ProductCategory::with('filter_categories')->where('slug',$slug)->first();
       $filterCategories =  $data['category']->filter_categories;
       
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

 $data['parentCategoriesWithChildren']=$parentCategoriesWithChildren;
       
       $categoryProducts = Product::whereHas('product_categories', function ($query) use ($slug) {
        $query->where('product_categories.slug', $slug);
    })->get();
$data['categoryProducts']=$categoryProducts->filter(function ($product) {
        return $product->status == 1;
    })
    ->sortByDesc('view')
    ->take(20);
    $data['data_count']=$data['categoryProducts']->count();
    $data['section9']= Home9Section::first();
                break;
            default:
                $allProducts = collect();
        $filtersQueryString=[];
        $data['categories'] = ProductCategory::with(['children' => function ($query) {
            $query->where('status', '1');
        }])->whereNull('parent_id')->where('status','1')->get();
        $data['footer_categories'] = ProductCategory::where('level', '2')
        ->where('status','1')->get(); 
        $data['mainCategories'] = ProductCategory::with('children.children')->where('level','0')->where('status','1')
       ->get();
         
           $data['selectedQueryNames'] = $filtersQueryString;
       $data['category']=ProductCategory::where('slug',$slug)->first();

         $mainCategory = ProductCategory::with('children.children.products','filter_categories')
       ->where('slug',$slug)->first();
   $filterCategories = $mainCategory->filter_categories;


$parentCategoriesWithChildren = [];

// Loop through each filter category to categorize them by parent
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
 $data['parentCategoriesWithChildren']=$parentCategoriesWithChildren;
       //dd( $mainCategory);
      
$data['allProducts']= '';
    
    $data['section9']= Home9Section::first();
                break;
        }
 $data['segment'] = $request->segment(1);
        return view('frontend.contents.productInner',$data);
    }
}
