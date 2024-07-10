<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data['coupons'] = Coupon::orderBy('created_at', 'DESC')->get();
     return view('admin.coupon.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.coupon.create');
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
            "code" => 'required|string|max:100|unique:coupons',
            "image" => 'nullable|image|max:5000',
            "type" => 'required',
           "value" => 'nullable|string|max:100',
            "percent" => 'nullable|string|max:100',
        'category' => 'nullable',
        'min_amount' => 'nullable|string|max:100',
         
           
        ]);

        if (isset($values['image'])) {
            $values['image'] = Storage::putFile('public/coupon', new File($request->image));
        }

        $coupon = new Coupon();
        $coupon->fill($values);
      
      
    
        $coupon->save();

        $notify[] = ['success', __('admin_messages.record.add')];
        return redirect()->route('coupon.index')->withNotify($notify);
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
    public function edit(Coupon $coupon)
    {
      $data['coupon']=$coupon;
        return view('admin.coupon.edit',$data);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
       $changed = false;
         $values = $request->validate([
           "code" => 'required|string|max:100',
            "image" => 'nullable|image|max:5000',
            "type" => 'required',
           "value" => 'nullable|string|max:100',
            "percent" => 'nullable|string|max:100',
        'category' => 'nullable',
        'min_amount' => 'nullable|string|max:100',
         
           
        ]);
       if ($request->code !== $coupon->code && Coupon::where('code', $request->code)->exists()) {
        return back()->withErrors(['code' => 'The code has already been taken.']);
    }

        if ($request->image) {
            if (!empty($coupon->image)) {
                Storage::delete($coupon->image);
            }
            $values['image'] = Storage::putFile('public/coupon', new File($request->image));
        }
      
       
        $coupon->fill($values);
        if ($coupon->isDirty()) {
            $coupon->save();
         
            $changed = true;
        }
     

        if (!$changed) {
            $notify[] = ['warning', __('admin_messages.nochange')];
            return redirect()->route('coupon.index')->withNotify($notify);
        }

        $notify[] = ['success', __('admin_messages.record.update')];
        return redirect()->route('coupon.index')->withNotify($notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $coupon = Coupon::find($id);
           
          
           if (isset($coupon)) {
            $coupon->delete();
        }

            
       return redirect()->route('coupon.index')->with("success", __("Record Deleted Successfully!"));
    }
   public function status($id)
    {
        try
        {
            $coupon = Coupon::findOrFail($id);
            if ($coupon->status == '1')
            {
                $coupon->status = '0';
            }
            else
            {
                $coupon->status = '1';
            }
            $coupon->save();
            return redirect()->back()->with('success', __("Coupon status updated successfully"));
        }
        catch(\Throwable $th)
        {
            abort(404);
        }

    }

}
