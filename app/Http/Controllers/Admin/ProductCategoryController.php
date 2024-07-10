<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\FilterCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $data['categories'] = ProductCategory::orderBy('created_at', 'DESC')->get();
     return view('admin.product-category.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['p_categories'] = ProductCategory::where('level', '!=' , "2")->orderBy('created_at', 'DESC')->get();
      $data['f_categories'] = FilterCategory::where('status',"1")->orderByDesc('created_at')->get();
        //dd( $data['p_categories']);
        return view('admin.product-category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    // dd($request->all());
        $values = $request->validate([
            "name" => 'required|string|max:100',
            "banner_image" => 'nullable|image|max:5000',
            "parent_id"=>"nullable",
            "level"=>"required",
            'meta_description' => 'nullable|string|max:80000',
            'meta_title' => 'nullable|string|max:80000',
           'meta_tags' => 'nullable|string|max:80000',
        ]);
 $f_categories = FilterCategory::where('status',"1")->orderByDesc('created_at')->get();
        if (isset($values['banner_image'])) {
            $values['banner_image'] = Storage::putFile('public/productCategory', new File($request->banner_image));
        }

        $category = new ProductCategory();
        $category->fill($values);
      
        $category->slug = $this->makeUniqueSlug($request->name);
    
        $category->save();
         $categoryIds = [];
foreach ($f_categories->where('level', 0) as $catt) {
    $categoryIds = array_merge($categoryIds, $request->input($catt->name.'_id', []));
}
$category->filter_categories()->sync($categoryIds);

        $notify[] = ['success', __('admin_messages.record.add')];
        return redirect()->route('product-category.index')->withNotify($notify);
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
    public function edit(ProductCategory $productCategory)
    {   
        $data['p_categories'] = ProductCategory::where('level', '!=' , "2")->orderBy('created_at', 'DESC')->get();
        $data['category'] = $productCategory;
      $data['f_categories'] = FilterCategory::where('status',"1")->orderByDesc('created_at')->get();
        //dd(  $data['category'] );
        return view('admin.product-category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        $changed = false;
        $values = $request->validate([
            "name" => 'required|string|max:100',
            "description"=>'nullable|string|max:5000',
            "banner_image" => 'nullable|image|max:5000',
            "parent_id"=>"nullable",
            "level"=>"required",
            'meta_description' => 'nullable|string|max:80000',
            'meta_title' => 'nullable|string|max:80000',
           'meta_tags' => 'nullable|string|max:80000',
        ]);
       $f_categories = FilterCategory::where('status',"1")->orderByDesc('created_at')->get();
        if ($request->banner_image) {
            if (!empty($productCategory->banner_image)) {
                Storage::delete($productCategory->banner_image);
            }
            $values['banner_image'] = Storage::putFile('public/productCategory', new File($request->banner_image));
        }
      
       if ($productCategory->slug === null ) {
    // Slug is null, generate a new unique slug
    $productCategory->slug = $this->makeUniqueSlug($request->name);
} elseif ($productCategory->name !== $request->name) {
    // Slug needs to be updated because the name changed
    $productCategory->slug = $this->makeUniqueSlug($request->name);
}
$f_categories = FilterCategory::where('status',"1")->orderByDesc('created_at')->get();
  
        $productCategory->fill($values);
        if ($productCategory->isDirty()) {
            $productCategory->save();
          
            $changed = true;
        }
       $categoryIds = [];
        foreach ($f_categories->where('level', 0) as $catt) {
    $categoryIds = array_merge($categoryIds, $request->input($catt->name.'_id', []));
     
}
      $productCategory->filter_categories()->sync($categoryIds);

        if (!$changed) {
            $notify[] = ['warning', __('admin_messages.nochange')];
            return redirect()->route('product-category.index')->withNotify($notify);
        }

        $notify[] = ['success', __('admin_messages.record.update')];
        return redirect()->route('product-category.index')->withNotify($notify);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        if (isset($productCategory)) {
            $productCategory->delete();
        }

        $notify[] = ['success', __('admin_messages.record.delete')];
        return redirect()->route('product-category.index')->withNotify($notify);
    }

    public function status($id)
    {
        
            $product = ProductCategory::findOrFail($id);
            if ($product->status == '1')
            {
                $product->status = '0';
            }
            else
            {
                $product->status = '1';
            }
            $product->save();
            return redirect()->back()->with('success', __("Featured status updated successfully"));
       

    }
  
   public function deleteSelectedRows(Request $request)
{
    $selectedRowIds = explode(',', $request->input('selectedRowsString'));
try
        {
  ProductCategory::whereIn('id', $selectedRowIds)->delete();
           

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
    $slug = Str::slug($name);
    $existingCount = ProductCategory::where('slug', $slug)->count();

    if ($existingCount > 0) {
        // If a category with the same slug exists, append a unique identifier
      $slug = $slug . '-' . strtolower(Str::random(5));
    
        $existingCount = ProductCategory::where('slug', $slug)->count();
    }

    return $slug;
}

  
}
