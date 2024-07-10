@extends('frontend.master')
@section('title', "About Bras | Panties | Sleepwear | Shapewear")
@section('content')
<!-- banner-inner -->
<section class="inner-banner">
    <div class="container-fluid">
        <div class="inner-header">
            <div class="inner-header-menu">
                <ul>
                    <li><a href="{{route('dashboard')}}">Home</a></li>
                    <li>About Us</li>
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
          {!!$about->about!!}
             
        </div>
    </div>
</section>
<!-- collection-head -->



@endsection