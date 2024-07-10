<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSection2New;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class HomeSectionNew2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sections'] = HomeSection2New::all();
        return view('admin.homeSection.sectionNew2.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.homeSection.sectionNew2.create');
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
           
            "image"=>'nullable|image|max:5000',
           
            "title"=>'nullable|string|max:150',
           
            "url" => 'nullable|string|max:150',
           
        ]);

        if (isset($values['image'])) {
            $values['image'] = Storage::putFile('public/homesection', new File($request->image));
        }
        

        $section = new HomeSection2New();
        $section->fill($values);
        $section->save();

        $notify[] = ['success', __('admin_messages.record.add')];
        return redirect()->route('homeSectionNew2.index')->withNotify($notify);
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
    public function edit($id)
    {
         $data['section'] = HomeSection2New::find($id);
        return view('admin.homeSection.sectionNew2.edit', $data);
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
        $changed = false;
        $section = HomeSection2New::find($id);
        $values = $request->validate([
            "image"=>'nullable|image|max:5000',
           
            "title"=>'nullable|string|max:150',
           
            "url" => 'nullable|string|max:150',
        ]);


        if ($request->image) {
            if (!empty($section->image)) {
                Storage::delete($section->image);
            }

            $values['image'] = Storage::putFile('public/homesection', new File($request->image));
        }

       


        $section->fill($request->except(['image']));
        if (isset($values['image'])) {
            $section->image = $values['image'];
        }
        

        if ($section->isDirty()) {
            $section->save();
            $changed = true;
        }


        if (! $changed) {
            $notify[] = ['warning', __('admin_messages.nochange')];
            return redirect()->route('homeSectionNew2.index')->withNotify($notify);
        }

        $notify[] = ['success', __('admin_messages.record.update')];
        return redirect()->route('homeSectionNew2.index')->withNotify($notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $homeBanner=HomeSection2New::find($id);
         if (isset($homeBanner)) {
            if (!empty($homeBanner->image)) {
               Storage::delete($homeBanner->image);
            }
            $homeBanner->delete();
        }
        
        $notify[] = ['success', __('admin_messages.record.delete')];
        return redirect()->route('homeSectionNew2.index')->withNotify($notify);
    }
}
