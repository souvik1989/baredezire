<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FilterCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class FilterCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = FilterCategory::orderBy('created_at', 'DESC')->get();
     return view('admin.filter-category.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['p_categories'] = FilterCategory::where('level', '!=' , "1")->orderBy('created_at', 'DESC')->get();
        //dd( $data['p_categories']);
        return view('admin.filter-category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $values = $request->validate([
            "name" => 'required|string|max:100',
           
            "parent_id"=>"nullable",
            "level"=>"required",
          
        ]);

       

        $category = new FilterCategory();
        $category->fill($values);
      
        $category->slug = $this->makeUniqueSlug($request->name);
    
        $category->save();

        $notify[] = ['success', __('admin_messages.record.add')];
        return redirect()->route('filter-category.index')->withNotify($notify);
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
    public function edit(FilterCategory $filterCategory)
    {
         $data['p_categories'] = FilterCategory::where('level', '!=' , "1")->orderBy('created_at', 'DESC')->get();
        $data['category'] = $filterCategory;
        //dd(  $data['category'] );
        return view('admin.filter-category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FilterCategory $filterCategory)
    {
         $changed = false;
        $values = $request->validate([
            "name" => 'required|string|max:100',
            
            "parent_id"=>"nullable",
            "level"=>"required",
           
        ]);
        
      
       if ($filterCategory->slug === null ) {
    // Slug is null, generate a new unique slug
    $filterCategory->slug = $this->makeUniqueSlug($request->name);
} elseif ($filterCategory->name !== $request->name) {
    // Slug needs to be updated because the name changed
    $filterCategory->slug = $this->makeUniqueSlug($request->name);
}

        $filterCategory->fill($values);
        if ($filterCategory->isDirty()) {
            $filterCategory->save();
            $changed = true;
        }

        if (!$changed) {
            $notify[] = ['warning', __('admin_messages.nochange')];
            return redirect()->route('filter-category.index')->withNotify($notify);
        }

        $notify[] = ['success', __('admin_messages.record.update')];
        return redirect()->route('filter-category.index')->withNotify($notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FilterCategory $filterCategory)
    {
        if (isset($filterCategory)) {
            $filterCategory->delete();
        }

        $notify[] = ['success', __('admin_messages.record.delete')];
        return redirect()->route('filter-category.index')->withNotify($notify);
    }
   private function makeUniqueSlug($name)
{
    $slug = Str::slug($name);
    $existingCount = FilterCategory::where('slug', $slug)->count();

    if ($existingCount > 0) {
        // If a category with the same slug exists, append a unique identifier
      $slug = $slug . '-' . strtolower(Str::random(5));
    
        $existingCount = FilterCategory::where('slug', $slug)->count();
    }

    return $slug;
}
  
   public function status($id)
    {
        
            $product = FilterCategory::findOrFail($id);
            if ($product->status == '1')
            {
                $product->status = '0';
            }
            else
            {
                $product->status = '1';
            }
            $product->save();
            return redirect()->back()->with('success', __("Status updated successfully"));
       

    }

}
