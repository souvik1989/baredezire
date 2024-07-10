<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSize;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sizes'] = ProductSize::orderBy('created_at', 'DESC')->get();
       

        return view('admin.product-size.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product-size.create');
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
            "size" => 'required|string|max:150|unique:product_sizes',
            "type" => 'required',
        ]);

        
        $size = new ProductSize();
        $size->fill($values);
        $size->save();

        $notify[] = ['success', __('admin_messages.record.add')];
        return redirect()->route('product-size.index')->withNotify($notify);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $data['size']=ProductSize::find($id);
         return view('admin.product-size.edit',$data);
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
         $values = $request->validate([
            "size" => 'required|string|max:150',
            "type" => 'required',
        ]);

        
        $size =ProductSize::find($id);
        $size->fill($values);
        $size->save();

        $notify[] = ['success', __('admin_messages.record.update')];
        return redirect()->route('product-size.index')->withNotify($notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $size =ProductSize::find($id);
        if (isset($size)) {
            $size->delete();
        }

        $notify[] = ['success', __('admin_messages.record.delete')];
        return redirect()->route('product-size.index')->withNotify($notify);
    }
}
