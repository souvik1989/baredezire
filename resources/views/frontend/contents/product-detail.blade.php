@extends('frontend.master')
@section('title', $product->meta_title ?? "Product Detail")
@section('description', $product->meta_description ?? '')
@section('keywords', $product->meta_tags ?? '')
@section('content')
<!-- banner-inner -->
<section class="detail-product-card">
    <div class="container">
        <div class="card">
            <!-- card left -->
            <div id="sidebar" class="d-none d-lg-block d-md-none d-sm-none">
                <div class="product-imgs">
                    <div class="img-select">
                        @php
                        $i=1;
                        @endphp
                        @foreach($product->product_images as $image)
                        <div class="img-item">
                            <a href="#" data-id="{{$i++}}">
                                <img src="{{  isset($image->image) ? config("app.url").Storage::url($image->image) :asset('assets/images/logo.png') }}"
                                    alt="image" />
                            </a>
                        </div>
                        @endforeach
                        <!-- <div class="img-item">
                    <a href="#" data-id="2">
                      <img src="{{asset('assets/images/ls3.jpg')}}" alt="shoe image" />
                    </a>
                  </div>
                  <div class="img-item">
                    <a href="#" data-id="3">
                      <img src="{{asset('assets/images/ls1.jpg')}}" alt="shoe image" />
                    </a>
                  </div>
                  <div class="img-item">
                    <a href="#" data-id="4">
                      <img src="{{asset('assets/images/ls3.jpg')}}" alt="shoe image" />
                    </a>
                  </div> -->
                    </div>
                    <form action="{{route('addToCart')}}" method="POST" enctype="multipart/form-data"> 
                      
                        @csrf
                        <input type="hidden" name="id" value="{{$product->id}}" />
                        <div class="img-display">
                            <div class="img-showcase">
                                @foreach($product->product_images as $image)
                                <!--<div class="middle">-->
                                <!--  <img src="{{  isset($image->image) ? config("app.url").Storage::url($image->image) :asset('assets/images/logo.png') }}" class="img-responsive" alt="">-->
                                <!--  <div class="overlay-1">-->
                                <!--    <a href="{{  isset($image->image) ? config("app.url").Storage::url($image->image) :asset('assets/images/logo.png') }}" class="gallery" rel="prettyPhoto[gallery]">-->
                                <!--      <i class="fa"><img src="images/zoom-icon.png" alt=""></i>-->
                                <!--    </a>-->
                                <!--  </div>-->
                                <!--</div>-->
                              <figure class="zoom" onmousemove="zoom(event)" style="background-image: url('{{ isset($image->image) ? config("app.url").Storage::url($image->image) : asset("assets/images/logo.png") }}');">
    <img src="{{ isset($image->image) ? config("app.url").Storage::url($image->image) : asset("assets/images/logo.png") }}" alt="image" />
</figure>

                                <!-- <img src="{{asset('assets/images/ls1.jpg')}}" alt="shoe image" /> -->
                                <!-- <img src="{{asset('assets/images/ls3.jpg')}}" alt="shoe image" />
                    <img src="{{asset('assets/images/ls1.jpg')}}" alt="shoe image" />
                    <img src="{{asset('assets/images/ls3.jpg')}}" alt="shoe image" /> -->
                                @endforeach
                            </div>
                            <div class="purchase-info">
                                <button type="submit" class="btn" name="action" value="cart">
                                    Add to Cart
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </button>

                                <button type="submit" class="btn" name="action" value="buy">Buy Now</button>
                              @php 
              $wish=App\Models\Cart::where('user_id',Auth::check()?Auth::user()->id:0)->where('product_id',$product->id)->where('wishlist',1)->first();
              @endphp
              
              @if($wish !== null)
              <button class="pwish-f" id="fill" data-id="{{$product->id}}"><i class="fa fa-heart" aria-hidden="true"></i></button>
              @else
                <button class="pwish" id="blank" data-id="{{$product->id}}"><i class="fa fa-heart-o" aria-hidden="true"></i></button>
               @endif 
                                <input type="hidden" name="quantity" value="1" />
                                  <input type="hidden" name="total" value="{{$product->original_price}}" />
                            <input type="hidden" name="discount" value="{{$product->original_price - $product->selling_price}}" />
                            </div>
                        </div>

              
                </div>
            </div>
              
            <div id="sidebar" class="d-block d-sm-block d-md-block d-lg-none d-xl-none">
              <div id="product-detail-slider" class="owl-carousel">
                @foreach($product->product_images as $image)
                 <div class="item">
                   <div class="image">
                     <img src="{{ isset($image->image) ? config("app.url").Storage::url($image->image) : asset("assets/images/logo.png") }}" alt="image" />
                   </div>
                </div>
                @endforeach
              </div>
              
            </div>  
              
            <!-- card right -->
            <div class="product-content">
               
              <div class="product-content-header-wrap">
                <h2 class="product-title">{{$product->name}}</h2>
                  	<!-- Share button -->
              <div class="social-share">
                <a class="view-modal-share"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
<div class="popup-s">
  <header>
    <div class="close-s"><i class="fa fa-times"></i></div>
  </header>
  <div class="content-s">
    <p>Share this link via</p>
    <ul class="icons">
      <a href="{{ $fbLink }}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
      <a href="{{ $twLink }}" target="_blank"><i class="fa fa-twitter"></i></a>
      <a href="{{ $emailLink }}" target="_blank"><i class="fa fa-envelope-o"></i></a>
      <a href="{{ $whatsappUrl }}" target="_blank"><i class="fa fa-whatsapp"></i></a>
      <a href="{{ $tgLink }}" target="_blank"><i class="fa fa-telegram"></i></a>
      
    </ul>
    <p>Or copy link</p>
    <div class="field-s">
      <i class="fa fa-link" aria-hidden="true"></i>
      <input type="text" readonly value="{{url()->current()}}">
      <a class="copy-link" href="#">Copy</a>
    </div>
  </div>
</div>
              </div>
   <!-- Share button End -->
               
                 
              </div>
               
              
                <!-- <a href="#" class="product-link">visit near store</a> -->
               {{-- @php
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

                        <span>@if (is_float($avgRating))
                            {{ number_format($avgRating, 1) }} ({{$countRatings}})
                            @else
                            {{ number_format($avgRating, 0) }} ({{$countRatings}})
                            @endif</span>
                        @else
                        <span>No Reviews!</span>
                        @endif
                </div>--}}
      @php
    // Ensure avgRating and countRatings have valid defaults
    $avgRating = $avgRating ?? 0;
    $countRatings = $countRatings ?? 0;

    // Calculate whole and fractional stars
    $wholeStars = floor($avgRating);
    $fractionalStar = $avgRating - $wholeStars;

    // Determine if there should be a half star
    $hasHalfStar = $fractionalStar >= 0.5;

    // Total filled stars (including whole and half)
    $filledStars = $wholeStars + ($hasHalfStar ? 1 : 0);

    // Total stars should be 5, so compute how many empty stars to add
    $emptyStars = 5 - $filledStars;
@endphp

<div class="product-rating">
  @if($countRatings !== 0)
    {{-- Display whole stars --}}
    @for ($i = 0; $i < $wholeStars; $i++)
        <i class="fa fa-star" aria-hidden="true"></i>
    @endfor

    {{-- Display half star if needed --}}
    @if ($hasHalfStar)
        <i class="fa fa-star-half-o" aria-hidden="true"></i>
    @endif

    {{-- Display empty stars for the remainder up to 5 --}}
    @for ($i = 0; $i < $emptyStars; $i++)
        <i class="fa fa-star-o" aria-hidden="true"></i>
    @endfor

    {{-- Display average rating and count of ratings --}}
          
    <span>
        {{ number_format($avgRating, 1) }} ({{ $countRatings }})
    </span>
          @else
          <span>No Reviews</span>
          @endif
</div>



                @php
                $price=($product->original_price -$product->selling_price);
                $percent=($price/$product->original_price)*100;
                @endphp
                <div class="product-price">
                    <p class="last-price"><span>₹{{$product->original_price}}</span></p>
                    <p class="new-price"><span>₹{{$product->selling_price}} <span class="percentage">{{floor($percent)}}% Off</span></span></p>
                  
                </div>
                <span class="note">(inclusive of all taxes)</span>

                <div id="available_sizes">
                  <div class="row">
                    
                    <div class="col-md-4">
                        <p class="sizesAvailble prThumb">
                          <span style="text-align: left"> Available Sizes</span>
                      </p>


                      <ul class="free-selected size_mar listNone Sizeslist normal radio-button" id="selectSize1">

                          @php
      $sortedSizes = $product->product_sizes->sortBy('size');
      $i = 1;
  @endphp

  @foreach($sortedSizes as $size)
       @php
                                          $inventory = App\Models\Inventory::where('product_id',$product->id)->where('product_size_id',$size->id)->first();
                                        @endphp
                                        @if(!empty($inventory) && $inventory->stock >0)
                                          <input type="radio" id="radio{{$i}}" name="size" value="{{$size->id}}">
                                          <label for="radio{{$i}}">{{$size->size}}</label>
                                        @else
                                         <input type="radio" id="radio{{$i}}" name="size" value="{{$size->id}}" disabled>
                                         <label for="radio{{$i}}" class="blur-label">{{$size->size}}</label>
  @endif
      @php
          $i++;
      @endphp
  @endforeach


                      </ul>
                    </div>
                    
                    <div class="col-md-8">
                        <div id="requestSizeContainer" class="productFilter size_mar productFilterLook2 col-lg-12 clearfix">
                          <p class="sizeChartRequest">
                              <span style="display: flex">
                                  <a href="#" class="last" data-toggle="modal" data-target="#exampleModal">SIZE
                                      CHART</a>
                              </span>

                              <span class="sizeRequest">Couldn't find your size?<a href="#" class="pinkDark">
                                      Request your size here</a></span>
                          </p>
                      </div>
                    </div>
                    
                  </div>
                    
                    
                </div>
              
	          <div class="purchase-info d-block d-sm-block d-md-block d-lg-none d-xl-none">
                                <button type="submit" class="btn" name="action" value="cart">
                                    Add to Cart
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </button>

                                <button type="submit" class="btn" name="action" value="buy">Buy Now</button>
                               
                            </div>
              
              
                </form>
                <div class="m-colors">
                    <h2>Colors</h2>
                    <div class="c1">
                        <div class="radius-color">

                            <div class="active"> <img
                                    src="{{  isset($product->product_images->first->image->image) ? config("app.url").Storage::url($product->product_images->first->image->image) :asset('assets/images/logo.png') }}"
                                    alt="owl1" /></div>

                           @foreach($product->variations as $variation)
                          @php
                          $varP=App\Models\Product::find($variation->id);
                         
                                   
              $new_name=$slug = Str::slug($varP->name, '-');
                      $slug = str_replace(['(', ')'], '', $new_name);                
                                      @endphp
  @if($varP->status == 1)
                            <a href="{{route('productDetail',[$varP->slug])}}" class="product-img">
                                <img src="{{  isset($variation->product_images->first->image->image) ? config("app.url").Storage::url($variation->product_images->first->image->image) :asset('assets/images/logo.png') }}"
                                    alt="owl1" />

                            </a>

@endif

                            @endforeach
                        </div>
                    </div>
                </div>

                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">Product Highlight</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nl1" href="#buzz" role="tab" data-toggle="tab">Fabric Care</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nl1" href="#references" role="tab" data-toggle="tab">
                            Additional Info</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content product-details-tab">
                    <div role="tabpanel" class="tab-pane fade in active show" id="profile">
                        <div class="product-detail">
                            {!!$product->description!!}
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="buzz">
                        <div class="prdetail product-detail">
                            {!!$product->wash!!}

                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="references">
                        <div>
                            <div class="prdetail prddetails_addinfo">
                                <p>
                                    {!!$product->additional!!}

                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="estimate-delivery">
                    <h2>
                        <i class="fa fa-truck" aria-hidden="true"><span>Estimate Delivery</span></i>
                    </h2>
                    <div class="bnd">
                        <a href="{{route('shippingPolicy')}}" class="bnd1">Shipping </a>
                        <a href="#" class="bnd1">Discreet Packaging </a>
                        <a href="{{route('returnPolicy')}}" class="bnd11"> Return Policy </a>
                    </div>
                    <form class="address-pincode">
                        @csrf
                        <input class="pin" placeholder=" Enter Pincode" type="text" name="pincode" />
                        <button type="submit" class="btn">Check</button>

                    </form>
                    <div id="pincode-message" class=""></div>
                </div>

                <section>
                    <div class="factor">
                        <p class="icns">
                            <span>
                                <i class="fa fa-money" aria-hidden="true"></i>
                            </span>
                          <strong><a href="{{route('shippingPolicy')}}">COD Available</a></strong>
                        </p>
                        <p class="icns">
                            <span>
                                <i class="fa fa-refresh" aria-hidden="true"></i>
                            </span>
                          <strong><a href="{{route('returnPolicy')}}">15 days returns</a></strong>
                        </p>
                        <p class="icns">
                            <span>
                                <i class="fa fa-truck" aria-hidden="true"></i>
                            </span>
                          <strong><a href="{{route('shippingPolicy')}}">Free shipping</a></strong>
                        </p>
                    </div>
                </section>

                <section class="rating">
                    @if($countRatings>0)
                    <h2>Rating & Reviews</h2>
                    @endif
                    <div class="rating-list">
                        <div class="stars">
                          
                            @for ($i = 0; $i < $wholeStars; $i++)
                <i class="fa fa-star" aria-hidden="true" style="color: gold"></i>
            @endfor

            {{-- Display half star if applicable --}}
            @if ($hasHalfStar)
                <i class="fa fa-star-half-o" aria-hidden="true" style="color: gold"></i>
            @endif

            {{-- Display empty stars to ensure 5 total --}}
            @for ($i = 0; $i < $emptyStars; $i++)
                <i class="fa fa-star-o" aria-hidden="true" style="color: gold"></i>
            @endfor
                 
                        </div>

                        <div class="rating-star">
            @if ($countRatings > 0)
            <div>
                <span>
                    {{ is_float($avgRating) ? number_format($avgRating, 1) : number_format($avgRating, 0) }}
                </span>
                <span class="rating-span1"> Based on Ratings</span>
            </div>
            @endif
            
         @if(auth()->user())
            <a href="#" class="rating-btn" data-target="#review" data-toggle="modal">RATE & REVIEW</a>
                          @else
             <a href="{{route('login')}}" class="rating-btn">LOGIN TO REVIEW</a>
                          @endif
        </div>
    </div>
</section>
            </div>


        </div>

    </div>
</section>

<section class="more-like-wrap">
    <h2>Similar Products</h2>
    <div class="more-like">
        <div class="owl-carousel owl-theme" id="similar-products">
            @foreach($similar_products as $similar)
            <div class="item">
                <ul>
                    <li>
                       @php
                      //$sim_product=App\Models\Product::find($similar->id);
                      $new_name=$slug = Str::slug($similar->name, '-');
                      $slug = str_replace(['(', ')'], '', $new_name); 
                      //dd($sim_product);
                             
                                      @endphp
                       <a href="{{ $similar->slug ? route('productDetail', $similar->slug) : '#' }}" class="product-img">

                            <img src="{{  isset($similar->product_images->first->image->image) ? config("app.url").Storage::url($similar->product_images->first->image->image) :asset('assets/images/logo.png') }}"
                                alt="owl1" />
                            <!-- <img src="{{asset('assets/images/pr1.jpg')}}" alt="owl1" /> -->
                            <span>{{$similar->name}}</span>
                            <span>₹{{$similar->original_price}}</span>
                        </a>
                    </li>
                </ul>
            </div>
            @endforeach

        </div>
    </div>
 
    <!--Modal-->
    <div class="modal fade size-chart" id="review" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="review">Review & Rating</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('postReview')}}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="id" value="{{$product->id}}" />
                        <div class="col">
                            <div class="rate">
                                <input type="radio" id="star5" class="rate" name="rating" value="5" />
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio" id="star4" class="rate" name="rating" value="4" />
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" class="rate" name="rating" value="3" />
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" class="rate" name="rating" value="2">
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" class="rate" name="rating" value="1" />
                                <label for="star1" title="text">1 star</label>
                            </div>
                        </div>

                        <textarea rows="12" class="form-control no-resize" name="review"
                            placeholder="Write your review here!"></textarea>



                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <!-- <button type="button" class="btn btn-primary">Submit</button> -->
                </div>
                </form>
            </div>
        </div>
    </div>

</section>
  

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function zoom(e){
  var zoomer = e.currentTarget;
  e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
  e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
  x = offsetX/zoomer.offsetWidth*100
  y = offsetY/zoomer.offsetHeight*150
  zoomer.style.backgroundPosition = x + '% ' + y + '%';
}
</script>

<script>
$(document).ready(function() {
    $('.address-pincode').submit(function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        // Get the pincode entered by the user
        var pincode = $('input[name="pincode"]').val();

        // Make an AJAX request to check the pincode
        $.ajax({
            type: 'POST',
            url: '{{ route('pincode') }}', // Replace with your actual route URL
            data: {
                _token: '{{ csrf_token() }}',
                pincode: pincode
            },
            success: function(response) {
                // Display the response message in the message div
                console.log(response)

                if (response.status == 404) {
                    $('#pincode-message').html(response.message).removeClass(
                        'success-message').addClass('error-message');;
                } else {
                    $('#pincode-message').html(response.message).removeClass(
                        'success-message').addClass('success-message');

                }


            },
            error: function() {
                // Handle errors here, e.g., display an error message
                $('#pincode-message').html('Error occurred while checking pincode.');
            }
        });
    });
});
</script>
<script>
	const viewBtn = document.querySelector(".view-modal-share"),
      popup = document.querySelector(".popup-s"),
      close = popup.querySelector(".close-s"),
      field = popup.querySelector(".field-s"),
      input = field.querySelector("input"),
      copy = field.querySelector(".copy-link");

viewBtn.onclick = ()=>{
  popup.classList.toggle("show");
}
close.onclick = ()=>{
  viewBtn.click();
}

copy.onclick = ()=>{
  input.select(); //select input value
  if(document.execCommand("copy")){ //if the selected text copy
    field.classList.add("active");
    copy.innerText = "Copied";
    setTimeout(()=>{
      window.getSelection().removeAllRanges(); //remove selection from document
      field.classList.remove("active");
      copy.innerText = "Copy";
    }, 3000);
  }
}
</script>
<style>
.rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}

.rate:not(:checked)>input {
    position: absolute;
    display: none;
}

.rate:not(:checked)>label {
    float: right;
    width: 1em;
    overflow: hidden;
    white-space: nowrap;
    cursor: pointer;
    font-size: 30px;
    color: #ccc;
}

.rated:not(:checked)>label {
    float: right;
    width: 1em;
    overflow: hidden;
    white-space: nowrap;
    cursor: pointer;
    font-size: 30px;
    color: #ccc;
}

.rate:not(:checked)>label:before {
    content: '★ ';
}

.rate>input:checked~label {
    color: #ffc700;
}

.rate:not(:checked)>label:hover,
.rate:not(:checked)>label:hover~label {
    color: #deb217;
}

.rate>input:checked+label:hover,
.rate>input:checked+label:hover~label,
.rate>input:checked~label:hover,
.rate>input:checked~label:hover~label,
.rate>label:hover~input:checked~label {
    color: #c59b08;
}

.star-rating-complete {
    color: #c59b08;
}

.rating-container .form-control:hover,
.rating-container .form-control:focus {
    background: #fff;
    border: 1px solid #ced4da;
}

.rating-container textarea:focus,
.rating-container input:focus {
    color: #000;
}

.rated {
    float: left;
    height: 46px;
    padding: 0 10px;
}

.rated:not(:checked)>input {
    position: absolute;
    display: none;
}

.rated:not(:checked)>label {
    float: right;
    width: 1em;
    overflow: hidden;
    white-space: nowrap;
    cursor: pointer;
    font-size: 30px;
    color: #ffc700;
}

.rated:not(:checked)>label:before {
    content: '★ ';
}

.rated>input:checked~label {
    color: #ffc700;
}

.rated:not(:checked)>label:hover,
.rated:not(:checked)>label:hover~label {
    color: #deb217;
}

.rated>input:checked+label:hover,
.rated>input:checked+label:hover~label,
.rated>input:checked~label:hover,
.rated>input:checked~label:hover~label,
.rated>label:hover~input:checked~label {
    color: #c59b08;
}
  
  
  
  
  
  
  
  
  
  
  
  
  
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');


::selection{
  color: #fff;
  background: #7d2ae8;
}
.view-modal-share, .popup-s{
  position: absolute;
  left: 50%;
}
.view-modal-share{
  outline: none;
  cursor: pointer;
  font-weight: 500;
  border-radius: 4px;
  border: 2px solid transparent;
  transition: background 0.1s linear, border-color 0.1s linear, color 0.1s linear;
}
  .view-modal-share:hover
  {
    color:#ee5786!important;
  }
.view-modal-share{
    top: 50%;
    right: -2%;
    color: #4a148c !important;
    font-size: 18px;
    padding: 0;
    background: #fff;
    transform: translate(-50%, -140%);
    font-size: 20px;
    left: initial;
}
  .view-modal-share i{
    margin-right:5px;
  }
.popup-s{
  background: #fff;
  padding: 25px;
  border-radius: 15px;
  top: -150%;
  max-width: 380px;
  width: 100%;
  opacity: 0;
  pointer-events: none;
  box-shadow: 0px 10px 15px rgba(0,0,0,0.1);
  transform: translate(-50%, -50%) scale(1.2);
  transition: top 0s 0.2s ease-in-out,
              opacity 0.2s 0s ease-in-out,
              transform 0.2s 0s ease-in-out;
}
.popup-s.show{
  top: 50%;
  opacity: 1;
  pointer-events: auto;
  transform:translate(-50%, -30%) scale(1);
  transition: top 0s 0s ease-in-out,
              opacity 0.2s 0s ease-in-out,
              transform 0.2s 0s ease-in-out;

}
.popup-s :is(header, .icons, .field){
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.popup-s header{
  padding-bottom: 0;
  border-bottom: 0;
}
header span{
  font-size: 15px;
  font-weight: 600;
}
header .close-s, .icons a{
  display: flex;
  align-items: center;
  border-radius: 50%;
  justify-content: center;
  transition: all 0.3s ease-in-out;
}
header .close-s{
  color: #878787;
  font-size: 17px;
  background: #f2f3fb;
  height: 33px;
  width: 33px;
  cursor: pointer;
}
header .close-s:hover{
  background: #ebedf9;
}
.popup-s .content-s{
  margin: 20px 0;
}
.popup-s .icons{
  margin: 15px 0 20px 0;
  padding:0;
}
.content-s p{
  font-size: 16px;
}
.content-s .icons a{
  height: 50px;
  width: 50px;
  font-size: 20px;
  text-decoration: none;
  border: 1px solid transparent;
}
.icons a i{
  transition: transform 0.3s ease-in-out;
}
.icons a:nth-child(1){
  color: #1877F2;
  border-color: #b7d4fb;
}
.icons a:nth-child(1):hover{
  background: #1877F2;
}
.icons a:nth-child(2){
  color: #46C1F6;
  border-color: #b6e7fc;
}
.icons a:nth-child(2):hover{
  background: #46C1F6;
}
.icons a:nth-child(3){
  color: #e1306c;
  border-color: #f5bccf;
}
.icons a:nth-child(3):hover{
  background: #e1306c;
}
.icons a:nth-child(4){
  color: #25D366;
  border-color: #bef4d2;
}
.icons a:nth-child(4):hover{
  background: #25D366;
}
.icons a:nth-child(5){
  color: #0088cc;
  border-color: #b3e6ff;
}
.icons a:nth-child(5):hover{
  background: #0088cc;
}
.icons a:hover{
  color: #fff;
  border-color: transparent;
}
.icons a:hover i{
  transform: scale(1.2);
}
.content-s .field-s{
  margin: 12px 0 -5px 0;
  height: 45px;
  border-radius: 4px;
  padding: 0 5px;
  border: 1px solid #e1e1e1;
  
    display: flex;
    align-items: center;
    padding-right: 12px;
}
  
.field-s.active{
  border-color: #7d2ae8;
}
.field-s i{
  width: 50px;
  font-size: 18px;
  text-align: center;
}
.field-s.active i{
  color: #7d2ae8;
}
.field-s input{
  width: 100%;
  height: 100%;
  border: none;
  outline: none;
  font-size: 15px;
}
.field-s .view-modal-share{
  color: #fff;
  padding: 5px 18px;
  background: #7d2ae8;
}
.field-s .view-modal-share:hover{
  background: #8d39fa;
}
 .social-share
   {
    position: relative;
    z-index: 9;
}
  
.popup-s.show header{
  justify-content:right;
} 
</style>
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