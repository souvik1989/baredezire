<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Home3Section;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class HomeSection3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sections'] = Home3Section::all();
        return view('admin.homeSection.section3.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.homeSection.section3.create');
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
            "heading" => 'required|string|max:150',
            "image1"=>'nullable|image|max:5000',
            "image2"=>'nullable|image|max:5000',
            "image1_text" => 'nullable|string|max:150',
            "image2_text" => 'nullable|string|max:150',
            "btn1_text" => 'nullable|string|max:150',
            "btn1_url" => 'nullable|string|max:150',
            "btn2_text" => 'nullable|string|max:150',
            "btn2_url" => 'nullable|string|max:150',
        ]);

        if (isset($values['image1'])) {
            $values['image1'] = Storage::putFile('public/homesection', new File($request->image1));
        }
        if (isset($values['image2'])) {
            $values['image2'] = Storage::putFile('public/homesection', new File($request->image2));
        }
        

        $section = new Home3Section();
        $section->fill($values);
        $section->save();

        $notify[] = ['success', __('admin_messages.record.add')];
        return redirect()->route('homeSection3.index')->withNotify($notify);
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
        $data['section'] = Home3Section::find($id);
        return view('admin.homeSection.section3.edit', $data);
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
        $section = Home3Section::find($id);
        $values = $request->validate([
            "heading" => 'nullable|string|max:150',
            "image1"=>'nullable|image|max:5000',
            "image2"=>'required|mimetypes:video/mp4,video/x-msvideo,video/x-matroska,video/quicktime|max:102400',
            "image1_text" => 'nullable|string|max:150',
            "image2_text" => 'nullable|string|max:150',
            "btn1_text" => 'nullable|string|max:150',
            "btn1_url" => 'nullable|string|max:150',
            "btn2_text" => 'nullable|string|max:150',
            "btn2_url" => 'nullable|string|max:150',
            
        ]);


        if ($request->image1) {
            if (!empty($section->image1)) {
                Storage::delete($section->image1);
            }

            $values['image1'] = Storage::putFile('public/homesection', new File($request->image1));
        }

        if ($request->image2) {
            if (!empty($section->image2)) {
                Storage::delete($section->image2);
            }

            $values['image2'] = Storage::putFile('public/homesection', new File($request->image2));
        }





        $section->fill($request->except(['image1', 'image2']));
        if (isset($values['image1'])) {
            $section->image1 = $values['image1'];
        }
        if (isset($values['image2'])) {
            $section->image2 = $values['image2'];
        }
       

        if ($section->isDirty()) {
            $section->save();
            $changed = true;
        }


        if (! $changed) {
            $notify[] = ['warning', __('admin_messages.nochange')];
            return redirect()->route('homeSection3.index')->withNotify($notify);
        }

        $notify[] = ['success', __('admin_messages.record.update')];
        return redirect()->route('homeSection3.index')->withNotify($notify);
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
