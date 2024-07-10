  @php
            $order = App\Models\Order::where('order_number', $data['order_no'])->first();

  @endphp



<x-mail::message>



<h1>New Order!</h1>

  A new order is placed with order number <strong>{{ $data['order_no'] }}</strong> and payment method is <strong>{{ $data['payment_method'] }}</strong>,
        payment status: <strong>{{ $data['status'] }}</strong> <br>
        The ordered products are: <br>

     @foreach($order->products as $product)
  @php
  $size=$order->products()
    ->where('products.id', $product->id)
    ->first()
    ->pivot
    ->size;
 $p_size=App\Models\ProductSize::find($size);
  @endphp
      Product:{{ $product->name }},
            SKU ID:{{ $product->sku }},
            Quantity:{{$order->products()
    ->where('products.id', $product->id)
    ->first()
    ->pivot
    ->quantity}},
  
            Size:{{$p_size->size ??'--'}}
        @endforeach

Thanks,<br>
{{ $setting['site_title'] ?? env('APP_NAME') }} Team<br>
  <a href="{{route('dashboard')}}" class="navbar-brand"><img src="{{  isset($setting->site_logo) ? config("app.url").Storage::url($setting->site_logo) :asset('assets/images/logo.png') }}" alt="image" style="width: 100px; height: auto;"></a>

</x-mail::message>
