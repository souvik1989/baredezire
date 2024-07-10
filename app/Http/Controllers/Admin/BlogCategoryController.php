<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data['categories'] = BlogCategory::orderBy('created_at', 'DESC')->get();
     return view('admin.blogs.category.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('admin.blogs.category.create');
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
            "image" => 'nullable|image|max:5000',
           
        ]);

        if (isset($values['image'])) {
            $values['image'] = Storage::putFile('public/blogCategory', new File($request->image));
        }

        $category = new BlogCategory();
        $category->fill($values);
      
        $category->slug = $this->makeUniqueSlug($request->name);
    
        $category->save();

        $notify[] = ['success', __('admin_messages.record.add')];
        return redirect()->route('blog-category.index')->withNotify($notify);
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
    public function edit(BlogCategory $blogCategory)
    {//dd(0);
    $data['category'] = $blogCategory; 
        return view('admin.blogs.category.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogCategory $blogCategory)
    {
       $changed = false;
        $values = $request->validate([
            "name" => 'required|string|max:100',
            "image" => 'nullable|image|max:5000',
            
        ]);
        if ($request->image) {
            if (!empty($blogCategory->image)) {
                Storage::delete($blogCategory->image);
            }
            $values['image'] = Storage::putFile('public/blogCategory', new File($request->image));
        }
      
       if ($blogCategory->slug === null ) {
    // Slug is null, generate a new unique slug
    $blogCategory->slug = $this->makeUniqueSlug($request->name);
} elseif ($blogCategory->name !== $request->name) {
    // Slug needs to be updated because the name changed
    $blogCategory->slug = $this->makeUniqueSlug($request->name);
}

        $blogCategory->fill($values);
        if ($blogCategory->isDirty()) {
            $blogCategory->save();
            $changed = true;
        }

        if (!$changed) {
            $notify[] = ['warning', __('admin_messages.nochange')];
            return redirect()->route('blog-category.index')->withNotify($notify);
        }

        $notify[] = ['success', __('admin_messages.record.update')];
        return redirect()->route('blog-category.index')->withNotify($notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogCategory $blogCategory)
    {
       if (isset($blogCategory)) {
            $blogCategory->delete();
        }

        $notify[] = ['success', __('admin_messages.record.delete')];
        return redirect()->route('blog-category.index')->withNotify($notify);
    }
  
    private function makeUniqueSlug($name)
{
    $slug = Str::slug($name);
    $existingCount = BlogCategory::where('slug', $slug)->count();

    if ($existingCount > 0) {
        // If a category with the same slug exists, append a unique identifier
      $slug = $slug . '-' . strtolower(Str::random(5));
    
        $existingCount = BlogCategory::where('slug', $slug)->count();
    }

    return $slug;
}
   public function status($id)
    {
        
            $blog = BlogCategory::findOrFail($id);
            if ($blog->status == '1')
            {
                $blog->status = '0';
            }
            else
            {
                $blog->status = '1';
            }
            $blog->save();
            return redirect()->back()->with('success', __("Featured status updated successfully"));
       

    }
}
