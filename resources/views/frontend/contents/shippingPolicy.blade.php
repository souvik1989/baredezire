@extends('frontend.master')
@section('title', "Shipping Policy")
@section('content')
<!-- banner-inner -->
<section class="inner-banner">
    <div class="container-fluid">
        <div class="inner-header">
            <div class="inner-header-menu">
                <ul>
                    <li><a href="{{route('dashboard')}}">Home</a></li>
                    <li>Shipping Policy</li>
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
          {!!$shipping->shipping!!}
             
        </div>
    </div>
</section>
<!-- collection-head -->



@endsection