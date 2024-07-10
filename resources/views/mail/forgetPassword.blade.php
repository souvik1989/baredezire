<x-mail::message>



<h1>Forget Password Email</h1>

You can reset password from below link:
<a target="_blank" href="{{ route('reset.password.get', $data['token']) }}">Reset Password</a>

Thanks,<br>
{{ $setting['site_title'] ?? env('APP_NAME') }} Team<br>
  <a href="{{route('dashboard')}}" class="navbar-brand"><img src="{{  isset($setting->site_logo) ? config("app.url").Storage::url($setting->site_logo) :asset('assets/images/logo.png') }}" alt="image" style="width: 100px; height: auto;"></a>

</x-mail::message>
