<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Support\Facades\Storage;
use Image;
use Symfony\Component\HttpFoundation\Response;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qty=0;
        $data['inventories'] = Inventory::orderByDesc('created_at')->get();
        foreach( $data['inventories'] as $inventory){
            $in=Inventory::find($inventory->id);
            $qty+=$in->stock;
           
          
        }
        $data['qty']=$qty;
        return view('admin.inventory.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        
        $data['products']=Product::orderByDesc('created_at')->where('status','1')->get();
       $data['bra_sizes']=ProductSize::where('type',"bra")->orderByDesc('created_at')->get();
        $data['sizes']=ProductSize::where('type',"others")->orderByDesc('created_at')->get();
        
        return view('admin.inventory.create', $data);
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
            
             'product_id' => 'nullable|exists:products,id',
             'quantity' => 'nullable|integer',
             'stock' => 'nullable|integer',
            'po_price' => 'nullable|string|max:100',
            'po_date' => 'nullable|date|before:today',
             'product_size_id' => 'nullable|exists:product_sizes,id',
          'bra_size_id' => 'nullable|exists:product_sizes,id',
            
        ]);
        //dd($request->all());
        $inventory = new Inventory();
        $inventory->product()
        ->associate($request->product_id);
        $inventory->fill($request->all());
      if( $request->product_size_id!== null && $request->bra_size_id== null){
       $inventory->product_size_id=
         $request->product_size_id;
      }else if( $request->bra_size_id!== null &&  $request->product_size_id == null){
       $inventory->product_size_id
       =$request->bra_size_id;
      }else{
        $inventory->product_size_id
       =null;
      }
        $inventory->save();
        
    return redirect()->route('inventory.index')->with("success", "Record Saved successfully!");
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
    public function edit(Inventory $inventory)
    {
        try
        { 
            $data['inventory']=$inventory;
             $data['bra_sizes']=ProductSize::where('type',"bra")->orderByDesc('created_at')->get();
        $data['sizes']=ProductSize::where('type',"others")->orderByDesc('created_at')->get();
             $data['products']=Product::orderByDesc('created_at')->get();
            
            
            return view('admin.inventory.edit', $data);
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
    public function update(Request $request,Inventory $inventory)
    {
        $values = $request->validate([
            'product_id' => 'nullable|exists:products,id',
             'quantity' => 'nullable|integer',
             'stock' => 'nullable|integer',
            'po_price' => 'nullable|string|max:100',
            'po_date' => 'nullable|date',
          'product_size_id' => 'nullable|exists:product_sizes,id',
          'bra_size_id' => 'nullable|exists:product_sizes,id',
        ]);
       
        $inventory->product()
        ->associate($request->product_id);
        $inventory->fill($request->all());
      if( $request->product_size_id!== null && $request->bra_size_id== null){
       $inventory->product_size_id=
         $request->product_size_id;
      }else if( $request->bra_size_id!== null &&  $request->product_size_id == null){
       $inventory->product_size_id
       =$request->bra_size_id;
      }else{
        $inventory->product_size_id
       =null;
      }
        $inventory->save();
        //dd('hi');
        return redirect()->route('inventory.index')->with("success","Record Updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
           
        $inventory->delete();
    return redirect()->route('inventory.index')->with("success", __("Record Deleted Successfully!"));
    }

    public function status($id)
    {
        try
        {
            $inventory = Inventory::findOrFail($id);
            if ($inventory->status == '1')
            {
                $inventory->status = '0';
            }
            else
            {
                $inventory->status = '1';
            }
            $inventory->save();
            return redirect()->back()->with('success', __("inventory status updated successfully"));
        }
        catch(\Throwable $th)
        {
            abort(404);
        }

    }
}
