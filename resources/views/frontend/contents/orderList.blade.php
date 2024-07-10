@section('title',  "Order List")
@include('frontend.partials.headerCss')
@include('frontend.partials.headerNew')
<!-- inner-banner -->
<section class="section breadcrumb-wrapper">
    <div class="shell">
        <h2>Order List</h2>
    </div>
</section>
<!-- inner-banner end -->

<section class="search-form">
    <div class="container">
        <form>
            <!--<div class="col-md-6">-->
            <!--    <div class="form-group d-flex order-search">-->
            <!--        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Search Order">-->
            <!--        <a href="#"><i class="fa fa-search" aria-hidden="true"></i></a>-->
            <!--    </div>-->
            <!--</div>-->

        </form>
    </div>
</section>
  @if($orderlists->isEmpty())



                                <p class="empty-cart">{{'Order list is empty!!'}}</p>
                                @else
@foreach($orderlists as $orderlist)

<section class="service-wrap order">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="service-box">
                    <div class="order-list-wrap">
                        <div class="container">
                            <div class="order-list-card">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <p class="order-id"><span>Order id:</span>{{$orderlist->order_number}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        @php

                                        $carbonDate = \Carbon\Carbon::parse($orderlist->created_at);
                                        $new_date= $carbonDate->addDays(3);
                                        $dateOnly = $new_date->format('Y-m-d');
                                        @endphp
                                        <p class="order-date"><span>Order Placed:</span>{{$orderlist->created_at->format('Y-m-d')}}</p>
                                    </div>
                                    <div class="col-md-3">
@if($orderlist->status=="order_placed")
                                        <p class="order-date"><span>Delivery
                                                Within:</span>{{$dateOnly}}</p>
                                                @elseif($orderlist->status =="cancelled")<p class="order-date"><span>Order Status:</span>Cancelled</p>@else<p class="order-date"><span>Order Status:</span>Delivered</p>
                                                @endif
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{route('orderdetail',$orderlist->id)}}" class="view-details">View
                                            Details</a>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="order-list">
                                            <div class="order-list-details">
                                                <table class="table table-striped">
                                                    <tbody>
                                                        @php
                                                        $i=1;
                                                        @endphp
                                                        @foreach($orderlist->products as $productss)
                                                      
                                                        @php
                                                        $product=App\Models\Product::find($productss->id);

                                                        @endphp
                                                        <tr>
                                                            <td>{{$i++}}</td>
                                                           @php
                                   //dd($product->slug);
             // $new_name=$slug = Str::slug($product->name, '-');
                     // $slug = str_replace(['(', ')'], '', $new_name);                
                                      @endphp
                                                            <td><a href="{{$product->slug ? route('productDetail', $product->slug) :'#' }}"><img
                                                                        src="{{  isset($product->product_images->first->image->image) ? config("app.url").Storage::url($product->product_images->first->image->image) :asset('assets/images/fun2.jpg') }}"
                                                                        alt="owl1" /></a></td>
                                                          
                                                            <td>{{ Str::limit($product->name, 50) }}</td>
                                                        </tr>
                                                   
                                                        @endforeach
                                                        <!-- <tr>
                  <td>2</td>
                  <td><a href="#"><img src="images/pr5.jpg" alt=""></a></td>
                  <td>Product Name</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td><a href="#"><img src="images/pr8.jpg" alt=""></a></td>
                  <td>Product Name</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td><a href="#"><img src="images/pr7.jpg" alt=""></a></td>
                  <td>Product Name</td>
                </tr> -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endforeach
@endif
@include('frontend.partials.footer')


@include('frontend.partials.footerScripts')