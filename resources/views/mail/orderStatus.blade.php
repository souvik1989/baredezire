<x-mail::message>



<h1>Your Order Status Has Been Changed!</h1>

Your current order status for order number {{$data['order_no']}} is {{$data['status']}}<br>

    

Thanks,<br>
{{ $setting['site_title'] ?? env('APP_NAME') }} Team<br>
  <a href="{{route('dashboard')}}" class="navbar-brand"><img src="{{  isset($setting->site_logo) ? config("app.url").Storage::url($setting->site_logo) :asset('assets/images/logo.png') }}" alt="image" style="width: 100px; height: auto;"></a>

</x-mail::message>