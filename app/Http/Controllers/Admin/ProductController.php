<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\FilterCategory;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\Color;
use Illuminate\Support\Facades\Storage;
use Image;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['products'] = Product::where('is_delete','1')->orderByDesc('created_at')->get();
        return view('admin.product.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $data['colors']=Color::orderByDesc('created_at')->get();
        $data['prods']=Product::orderByDesc('created_at')->get();
        $data['bra_sizes']=ProductSize::where('type',"bra")->orderByDesc('created_at')->get();
        $data['sizes']=ProductSize::where('type',"others")->orderByDesc('created_at')->get();
        $data['categories'] = ProductCategory::where('level',"2")->orderByDesc('created_at')->get();
       $data['f_categories'] = FilterCategory::where('status',"1")->orderByDesc('created_at')->get();
      //  $data['f_categories']=FilterCategory::where('level','1')->get();
     // $data['']
        return view('admin.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $messages = [
    "product_image.min" => "Choose atleast 5 images!."
 ];
    

        $values = $request->validate([
            "name" => 'required|string',
             "sku" => 'nullable|string',
             'product_category_id' => 'required|exists:product_categories,id',
             'product_size_id' => 'nullable|exists:product_sizes,id',
             'color_id' => 'nullable|exists:colors,id',
             'variation_id' => 'nullable|exists:products,id',
             'bra_size_id' => 'nullable|exists:product_sizes,id',
            'original_price' => 'required|string|max:100',
             'product_image.*' => 'file|mimes:jpg,jpeg,png|max:5000',
            'product_image' => 'min:5',
            'description' => 'required|string|max:80000',
            'selling_price' => 'nullable|string|max:100',
            'additional' => 'nullable|string|max:80000',
            'wash' => 'nullable|string|max:80000',
          'meta_description' => 'nullable|string|max:80000',
            'meta_title' => 'nullable|string|max:80000',
           'meta_tags' => 'nullable|string|max:80000',
        ],$messages);
      
    if(count($request->file('product_image')) > 6) {
        return back()->withErrors(['product_image' => 'No more than 6 images are allowed.']);
    }
        //dd($request->all());
         $f_categories = FilterCategory::where('status',"1")->orderByDesc('created_at')->get();
        $product = new Product();
        $product->fill($request->all());
      $product->slug=$this->makeUniqueSlug($request->name);
        $product->color()
        ->associate($request->color_id);
        $product->save();
        $product->variations()
        ->sync($request->variation_id);
        $product->product_categories()
        ->sync($request->product_category_id);
        $product->product_sizes()
        ->sync($request->product_size_id);
        $product->product_sizes()
        ->attach($request->bra_size_id);
       $categoryIds = [];
      foreach ($f_categories->where('level', 0) as $catt) {
    $categoryIds = array_merge($categoryIds, $request->input($catt->name.'_id', []));
}
$product->filter_categories()->sync($categoryIds);
        if ($request->hasFile('product_image'))
        {
            foreach ($request->product_image as $image)
            {
                $product_image = new ProductImage();
                $extension = $image->getClientOriginalExtension();
                $filename = uniqid().'.' . $extension;
                $name = $image->getClientOriginalName();
                $storage_folder = 'public/product_images/';
                $image->storeAs($storage_folder, $filename);
                $product_image->image = 'public/product_images/'.$filename;
                $product_image->name = $name;

                $product_image->product()->associate($product);
                $product_image->save();
            }

    }
    return redirect()->route('product.index')->with("success", "Record Saved successfully!");
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        try
        {
             $data['product'] = $product;
             //dd($product->variations);
             $data['colors']=Color::orderByDesc('created_at')->get();
             $data['prods']=Product::where('status','1')->orderByDesc('created_at')->get();
             $data['bra_sizes']=ProductSize::where('type',"bra")->orderByDesc('created_at')->get();
             $data['sizes']=ProductSize::where('type',"others")->orderByDesc('created_at')->get();
            $data['categories'] = ProductCategory::where('status','1')->where('level',"2")->orderByDesc('created_at')->get();
             $data['f_categories'] = FilterCategory::where('status',"1")->orderByDesc('created_at')->get();
            return view('admin.product.edit', $data);
        }
        catch(\Throwable $th)
        {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request, $id)
{
    $messages = [
        "product_image.min" => "Choose at least 5 images!."
    ];

    $values = $request->validate([
        "name" => 'required|string',
        "sku" => 'nullable|string',
        'product_category_id' => 'required|exists:product_categories,id',
        'product_size_id' => 'nullable|exists:product_sizes,id',
        'bra_size_id' => 'nullable|exists:product_sizes,id',
        'original_price' => 'required|string|max:100',
        'product_image.*' => 'file|mimes:jpg,jpeg,png|max:5000',
       // 'product_image' => 'min:5',
        'description' => 'required|string|max:80000',
        'selling_price' => 'nullable|string|max:100',
        'additional' => 'nullable|string|max:80000',
        'wash' => 'nullable|string|max:80000',
        'meta_description' => 'nullable|string|max:80000',
        'meta_title' => 'nullable|string|max:80000',
        'meta_tags' => 'nullable|string|max:80000',
    ], $messages);
$f_categories = FilterCategory::where('status',"1")->orderByDesc('created_at')->get();
    $product = Product::findOrFail($id);
  
        // dd($product->slug, $request->name, $product->name);

 if ($product->slug === null || $product->name !== $request->name) {
        $product->slug = $this->makeUniqueSlug($request->name);
    }
   $product->fill($request->all());    
      
    $product->color()
        ->associate($request->color_id);
    $product->save();
    $product->variations()
        ->sync($request->variation_id);
    $product->product_categories()->sync($request->product_category_id);
    $product->product_sizes()
        ->sync($request->product_size_id);
    $product->product_sizes()
        ->attach($request->bra_size_id);
 $categoryIds = [];
           foreach ($f_categories->where('level', 0) as $catt) {
    $categoryIds = array_merge($categoryIds, $request->input($catt->name.'_id', []));
}
$product->filter_categories()->sync($categoryIds);
   

    if ($request->hasFile('product_image')) {
      
       $previousImageIds = $product->product_images->pluck('id')->toArray();

    // Delete the old images from storage and the database
    foreach ($previousImageIds as $imageId) {
        $productImage = ProductImage::find($imageId);

        if ($productImage) {
            $imagePath = $productImage->image;
            Storage::disk('public')->delete($imagePath);
            $productImage->delete();
        }
    }
        // Iterate over the new images and associate them with the product
        foreach ($request->product_image as $image) {
            $product_image = new ProductImage();

            $extension = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$extension;
            $name = $image->getClientOriginalName();
            $storage_folder = 'public/product_images/';

            $image->storeAs($storage_folder, $filename);
            $product_image->image = 'public/product_images/'.$filename;
            $product_image->name = $name;

            $product_image->product()->associate($product);
            $product_image->save();
            $changed = true;
        }
    }

    return redirect()->route('product.edit', $product)->with("success", __("Record Updated successfully!"));
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $product = Product::findOrFail($id);
           
          
                $product->is_delete = '0';
      $product->save();
            
       return redirect()->route('product.index')->with("success", __("Record Deleted Successfully!"));
    }

    public function changeFeatured($id)
    {
        try
        {
            $product = Product::findOrFail($id);
            if ($product->status == '1')
            {
                $product->status = '0';
            }
            else
            {
                $product->status = '1';
            }
            $product->save();
            return redirect()->back()->with('success', __("Product status updated successfully"));
        }
        catch(\Throwable $th)
        {
            abort(404);
        }

    }
  
   public function changeOffer($id)
    {
        try
        {
            $product = Product::findOrFail($id);
            if ($product->is_offer == '1')
            {
                $product->is_offer = '0';
            }
            else
            {
                $product->is_offer = '1';
            }
            $product->save();
            return redirect()->back()->with('success', __("Product Offer status updated successfully"));
        }
        catch(\Throwable $th)
        {
            abort(404);
        }

    }

    public function status($id)
    {
        try
        {
            $product = Product::findOrFail($id);
            if ($product->is_featured == '1')
            {
                $product->is_featured = '0';
            }
            else
            {
                $product->is_featured = '1';
            }
            $product->save();
            return redirect()->back()->with('success', __("Featured status updated successfully"));
        }
        catch(\Throwable $th)
        {
            abort(404);
        }

    }

    public function removeImage(Request $request)
    {
      //dd('hi');  
      try
        {
            $image = ProductImage::findOrFail($request->image_id);
        //$image = ProductImage::findOrFail($id);
            $image_folder = 'product_images/';
            $image_path = $image_folder . $image->image;
          
            if (Storage::disk('public')->exists($image_path))
            {
                Storage::disk('public')->delete($image_path);
            }

            $image->delete();
return redirect()->back()->with('success', __("Image deleted successfully"));
            //return response()->json([
          //  'status' => Response::HTTP_OK,
          //  'message' => 'Image is deleted',
          //  ], Response::HTTP_OK);
        }
        catch(\Throwable $th)
        {
            return response()->json([
            'status' => Response::HTTP_NOT_FOUND,
            'message' => 'Image not found!',
            ], Response::HTTP_NOT_FOUND);
        }
    }
 public function deleteSelectedRows(Request $request)
{
    $selectedRowIds = explode(',', $request->input('selectedRowsString'));
  // dd($selectedRowIds);
    //Product::whereIn('id', $selectedRowIds)->get();
try{
  Product::whereIn('id', $selectedRowIds)->update(['is_delete' => 0]);
           

            return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Rows deleted',
            ], Response::HTTP_OK);
        }
        catch(\Throwable $th)
        {
            return response()->json([
            'status' => Response::HTTP_NOT_FOUND,
            'message' => $th->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }
    // Perform the deletion logic for the selected rows based on $selectedRowIds
    // Example:
    // YourModel::whereIn('id', $selectedRowIds)->delete();

    //return redirect()->route('product-category.index')->with('success', 'Selected rows deleted.');
}
  
private function makeUniqueSlug($name)
{
    $baseSlug = Str::slug($name);
    $existingCount = Product::where('slug', $baseSlug)->count();
    $substringLength = 3;
    $slug = $baseSlug;

    while ($existingCount > 0) {
        // Extract a substring from the product name
        $substring = substr($name, 0, $substringLength);
        $slug = $baseSlug . '-' . Str::slug($substring);

        // Increase the length of the substring for the next iteration
        $substringLength++;
        $existingCount = Product::where('slug', $slug)->count();
    }

    return $slug;
}



}
