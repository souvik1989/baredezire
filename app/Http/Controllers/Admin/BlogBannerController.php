<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogBanner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class BlogBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = BlogBanner::orderBy('created_at', 'DESC')->get();
     return view('admin.blogs.blogs-banner.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blogs.blogs-banner.create');
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
          "description"=> 'nullable|string|max:1000',
           
        ]);

        if (isset($values['image'])) {
            $values['image'] = Storage::putFile('public/blogBanner', new File($request->image));
        }

        $category = new BlogBanner();
        $category->fill($values);
      
      
        $category->save();

        $notify[] = ['success', __('admin_messages.record.add')];
        return redirect()->route('blog-banner.index')->withNotify($notify);
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
    public function edit(BlogBanner $blogBanner)
    {
        $data['category'] = $blogBanner; 
        return view('admin.blogs.blogs-banner.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogBanner $blogBanner)
    {
        $changed = false;
        $values = $request->validate([
            "name" => 'required|string|max:100',
            "image" => 'nullable|image|max:5000',
           "description" => 'nullable|string|max:1000',
            
        ]);
        if ($request->image) {
            if (!empty($blogBanner->image)) {
                Storage::delete($blogBanner->image);
            }
            $values['image'] = Storage::putFile('public/blogBanner', new File($request->image));
        }
      
      

        $blogBanner->fill($values);
        if ($blogBanner->isDirty()) {
            $blogBanner->save();
            $changed = true;
        }

        if (!$changed) {
            $notify[] = ['warning', __('admin_messages.nochange')];
            return redirect()->route('blog-banner.index')->withNotify($notify);
        }

        $notify[] = ['success', __('admin_messages.record.update')];
        return redirect()->route('blog-banner.index')->withNotify($notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogBanner $blogBanner)
    {
         if (isset($blogBanner)) {
            $blogBanner->delete();
        }

        $notify[] = ['success', __('admin_messages.record.delete')];
        return redirect()->route('blog-banner.index')->withNotify($notify);
    }
}
