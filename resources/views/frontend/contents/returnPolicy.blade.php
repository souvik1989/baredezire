@extends('frontend.master')
@section('title', "FAQ Return Policy - Bare Dezire")
@section('content')
<!-- banner-inner -->
<section class="inner-banner">
    <div class="container-fluid">
        <div class="inner-header">
            <div class="inner-header-menu">
                <ul>
                    <li><a href="{{route('dashboard')}}">Home</a></li>
                   <li>Return Policy</li>
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
           
             {!!$return->return_policy!!}
        </div>
    </div>
</section>
<!-- collection-head -->



@endsection