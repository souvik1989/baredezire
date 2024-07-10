@extends('frontend.master')
@section('title', "Search Products")
@section('content')
<!-- banner-inner -->
<section class="inner-banner">
    <div class="container-fluid">
        <div class="inner-header">
            
            <div class="product-heading all">
                <h4>Result for "{{$searchword}}" <span>({{$data_count}} products)</span></h4>
            </div>
        </div>
    </div>
</section>
<!-- banner-inner-end -->

<!-- collection -->
<section class="collection search-page">
    <div class="container-fluid">
        <div class="product-wrap">
            @php
            $x=1;
            $j=1;
            @endphp
            @if($data_count !==0)
            @foreach($allProducts as $product)
             @php
          
                $price=($product->original_price -$product->selling_price);
                $percent=($price/$product->original_price)*100;
                @endphp
            <div class="product-wrap-box">
               @php 
              $wish=App\Models\Cart::where('user_id',Auth::check()?Auth::user()->id:0)->where('product_id',$product->id)->where('wishlist',1)->first();
              @endphp
              
              @if($wish !== null)
              <button class="pwish-f" id="fill" data-id="{{$product->id}}"><i class="fa fa-heart" aria-hidden="true"></i></button>
              @else
                <button class="pwish" id="blank" data-id="{{$product->id}}"><i class="fa fa-heart-o" aria-hidden="true"></i></button>
               @endif 
                <span class="discount">{{floor($percent)}}% off</span>
                <a href="{{$product->slug ? route('productDetail',[$product->slug]):'#'}}" title="{{$product->name}}"> <img
                        src="{{  isset($product->product_images->first->image->image) ? config("app.url").Storage::url($product->product_images->first->image->image) :asset('assets/images/pr1.jpg') }}"
                        alt="owl1" />
                    <h4>{{ Str::limit($product->name, 50) }}</h4>   </a>
                    <div class="price">
                        <p class="price-original">₹{{$product->selling_price}}</p>
                        <p class="price-drop">₹{{$product->original_price}}</p>
                    </div>
                    <span class="note">(inclusive of all taxes)</span>
                     @php
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



                            <!-- <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i> -->

                            <span>({{$avgRating}})</span>
                            @else
                            @for ($i = 0; $i < $wholeStars; $i++) <i class="fa fa-star-o" aria-hidden="true"></i>
                            @endfor
                            <!-- <i class="fa fa-star-o" aria-hidden="true"></i> -->
                            <span>No Reviews!</span>
                            @endif
                    </div>
             
                <div class="cart-button">
                    <a href="#" class="cart" data-target="#size-modal{{$x}}" data-toggle="modal">Add to cart</a>
                    {{-- <a href="#"  data-target="#size-modal{{$x}}" data-toggle="modal" class="buy">Buy Now</a>--}}
<!--                    <form action="{{route('addToWish')}}" method="POST" enctype="multipart/form-data">-->
<!--                      @csrf-->
<!--                    <input type="hidden" name="id" value="{{$product->id}}" />-->
<!--                    <button type="submit" class="buy">Buy Now</button>-->
<!--</form>-->
                </div>
                <div class="modal fade size-chart" id="size-modal{{$x}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="size-modal{{$x}}">Select Size</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('addToCart')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$product->id}}" />
                                     <input type="hidden" name="total" value="{{$product->original_price}}" />
                            <input type="hidden" name="discount" value="{{$product->original_price - $product->selling_price}}" />

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
                                <button type="submit"  name="action" value="cart" class="btn btn-primary">Go To Cart</button>
                                   {{-- <button type="submit" class="btn" name="action" value="buy">Buy Now</button>--}}
                                <!-- <button type="button" class="btn btn-primary">Submit</button> -->
                            </div>
                            </form>
                        </div>
                    </div>
                    @php
                    $x++;
                    @endphp
                </div>

            </div>
            @endforeach
            @else
            <div class="empty-cart"><p>{{'No Products Found!'}}</p></div>
            @endif
            
        </div>
    </div>
</section>
<!-- collection-head -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>

<script>
    $(document).ready(function() {
        $('.pwish').click(function(e) {
            e.preventDefault();
             var button;
             button = $(this);
            var productId = $(this).data('id');
            $.ajax({
                url: "{{ route('addToWish') }}", // Make sure the route name is correct
                type: "POST",
                data: {
                    id: productId,
                    _token: "{{ csrf_token() }}" // Make sure CSRF token is properly included
                },
                success: function(response) {
                console.log('Response:', response.status);
                    if (response.status === 200) {
                          
                            location.reload(); 
                        iziToast.success({
                            title: 'Success',
                            message: response.message,
                            position: 'topCenter'
                        });
                         
                    } else {
                        iziToast.error({
                            title: 'Error',
                            message: response.message,
                            position: 'topCenter'
                        });
                        location.reload();
                    }
                },
                error: function(xhr) {
                       window.location.href = "{{ route('login') }}";
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.pwish-f').click(function(e) {
            e.preventDefault();
            var button;
             button = $(this);
            var productId = $(this).data('id');
            $.ajax({
                url: "{{ route('removeWish') }}", // Make sure the route name is correct
                type: "POST",
                data: {
                    id: productId,
                    _token: "{{ csrf_token() }}" // Make sure CSRF token is properly included
                },
                success: function(response) {
                     console.log('Response:', response.status);
                    if (response.status === 200) {
                            location.reload();   
                        iziToast.success({
                            title: 'Success',
                            message: response.message,
                            position: 'topCenter'
                        });
                         location.reload();
                    } else {
                        iziToast.error({
                            title: 'Error',
                            message: response.message,
                            position: 'topCenter'
                        });
                      
                    }
                },
                error: function(xhr) {
                    window.location.href = "{{ route('login') }}";
                }
            });
        });
    });
</script>



@endsection