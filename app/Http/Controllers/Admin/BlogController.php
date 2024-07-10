<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['blogs'] = Blog::orderBy('created_at', 'DESC')->get();
     return view('admin.blogs.blogs.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $data['b_categories'] = BlogCategory::orderBy('created_at', 'DESC')->get();
        //dd( $data['p_categories']);
        return view('admin.blogs.blogs.create', $data);
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
        'blog_category_id' => 'required|exists:blog_categories,id',
        'description' => 'required|string|max:80000',
          'short_description' => 'nullable|string|max:50',
           
        ]);

        if (isset($values['image'])) {
            $values['image'] = Storage::putFile('public/blogs', new File($request->image));
        }

        $blog = new Blog();
        $blog->fill($values);
      
        $blog->slug = $this->makeUniqueSlug($request->name);
    
        $blog->save();
 $blog->blog_categories()
        ->sync($request->blog_category_id);
        $notify[] = ['success', __('admin_messages.record.add')];
        return redirect()->route('blog.index')->withNotify($notify);
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
    public function edit(Blog $blog)
    {
        $data['b_categories'] = BlogCategory::orderBy('created_at', 'DESC')->get();
        $data['blog'] = $blog;
        return view('admin.blogs.blogs.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $changed = false;
        $values = $request->validate([
           "name" => 'required|string|max:100',
            "image" => 'nullable|image|max:5000',
        'blog_category_id' => 'required|exists:blog_categories,id',
        'description' => 'required|string|max:80000',
          'short_description' => 'nullable|string|max:50',
            
        ]);
        if ($request->image) {
            if (!empty($blog->image)) {
                Storage::delete($blog->image);
            }
            $values['image'] = Storage::putFile('public/blogs', new File($request->image));
        }
      
       if ($blog->slug === null ) {
    // Slug is null, generate a new unique slug
    $blog->slug = $this->makeUniqueSlug($request->name);
} elseif ($blog->name !== $request->name) {
    // Slug needs to be updated because the name changed
    $blog->slug = $this->makeUniqueSlug($request->name);
}

        $blog->fill($values);
        if ($blog->isDirty()) {
            $blog->save();
         
            $changed = true;
        }
       $blog->blog_categories()
        ->sync($request->blog_category_id);
       //$changed = true;

        if (!$changed) {
            $notify[] = ['warning', __('admin_messages.nochange')];
            return redirect()->route('blog.index')->withNotify($notify);
        }

        $notify[] = ['success', __('admin_messages.record.update')];
        return redirect()->route('blog.index')->withNotify($notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
           
          
           if (isset($blog)) {
            $blog->delete();
        }

            
       return redirect()->route('blog.index')->with("success", __("Record Deleted Successfully!"));
    }
  
    public function status($id)
    {
        try
        {
            $blog = Blog::findOrFail($id);
            if ($blog->status == '1')
            {
                $blog->status = '0';
            }
            else
            {
                $blog->status = '1';
            }
            $blog->save();
            return redirect()->back()->with('success', __("Blog status updated successfully"));
        }
        catch(\Throwable $th)
        {
            abort(404);
        }

    }

    public function changeFeatured($id)
    {
        try
        {
            $blog = Blog::findOrFail($id);
            if ($blog->is_featured == '1')
            {
                $blog->is_featured = '0';
            }
            else
            {
                $blog->is_featured = '1';
            }
            $blog->save();
            return redirect()->back()->with('success', __("Featured status updated successfully"));
        }
        catch(\Throwable $th)
        {
            abort(404);
        }

    }
  public function changePopular($id)
    {
        try
        {
            $blog = Blog::findOrFail($id);
            if ($blog->is_popular == '1')
            {
                $blog->is_popular = '0';
            }
            else
            {
                $blog->is_popular = '1';
            }
            $blog->save();
            return redirect()->back()->with('success', __("Popular status updated successfully"));
        }
        catch(\Throwable $th)
        {
            abort(404);
        }

    }
  
  private function makeUniqueSlug($name)
{
    $baseSlug = Str::slug($name);
    $existingCount = Blog::where('slug', $baseSlug)->count();
    $substringLength = 3;
    $slug = $baseSlug;

    while ($existingCount > 0) {
        // Extract a substring from the product name
        $substring = substr($name, 0, $substringLength);
        $slug = $baseSlug . '-' . Str::slug($substring);

        // Increase the length of the substring for the next iteration
        $substringLength++;
        $existingCount = Blog::where('slug', $slug)->count();
    }

    return $slug;
}
}
