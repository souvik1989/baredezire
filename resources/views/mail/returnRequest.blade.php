<x-mail::message>



<h1>Return Request Mail</h1>

A new request for return with order number {{$data['order_no']}}<br>
Customer Name:{{$data['name']}},<br>
Date:{{$data['date']}}
    

Thanks,<br>
{{ $setting['site_title'] ?? env('APP_NAME') }} Team<br>
  <a href="{{route('dashboard')}}" class="navbar-brand"><img src="{{  isset($setting->site_logo) ? config("app.url").Storage::url($setting->site_logo) :asset('assets/images/logo.png') }}" alt="image" style="width: 100px; height: auto;"></a>

</x-mail::message>