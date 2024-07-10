@extends('frontend.master')
@section('title', "Wishlists")
@section('content')
<!-- inner-banner -->
<section class="section breadcrumb-wrapper">
    <div class="shell">
        <h2>Wish List</h2>
    </div>
</section>
<!-- inner-banner end -->

<section class="service-wrap">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="service-box">
                    <form>
                        <div class="col-md-6">
                            <!--<div class="form-group d-flex order-search">-->
                            <!--    <input type="text" class="form-control" id="exampleFormControlInput1"-->
                            <!--        placeholder="Search Order">-->
                            <!--    <a href="#"><i class="fa fa-search" aria-hidden="true"></i></a>-->
                            <!--</div>-->
                        </div>

                    </form>

                    <div class="service-box">
                        <div class="wishlist">
                            <div class="wishlist-wrap">
                                @if($wishlists->isEmpty())



                                <p class="empty-cart">{{'Wishlist is empty!!'}}</p>
                                @else
                                @php
                                $x=1;
                                 $j=1;
                                @endphp
                                @foreach($wishlists as $list)
                                @php

                                $h=1;
                                @endphp
                                @php
                                $product=App\Models\Product::with(['product_images' => function ($query) {
                                $query->take(2);
                                }])->find($list->product_id);
$price=($product->original_price -$product->selling_price);
                $percent=($price/$product->original_price)*100;

                                @endphp
                                <div class="wishlist-wrap-box">
                                    <span class="discount">{{floor($percent)}}% off</span>
                                    @foreach($product->product_images as $image)

                                    <div class="wishlist-image{{$h++}}"><img
                                            src="{{  isset($image->image) ? config("app.url").Storage::url($image->image) :asset('assets/images/fun2.jpg') }}"
                                            alt=""></div>
                                    @endforeach
                                    
                                    <div class="product-details">
                                        <p>{{ Str::limit($product->name, 50) }}</p>
                                       <p class="price-tag price-original">₹{{$product->selling_price}}</p>
                                        <p class="price-drop">₹ {{$product->original_price}}</p>
                                        
                   
                    {{-- @php
                     $sumOfRatings = App\Models\Review::where('product_id', $product->id)->sum('rating');
$revCount=App\Models\Review::where('product_id', $product->id)->get();
$countRatings=count($revCount);

$avgRating=$countRatings>0? $sumOfRatings/$countRatings :0;
                    $wholeStars = floor($avgRating);
                    $fractionalStar = $avgRating - $wholeStars;
                    @endphp
                    <div class="product-rating">
                      
                       @if($countRatings>0) 

                        <!-- @for ($i = 0; $i < 5; $i++) 
                        @if ($i < $avgRating) 
                        <i class="fa fa-star" aria-hidden="true"></i>
                            @else
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            @endif
                            @endfor -->
                        @for ($i = 0; $i < $wholeStars; $i++) <i class="fa fa-star" aria-hidden="true"></i>
                            @endfor

                            @if ($fractionalStar > 0)
                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                            @else
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            @endif



                           

                            <span>({{$avgRating}})</span>
                            @else
                            @for ($i = 0; $i < $wholeStars; $i++) <i class="fa fa-star-o" aria-hidden="true"></i>
                            @endfor
                            <!-- <i class="fa fa-star-o" aria-hidden="true"></i> -->
                            <span>No Reviews!</span>
                            @endif
                    </div>--}}
                                    </div>
                                    <div class="product-button">
                                        <a href="#" data-target="#size-modal{{$x}}" data-toggle="modal">Add to
                                            Cart</a>
                                        <form action="{{route('removeItem',$list->id)}} " method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <p><button type="submit" class="Delete">Remove</button></p></form>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade size-chart" id="size-modal{{$x}}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="size-modal{{$x}}">Size Chart</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('wishToCart')}}" method="POST"
                                                        enctype="multipart/form-data">

                                                        @csrf
                                                        <input type="hidden" name="id"  value="{{$product->id}}" />
                                                        <input type="hidden" name="cart"  value="{{$list->id}}" />
                                                        <input type="hidden" name="quantity" value="1" />
                                                        <ul class="free-selected size_mar listNone Sizeslist normal radio-button"
                                                            id="selectSize2">
                                                           
                                                            @foreach($product->product_sizes->sortBy('size') as $size)
                                                           @php
                                        $inventory = App\Models\Inventory::where('product_id',$product->id)->where('product_size_id',$size->id)->first();
                                      @endphp
                                      @if(!empty($inventory) && $inventory->stock >0)
                                        <input type="radio" id="radio{{$j}}" name="size" value="{{$size->id}}">
                                        <label for="radio{{$j}}">{{$size->size}}</label>
                                      @else
                                       <input type="radio" id="radio{{$j}}" name="size" value="{{$size->id}}" disabled>
                                       <label for="radio{{$j}}" class="blur-label2">{{$size->size}}</label>
@endif
                                                            
                                                            @php
                                                            $j++;
                                                            @endphp
                                                            @endforeach

                                                        </ul>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="action" value="cart" class="btn btn-primary">Go To Cart</button>
                                                    <!-- <button type="button" class="btn btn-primary">Submit</button> -->
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                $x++;
                                @endphp
                                @endforeach
                                @endif

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
$('.Delete').on('click', function(e) {

    e.preventDefault();
    //alert(0);
    var single = $(this);

    iziToast.question({
        overlay: true,
        toastOnce: true,
        id: 'question',
        title: 'Hey',
        message: 'Are you sure you want to delete?',
        position: 'center',
        buttons: [
            ['<button><b>YES</b></button>', function(instance, toast) {

                instance.hide({
                    transitionOut: 'fadeOut'
                }, toast);

                single.closest("form").submit();


            }, true],
            ['<button>NO</button>', function(instance, toast) {

                instance.hide({
                    transitionOut: 'fadeOut'
                }, toast);

            }]
        ]
    });

});
</script>
@endsection