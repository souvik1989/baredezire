<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $data['pages'] = Page::orderBy('created_at', 'DESC')->get();  
     return view('admin.page.list',$data); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        //dd( $data['p_categories']);
        return view('admin.page.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //dd($request->all());
      $values = $request->validate([
            "terms" => 'required|string',
            "privacy" => 'nullable|string',
            "return_policy"=>"nullable|string",
        "shipping"=>"nullable|string",
         "about"=>"nullable|string",
           
        ]);

       $page = new Page();
        $page->fill($values);
        $page->save();

        $notify[] = ['success', __('admin_messages.record.add')];
        return redirect()->route('page.index')->withNotify($notify);
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
    public function edit(Page $page)
    {
       
        $data['page'] = $page;
        //dd(  $data['category'] );
        return view('admin.page.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
         $changed = false;
        $values = $request->validate([
            "terms" => 'required|string',
            "privacy" => 'nullable|string',
            "return_policy"=>"nullable|string",
          "shipping"=>"nullable|string",
          "about"=>"nullable|string",
           
        ]);
     

        $page->fill($values);
        if ($page->isDirty()) {
            $page->save();
            $changed = true;
        }

        if (!$changed) {
            $notify[] = ['warning', __('admin_messages.nochange')];
            return redirect()->route('page.index')->withNotify($notify);
        }

        $notify[] = ['success', __('admin_messages.record.update')];
        return redirect()->route('page.index')->withNotify($notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
