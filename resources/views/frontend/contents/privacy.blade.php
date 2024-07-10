@extends('frontend.master')
@section('title', "Privacy Policy")
@section('content')
<!-- banner-inner -->
<section class="inner-banner">
    <div class="container-fluid">
        <div class="inner-header">
            <div class="inner-header-menu">
                <ul>
                    <li><a href="{{route('dashboard')}}">Home</a></li>
                    <li>Privacy Policy</li>
                </ul>
            </div>
            
        </div>
    </div>
</section>
<!-- banner-inner-end -->

<!-- collection -->
<section class="collection">
    <div class="container-fluid">
        <div class="product-detail">
           
             {!!$privacy->privacy!!}
        </div>
    </div>
</section>
<!-- collection-head -->



@endsection