<x-mail::message>



<h1>Email Verification Link</h1>

You can verify your email from the given link:
    <a href="{{ route('user.verify', $data['token']) }}">Verify Email</a>

Thanks,<br>
{{ $setting['site_title'] ?? env('APP_NAME') }} Team<br>
  <a href="{{route('dashboard')}}" class="navbar-brand"><img src="{{  isset($setting->site_logo) ? config("app.url").Storage::url($setting->site_logo) :asset('assets/images/logo.png') }}" alt="image" style="width: 100px; height: auto;"></a>

</x-mail::message>
