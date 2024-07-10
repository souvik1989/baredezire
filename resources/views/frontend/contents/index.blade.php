 @extends('frontend.master')
@section('title', "Buy Stylish Lingerie for Women Online in India")
@section('description','Bare Dezire offers lingerie for every occasion, our online lingerie shop featuring a range of trendy bras, panties, sportswear for every type and style.')
@section('keywords','Bra, Panties, Bikini, Sportswear, Cami, T-Shirt Bras, Camisole, Balconnette, Bralette, Push Up Bras, Padded Bras, Nonpadded Bras, Gymwear, Activewear, Shapewear, Offers, Lingerie, Innerwear, Bare Dezire')
@section('content')


<div class="main-banner">
    <div class="camera_wrap">
      
      @php
              $content = json_decode($section1->banner_id);
             
              @endphp
               @foreach($content as $id)
                @php
                $banner=App\Models\BannerImage::find($id);

                @endphp
      
      <div data-src="{{ isset($banner->banner_image) ? config("app.url").Storage::url($banner->banner_image)  : asset('adminAssets/img/default-image.png') }}">
        <img src="{{ isset($banner->banner_image) ? config("app.url").Storage::url($banner->banner_image)  : asset('adminAssets/img/default-image.png') }}">
        <div class="camera_caption">
        </div>
      </div>
      
      @endforeach
      
      
      
      
    </div>
</div>


<!--banner sec-->

{{-- <section class="banner d-none d-lg-block d-md-block d-sm-none">
    <div class="banner-grid">
        <!--<div class="banner-content">-->
        <!--    <h3>{{$section1->heading}}</h3>-->
        <!--    <h4>{{$section1->sub_heading}}</h4>-->
        <!--    <p>{{$section1->description}}</p>-->
        <!--    <a href="{{$section1->btn1_url}}" class="shopnow">{{$section1->btn1_text}}</a>-->
        <!--    <a href="{{$section1->btn2_url}}" class="arrival">{{$section1->btn2_text}}</a>-->
        <!--</div>-->
        <div class="banner-slider">
            <div id="banner-image" class="owl-carousel owl-theme">
              
              @php
              $content = json_decode($section1->banner_id);
             
              @endphp
               @foreach($content as $id)
                @php
                $banner=App\Models\BannerImage::find($id);

                @endphp
                 <div class="item">
                    <img src="{{ isset($banner->banner_image) ? config("app.url").Storage::url($banner->banner_image)  : asset('adminAssets/img/default-image.png') }}"
                        alt="image" />
                    <!-- <img src="{{asset('assets/images/banner1.jpg')}}" alt=""> -->
                </div>
                @endforeach
              
             
                   
               
            </div>
        </div>
    </div>
</section> --}}
<!-- banner end -->
<!--banner sec mobile-->
<section class="banner d-block d-sm-block d-md-none d-lg-none">
    <div class="banner-grid">

        <div class="banner-slider">
            <div id="banner-imageM" class="owl-carousel owl-theme">
               @php
              $content = json_decode($section1->banner_id);
             
              @endphp
               @foreach($content as $id)
                @php
                $banner=App\Models\BannerImage::find($id);

                @endphp
                 <div class="item">
                    <img src="{{ isset($banner->banner_image) ? config("app.url").Storage::url($banner->banner_image)  : asset('adminAssets/img/default-image.png') }}"
                        alt="image" />
                  
                </div>
                @endforeach
              
            </div>
      </div>
    </div>
</section>

<!--banner sec mobile-->
{{--<section class="banner d-block d-sm-block d-md-none d-lg-none">
    <div class="banner-grid">

        <div class="banner-slider">
            <div id="banner-imageM" class="owl-carousel owl-theme">
               @php
              $content = json_decode($section1->banner_id);
             
              @endphp
               @foreach($content as $id)
                @php
                $banner=App\Models\BannerImage::find($id);

                @endphp
                 <div class="item">
                    <img src="{{ isset($banner->banner_image) ? config("app.url").Storage::url($banner->banner_image)  : asset('adminAssets/img/default-image.png') }}"
                        alt="image" />
                    <!-- <img src="{{asset('assets/images/banner1.jpg')}}" alt=""> -->
                </div>
                @endforeach
                {{--<div class="item">
                    <img src="{{  isset($section1->image1) ? config("app.url").Storage::url($section1->image1) : asset('adminAssets/img/default-image.png') }}"
                        alt="image" />
                </div>
                <div class="item">
                    <img src="{{  isset($section1->image2) ? config("app.url").Storage::url($section1->image2) : asset('adminAssets/img/default-image.png') }}"
                        alt="image" />
                </div>
                <div class="item">
                    <img src="{{  isset($section1->image3) ? config("app.url").Storage::url($section1->image3) : asset('adminAssets/img/default-image.png') }}"
                        alt="image" />
                </div>--}}
            </div>
        </div>
        <!--<div class="banner-content">-->
        <!--    <h3>{{$section1->heading}}</h3>-->
        <!--    <h4>{{$section1->sub_heading}}</h4>-->
        <!--    <p>{{$section1->description}}</p>-->
        <!--    <a href="{{$section1->btn1_url}}" class="shopnow">{{$section1->btn1_text}}</a>-->
        <!--    <a href="{{$section1->btn2_url}}" class="arrival">{{$section1->btn2_text}}</a>-->
        <!--</div>-->
    </div>
</section>
<!-- banner end -->
 <!-- section-feature-slide -->
<section class="feature-slide">
  
<div class="container">
  <div id="feature-slide" class="owl-carousel owl-theme">
       @foreach($section10 as $sec)
       <div class="item">
        <a href="{{$sec->url ?? '#'}}">
        <div class="service-box">
          <div class="image">
            <img src="{{  isset($sec->image) ? config("app.url").Storage::url($sec->image) : asset('adminAssets/img/default-image.png') }}" alt="">
          </div>
          <div class="service-box-cont">
            <p>{{$sec->title ?? ''}}</p>
          </div>
        </div>
      </a>
      </div>
      @endforeach
      </div>
  </div>
  
  </section>
  <!-- section-feature-slide-end -->
<!-- section-feature-slide -->
  <section class="product-slide">
    <div class="container">
      <div id="product-slide" class="owl-carousel owl-theme">
         @foreach($section11 as $sec)
        <div class="item">
          <a href="{{$sec->url ?? '#'}}">
            <div class="service-box">
              <div class="image">
                <img src="{{  isset($sec->image) ? config("app.url").Storage::url($sec->image) : asset('adminAssets/img/default-image.png') }}" alt="">
              </div>
              <div class="service-box-cont">
                <p>{{$sec->title ?? ''}}</p>
              </div>
            </div>
          </a>
        </div>
         @endforeach
        
      </div>
    </div>
  </section>
  <!-- section-feature-slide-end -->
<section class="video-sec">

  <div class="container">
  
    <div class="video-wrap">

        <div class="row align-items-center">

          <div class="col-md-6">

            <div class="video">
              <video autoplay muted loop width="100%">
                        <source src="{{  isset($section3->image2) ? config("app.url").Storage::url($section3->image2) :asset('assets/videos/video1.mp4') }}" type="video/mp4">
              </video>
            </div>

          </div>


              <div class="video-content">
                <div id="video-slide" class="owl-carousel owl-theme">

                  <div class="item">
                          <p>{!!$section3->image1_text!!}</p>
                  </div>
                  <div class="item">
                          <p>{!! $section3->btn1_text!!}</p>
                  </div>
                  <div class="item">
                          <p>{!! $section3->btn1_url!!}</p>
                  </div>

                </div>
              </div>

          <div class="offset-md-2 col-md-4">
            <div class="video-img">
              <img src="{{  isset($section3->image1) ? config("app.url").Storage::url($section3->image1) : asset('adminAssets/img/default-image.png') }}" alt="">
            </div>
          </div>


        </div>           
       </div>

    </div>
  
</section>

<!-- fun -->
  <section class="fun">
    <div class="container">
      <div class="fun-wrap">
        <div class="row m-0">
          <div class="col-md-6 p-0">
            <a href="{{$section12->url ?? '#'}}">
              <div class="fun-wrap-box">
                <img src="{{  isset($section12->image) ? config("app.url").Storage::url($section12->image) : asset('adminAssets/img/default-image.png') }}" alt="">
              </div>
            </a>
          </div>
          <div class="col-md-6 p-0">
            <a href="{{$section12->url ?? '#'}}">
              <div class="fun-wrap-box">
                <img src="{{  isset($section12->image1) ? config("app.url").Storage::url($section12->image1) : asset('adminAssets/img/default-image.png') }}" alt="">
              </div>
            </a>
            <a href="{{$section12->url ?? '#'}}">
              <div class="fun-wrap-box pt-4 last-img">
                <img src="{{  isset($section12->image2) ? config("app.url").Storage::url($section12->image2) : asset('adminAssets/img/default-image.png') }}" alt="">
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- fun end-->
 <!-- feature -->
  {{--<section class="feature">
    <div class="feature-image">
      <img src="{{asset('adminAssets/img/feature.png') }}" alt="">
    </div>
  </section>--}}
  <!-- feature-end -->
<!-- collection -->
@php
$z=1;
$j=1;
@endphp
  
  

<section class="collection home-collection-wrap">
    <div class="container">
      <div class="section-head">
        <h3>Most Loved</h3>
      </div>
      <div id="product-slide2" class="owl-carousel owl-theme product-wrap">
         @foreach($products as $product)
        <div class="item">
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
             <a href="{{route('productDetail',[$product->slug])}}" title="{{$product->name}}"> <img
                        src="{{  isset($product->product_images->first()->image) ? config("app.url").Storage::url($product->product_images->first()->image) :asset('assets/images/sticker3.png') }}"
                        alt="{{ $product->name }}" /></a>

            <div class="cart-button">

              <div class="cart-heading">
               <a href="{{route('productDetail',[$product->slug])}}" title="{{$product->name}}"> <h4>{{ Str::limit($product->name, 30) }}</h4> </a>
              </div>
               <form action="{{route('addToCart')}}" method="POST" enctype="multipart/form-data">
 @csrf
                                   
              <p class="size-button text-right">
              <button class="btn" type="button" data-toggle="collapse" data-target="#SizeChart{{$z}}" aria-expanded="false" aria-controls="SizeChart{{$z}}">
                Select Size
              </button>
            </p>
            <div class="collapse sizechart-new" id="SizeChart{{$z}}">
              <div class="card card-body">


                  <input type="hidden" name="id" value="{{$product->id}}" />
                                     <input type="hidden" name="total" value="{{$product->original_price}}" />
                            <input type="hidden" name="discount" value="{{$product->original_price - $product->selling_price}}" />
                  <input type="hidden" name="quantity" value="1">
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
            </div>
              
              
              
              <div class="cart-info">
                <p>₹{{$product->selling_price}}</p>
               <button class="cart" type="submit" name="action" value="cart">Add to cart</button>
              </div>
                   </form>
            
            </div>
            
          
          </div>
        </div>
        
         @php
            $z++;
            @endphp
         @endforeach
      </div>
    </div>
  </section>
  <!-- collection-head -->

<section class="new-img-wrap">
  <div class="container">
    <div class="section-head">
        <h3>Most Loved</h3>
      </div>
    <img src="{{asset('assets/images/banner15.png')}}" alt="">
  </div>
</section>


<!-- category-1 -->
@php
$x=1;
$j=1;
@endphp
  
  

<section class="collection home-collection-wrap">
    <div class="container">
      
      <div id="product-slide3" class="owl-carousel owl-theme product-wrap">
         @foreach($products2 as $product)
        <div class="item">
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
             <a href="{{route('productDetail',[$product->slug])}}" title="{{$product->name}}"> <img
                        src="{{  isset($product->product_images->first()->image) ? config("app.url").Storage::url($product->product_images->first()->image) :asset('assets/images/sticker3.png') }}"
                        alt="{{ $product->name }}" /></a>

            <div class="cart-button">

              <div class="cart-heading">
               <a href="{{route('productDetail',[$product->slug])}}" title="{{$product->name}}"> <h4>{{ Str::limit($product->name, 30) }}</h4> </a>
              </div>
               <form action="{{route('addToCart')}}" method="POST" enctype="multipart/form-data">
 @csrf
                                   
              <p class="size-button text-right">
              <button class="btn" type="button" data-toggle="collapse" data-target="#SizeCharts{{$x}}" aria-expanded="false" aria-controls="SizeCharts{{$x}}">
                Select Size
              </button>
            </p>
            <div class="collapse sizechart-new" id="SizeCharts{{$x}}">
              <div class="card card-body">


                  <input type="hidden" name="id" value="{{$product->id}}" />
                                     <input type="hidden" name="total" value="{{$product->original_price}}" />
                            <input type="hidden" name="discount" value="{{$product->original_price - $product->selling_price}}" />
                  <input type="hidden" name="quantity" value="1">
                  <ul class="free-selected size_mar listNone Sizeslist normal radio-button"
                                        id="selectSize2">
                                        
                                        @foreach($product->product_sizes->sortBy('size') as $size)
                                      @php
                                        $inventory = App\Models\Inventory::where('product_id',$product->id)->where('product_size_id',$size->id)->first();
                                      @endphp
                                      @if(!empty($inventory) && $inventory->stock >0)
                                        <input type="radio" id="radios{{$j}}" name="size" value="{{$size->id}}">
                                        <label for="radios{{$j}}">{{$size->size}}</label>
                                      @else
                                      <input type="radio" id="radios{{$j}}" name="size" value="{{$size->id}}" disabled>
                                       <label for="radios{{$j}}" class="blur-label2">{{$size->size}}</label>
@endif
                                        @php
                                        $j++;
                                        @endphp
                                        @endforeach

                                    </ul>

                
              </div>
            </div>
              
              
              
              <div class="cart-info">
                <p>₹{{$product->selling_price}}</p>
               <button class="cart" type="submit" name="action" value="cart">Add to cart</button>
              </div>
                   </form>
            
            </div>
            
          
          </div>
        </div>
        
         @php
            $x++;
            @endphp
         @endforeach
      </div>
    </div>
  </section>


<section class="new-img-wrap part2">
  <div class="container">
    <div class="section-head">
        <h3>Most Loved</h3>
      </div>
    <img src="{{asset('assets/images/banner18.png')}}" alt="">
  </div>
</section>


<!-- category-2 -->
<section class="collection home-collection-wrap part2">
    <div class="container">
      <div id="product-slide4" class="owl-carousel owl-theme product-wrap">
         @foreach($products as $product)
        <div class="item">
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
             <a href="{{route('productDetail',[$product->slug])}}" title="{{$product->name}}"> <img
                        src="{{  isset($product->product_images->first()->image) ? config("app.url").Storage::url($product->product_images->first()->image) :asset('assets/images/sticker3.png') }}"
                        alt="{{ $product->name }}" /></a>

            <div class="cart-button">

              <div class="cart-heading">
               <a href="{{route('productDetail',[$product->slug])}}" title="{{$product->name}}"> <h4>{{ Str::limit($product->name, 30) }}</h4> </a>
              </div>
               <form action="{{route('addToCart')}}" method="POST" enctype="multipart/form-data">
 @csrf
                                   
              <p class="size-button text-right">
              <button class="btn" type="button" data-toggle="collapse" data-target="#SizeChart{{$x}}" aria-expanded="false" aria-controls="SizeChart{{$x}}">
                Select Size
              </button>
            </p>
            <div class="collapse sizechart-new" id="SizeChart{{$x}}">
              <div class="card card-body">


                  <input type="hidden" name="id" value="{{$product->id}}" />
                                     <input type="hidden" name="total" value="{{$product->original_price}}" />
                            <input type="hidden" name="discount" value="{{$product->original_price - $product->selling_price}}" />
                  <input type="hidden" name="quantity" value="1">
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
            </div>
              
              
              
              <div class="cart-info">
                <p>₹{{$product->selling_price}}</p>
               <button class="cart" type="submit" name="action" value="cart">Add to cart</button>
              </div>
                   </form>
            
            </div>
            
          
          </div>
        </div>
        
         @php
            $x++;
            @endphp
         @endforeach
      </div>
    </div>
  </section>

<section class="new-img-wrap">
  <div class="container">
    <div class="section-head">
        <h3>Most Loved</h3>
      </div>
    <img src="{{asset('assets/images/banner16.png')}}" alt="">
  </div>
</section>


<!-- category-3 -->
@php
$x=1;
$j=1;
@endphp
  
  

<section class="collection home-collection-wrap">
    <div class="container">
      <div id="product-slide5" class="owl-carousel owl-theme product-wrap">
         @foreach($products as $product)
        <div class="item">
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
             <a href="{{route('productDetail',[$product->slug])}}" title="{{$product->name}}"> <img
                        src="{{  isset($product->product_images->first()->image) ? config("app.url").Storage::url($product->product_images->first()->image) :asset('assets/images/sticker3.png') }}"
                        alt="{{ $product->name }}" /></a>

            <div class="cart-button">

              <div class="cart-heading">
               <a href="{{route('productDetail',[$product->slug])}}" title="{{$product->name}}"> <h4>{{ Str::limit($product->name, 30) }}</h4> </a>
              </div>
               <form action="{{route('addToCart')}}" method="POST" enctype="multipart/form-data">
 @csrf
                                   
              <p class="size-button text-right">
              <button class="btn" type="button" data-toggle="collapse" data-target="#SizeChart{{$x}}" aria-expanded="false" aria-controls="SizeChart{{$x}}">
                Select Size
              </button>
            </p>
            <div class="collapse sizechart-new" id="SizeChart{{$x}}">
              <div class="card card-body">


                  <input type="hidden" name="id" value="{{$product->id}}" />
                                     <input type="hidden" name="total" value="{{$product->original_price}}" />
                            <input type="hidden" name="discount" value="{{$product->original_price - $product->selling_price}}" />
                  <input type="hidden" name="quantity" value="1">
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
            </div>
              
              
              
              <div class="cart-info">
                <p>₹{{$product->selling_price}}</p>
               <button class="cart" type="submit" name="action" value="cart">Add to cart</button>
              </div>
                   </form>
            
            </div>
            
          
          </div>
        </div>
        
         @php
            $x++;
            @endphp
         @endforeach
      </div>
    </div>
  </section>



<section class="new-img-wrap part2">
  <div class="container">
    <div class="section-head">
        <h3>Most Loved</h3>
      </div>
    <img src="{{asset('assets/images/banner17.png')}}" alt="">
  </div>
</section>


<!-- category-4 -->

  
@php
$x=1;
$z=1;
$w=1;
$j=1;
@endphp
  
  

<section class="collection home-collection-wrap part2">
    <div class="container">
      
      <div id="product-slide6" class="owl-carousel owl-theme product-wrap">
         @foreach($products2 as $product)
        <div class="item">
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
             <a href="{{route('productDetail',[$product->slug])}}" title="{{$product->name}}"> <img
                        src="{{  isset($product->product_images->first()->image) ? config("app.url").Storage::url($product->product_images->first()->image) :asset('assets/images/sticker3.png') }}"
                        alt="{{ $product->name }}" /></a>

            <div class="cart-button">

              <div class="cart-heading">
               <a href="{{route('productDetail',[$product->slug])}}" title="{{$product->name}}"> <h4>{{ Str::limit($product->name, 30) }}</h4> </a>
              </div>
               <form action="{{route('addToCart')}}" method="POST" enctype="multipart/form-data">
 @csrf
                                   
            <p class="size-button text-right">
              <button class="btn" type="button" data-toggle="collapse" data-target="#SizeCharts{{$x}}" aria-expanded="false" aria-controls="SizeCharts{{$x}}">
                Select Size
              </button>
            </p>
            <div class="collapse sizechart-new" id="SizeCharts{{$x}}">
              <div class="card card-body">


                  <input type="hidden" name="id" value="{{$product->id}}" />
                                     <input type="hidden" name="total" value="{{$product->original_price}}" />
                            <input type="hidden" name="discount" value="{{$product->original_price - $product->selling_price}}" />
                  <input type="hidden" name="quantity" value="1">
                 <ul class="free-selected size_mar listNone Sizeslist normal radio-button"
                                        id="selectSize2">
                                        
                                        @foreach($product->product_sizes->sortBy('size') as $size)
                                      @php
                                        $inventory = App\Models\Inventory::where('product_id',$product->id)->where('product_size_id',$size->id)->first();
                                      @endphp
                                      @if(!empty($inventory) && $inventory->stock >0)
                                        <input type="radio" id="radios{{$j}}" name="size" value="{{$size->id}}">
                                        <label for="radios{{$j}}">{{$size->size}}</label>
                                      @else
                                      <input type="radio" id="radios{{$j}}" name="size" value="{{$size->id}}" disabled>
                                       <label for="radios{{$j}}" class="blur-label2">{{$size->size}}</label>
@endif
                                        @php
                                        $j++;
                                        @endphp
                                        @endforeach

                                    </ul>

                
         </div>
            </div>
              
                
               
              <div class="cart-info">
                <p>₹{{$product->selling_price}}</p>
               <button class="cart" type="submit" name="action" value="cart">Add to cart</button>
              </div>
                   </form>
            
            </div>
            
          
          </div>
        </div>
        
         @php
            $x++;
        $z++;
        $w++;
            @endphp
         @endforeach
      </div>
    </div>
  </section>




{{--<!-- latest-sec -->
<section class="latest-sec">
    <div class="container-fluid">
        <div class="latest-sec-wrap">
            <div class="latest-sec-wrap-box1">
                <a href="{{$section2->btn1_url}}">
                    <div class="img-box">
                        <img src="{{  isset($section2->image1) ? config("app.url").Storage::url($section2->image1) :asset('assets/images/ls1.jpg') }}"
                            alt="image" />
                        <!-- <img src="{{asset('assets/images/ls1.jpg')}}" alt=""> -->
                    </div>
                    <div class="img-box-details">
                        <img src="{{  isset($section2->btn_image) ? config("app.url").Storage::url($section2->btn_image) :asset('assets/images/right-arrows1.png') }}"
                            alt="image" />
                        <p>{{$section2->btn1_text}}</p>
                    </div>
                </a>
            </div>
            <div class="latest-sec-wrap-box2">
                <a href="{{$section2->btn2_url}}">
                    <div class="img-box">
                        <img src="{{  isset($section2->image2) ? config("app.url").Storage::url($section2->image2) :asset('assets/images/ls2.jpg') }}"
                            alt="image" />
                        <!-- <img src="{{asset('assets/images/ls2.jpg')}}" alt=""> -->
                    </div>
                    <div class="img-box-details">
                        <img src="{{  isset($section2->btn_image) ? config("app.url").Storage::url($section2->btn_image) :asset('assets/images/right-arrows1.png') }}"
                            alt="image" />
                        <p>{{$section2->btn2_text}}</p>
                    </div>
                </a>
            </div>
            <div class="latest-sec-wrap-box1">
                <a href="{{$section2->btn3_url}}">
                    <div class="img-box">
                        <img src="{{  isset($section2->image3) ? config("app.url").Storage::url($section2->image3) :asset('assets/images/ls3.jpg') }}"
                            alt="image" />
                        <!-- <img src="{{asset('assets/images/ls3.jpg')}}" alt=""> -->
                    </div>
                    <div class="img-box-details">
                        <img src="{{  isset($section2->btn_image) ? config("app.url").Storage::url($section2->btn_image) :asset('assets/images/right-arrows1.png') }}"
                            alt="image" />
                        <p>{{$section2->btn3_text}}</p>
                    </div>
                </a>
            </div>
            <div class="latest-sec-wrap-box2">
                <a href="{{$section2->btn4_url}}">
                    <div class="img-box">
                        <img src="{{  isset($section2->image4) ? config("app.url").Storage::url($section2->image4) :asset('assets/images/ls4.jpg') }}"
                            alt="image" />
                        <!-- <img src="{{asset('assets/images/ls4.jpg')}}" alt=""> -->
                    </div>
                    <div class="img-box-details">
                        <img src="{{  isset($section2->btn_image) ? config("app.url").Storage::url($section2->btn_image) :asset('assets/images/right-arrows1.png') }}"
                            alt="image" />
                        <p>{{$section2->btn4_text}}</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- latest-sec-end -->--}}
<!-- fun -->
  {{--<section class="fun">
    <div class="fun-wrap">
      <div class="row m-0">
        <div class="col-md-6 p-2">
          <a href="{{$section13->url ?? '#'}}">
            <div class="fun-wrap-box">
              <img src="{{  isset($section13->image) ? config("app.url").Storage::url($section13->image) : asset('adminAssets/img/default-image.png') }}" alt="">
            </div>
          </a>
          <a href="{{$section13->url1 ?? '#'}}">
            <div class="fun-wrap-box pt-5">
              <img src="{{  isset($section13->image1) ? config("app.url").Storage::url($section13->image1) : asset('adminAssets/img/default-image.png') }}" alt="">
            </div>
          </a>
        </div>
        <div class="col-md-6 p-2">
          <a href="{{$section13->url2 ?? '#'}}">
            <div class="fun-wrap-box">
              <img src="{{  isset($section13->image2) ? config("app.url").Storage::url($section13->image2) : asset('adminAssets/img/default-image.png') }}" alt="">
            </div>
          </a>

        </div>
      </div>

    </div>
  </section>--}}
  <!-- fun end-->

<!-- sale -->
  {{--<section class="sale">
    <a href="{{$section14->url ?? '#'}}"><img src="{{  isset($section14->image) ? config("app.url").Storage::url($section14->image) : asset('adminAssets/img/default-image.png') }}" alt=""></a>
  </section>--}}
  <!-- sale end -->

<section class="feature">
    <div class="feature-image">
      <img src="{{asset('assets/images/banner13.png')}}" alt="">
    </div>
  </section>

<!-- testimonial -->
 @php

                       $sumOfRatings = App\Models\Review::where('status', '1')
                 ->with('user') // Load the user relationship
                 ->get();

                   
                    @endphp
  <section class="combined-wraper">
    <div class="container">
        <div class="row">
            {{--<div class="col-md-6">
                <div class="left-img">
                   <img src="{{asset('assets/images/Banner-7.png')}}" alt="">
                </div>
            </div>--}}
            <div class="offset-md-7 col-md-5">
                <div class="testimonials-right">
                    <div class="heading">
                        <h2>
                            Customer's review
                        </h2>
                    </div>
                    <div class="testimonials-slider-wrap">
                        <div id="testimonials-slider" class="owl-carousel">
                            @foreach ($sumOfRatings as $review)
                                @php
                                    // Calculate the whole number of stars
                                    $wholeStars = floor($review->rating); // Whole stars
        
                                    // Determine if there's a half star
                                    $fractionalPart = $review->rating - $wholeStars; // Fractional part
                                    $hasHalfStar = $fractionalPart >= 0.5;
        
                                    // Calculate the empty stars to ensure a total of 5 stars
                                    $emptyStars = 5 - ($wholeStars + ($hasHalfStar ? 1 : 0));
                                @endphp
        
                                <div class="item">
                                    <div class="testimonials-slider-inner">
                                      <i class="fa fa-quote-left" aria-hidden="true"></i>
                                        <div class="testimonials-top">
                                            <div class="left-img">
                                                <img class="img-fluid" src="{{ asset('adminAssets/img/blank_user.png') }}"
                                                    alt="">
                                            </div>
                                            <div class="testm-right">
                                                <h4>{{ $review->user->name }}</h4>
                                                <div class="product-rating">
                                                    {{-- Render whole stars --}}
                                                    @for ($i = 0; $i < $wholeStars; $i++)
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    @endfor
        
                                                    {{-- Render half star if applicable --}}
                                                    @if ($hasHalfStar)
                                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                                    @endif
        
                                                    {{-- Render empty stars to maintain a total of 5 stars --}}
                                                    @for ($i = 0; $i < $emptyStars; $i++)
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <div class="testm-cont">
                                            <p>{{ $review->review }}</p>
                                        </div>
                                        <i class="fa fa-quote-right" aria-hidden="true"></i>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>     
    </div>
</section>


  <!-- testimonial-end -->

<!-- fun -->
{{--<section class="fun">
    <div class="section-head">
        <h1>{{$section3->heading}}</h1>
    </div>
    <div class="fun-wrap">
        <div class="row m-0">
            <div class="col-md-6 p-0">
                <div class="fun-wrap-box">
                    <img src="{{  isset($section3->image1) ? config("app.url").Storage::url($section3->image1) :asset('assets/images/fun1.jpg') }}"
                        alt="image" />
                    <!-- <img src="{{asset('assets/images/fun1.jpg')}}" alt=""> -->
                    <div class="fun-wrap-box-deatil">
                        <!-- <h4>{{$section3->image1_text}}</h4>-->
                        <a href="{{$section3->btn1_url}}">{{$section3->btn1_text}}<i class="fa fa-angle-right"
                                aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div class="fun-wrap-box">
                    <img src="{{  isset($section3->image2) ? config("app.url").Storage::url($section3->image2) :asset('assets/images/fun2.jpg') }}"
                        alt="image" />
                    <!-- <img src="{{asset('assets/images/fun2.jpg')}}" alt=""> -->
                    <div class="fun-wrap-box-deatil">
                        <!--<h4>{{$section3->image2_text}}</h4>-->
                        <a href="{{$section3->btn2_url}}">{{$section3->btn2_text}}<i class="fa fa-angle-right"
                                aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- fun end-->

<!-- feature -->
<section class="feature">
    <div class="container">
        <div class="feature-wrap">
             <div class="row">
                <div class="col-md-4 col-4">
                    <div class="feature-wrap-box">
                        <a href="{{$section9->url1}}">
                            <img src="{{  isset($section9->image1) ? config("app.url").Storage::url($section9->image1) :asset('assets/images/sticker1.png') }}"
                                alt="image" />
                            <!-- <img src="{{asset('assets/images/sticker1.png')}}" alt=""> -->
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-4">
                    <div class="feature-wrap-box">
                        <a href="{{$section9->url2}}">
                            <img src="{{  isset($section9->image2) ? config("app.url").Storage::url($section9->image2) :asset('assets/images/sticker2.png') }}"
                                alt="image" />
                            <!-- <img src="{{asset('assets/images/sticker2.png')}}" alt=""> -->
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-4">
                    <div class="feature-wrap-box">
                        <a href="{{$section9->url3}}">
                            <img src="{{  isset($section9->image3) ? config("app.url").Storage::url($section9->image3) :asset('assets/images/sticker3.png') }}"
                                alt="image" />
                            <!-- <img src="{{asset('assets/images/sticker3.png')}}" alt=""> -->
                        </a>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</section>
<!-- feature-end -->
@php
$x=1;
$j=1;
@endphp
<!-- collection -->
<section class="collection">
    <div class="container-fluid">
        <div class="section-head">
            <h3>new collection</h3>
        </div>
        <div class="product-wrap">
            @foreach($products as $product)
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
                <a href="{{route('productDetail',[$product->slug])}}" title="{{$product->name}}"> <img
                        src="{{  isset($product->product_images->first()->image) ? config("app.url").Storage::url($product->product_images->first()->image) :asset('assets/images/sticker3.png') }}"
                        alt="{{ $product->name }}" />
                    <h4>{{ Str::limit($product->name, 30) }}</h4></a>
                    <div class="price">
                        <p class="price-original">₹{{$product->selling_price}}</p>
                        <p class="price-drop">₹{{$product->original_price}}</p>
                    </div>
                    <span class="note">(inclusive of all taxes)</span>
              <div class="wrapper">

                <div class="icon-wishlist"></div>

              </div>
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
                    <!--<form action="{{route('addToWish')}}" method="POST" enctype="multipart/form-data">-->
                    <!--  @csrf-->
                    <!--<input type="hidden" name="id" value="{{$product->id}}" />-->
                    <a href="#"  data-target="#size-modal{{$x}}" data-toggle="modal" class="buy">Buy Now</a>
<!--</form>-->
                </div>
                
                <div class="modal fade size-chart" id="size-modal{{$x}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="size-modal{{$x}}">Select Size</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
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
                                <button type="submit" name="action" value="cart" class="btn btn-primary">Go To Cart</button>
                                <!-- <button type="button" class="btn btn-primary">Submit</button> -->
                                 <button type="submit" class="btn" name="action" value="buy">Buy Now</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--END MODAL-->
            </div>
            @php
            $x++;
            @endphp
            @endforeach
        </div>
    </div>
</section>
<!-- collection-head -->




<!-- bra -->
<section class="fun">
    <div class="section-head">
        <h3>{{$section4->heading}}</h3>
    </div>
    <div class="fun-wrap">
        <div class="row m-0">
            <div class="col-md-6 p-0">
                <div class="fun-wrap-box">
                    <img src="{{  isset($section4->image1) ? config("app.url").Storage::url($section4->image1) :asset('assets/images/bra1.jpg') }}"
                        alt="image" />
                    <!-- <img src="{{asset('assets/images/bra1.jpg')}}" alt=""> -->
                    <div class="fun-wrap-box-deatil">
                        <!-- <h4>{{$section4->image1_text}}</h4>-->
                        <a href="{{$section4->btn1_url}}">{{$section4->btn1_text}}<i class="fa fa-angle-right"
                                aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div class="fun-wrap-box">
                    <img src="{{  isset($section4->image2) ? config("app.url").Storage::url($section4->image2) :asset('assets/images/bra2.jpg') }}"
                        alt="image" />
                    <!-- <img src="{{asset('assets/images/bra2.jpg')}}" alt=""> -->
                    <div class="fun-wrap-box-deatil">
                        <!-- <h4>{{$section4->image2_text}}</h4>-->
                        <a href="{{$section4->btn2_url}}">{{$section4->btn2_text}}<i class="fa fa-angle-right"
                                aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- bra end-->


<!-- shapewear -->
<section class="shapewear">
    <div class="shapewear-bg">
        <img src="{{  isset($section5->image) ? config("app.url").Storage::url($section5->image) :asset('assets/images/shapewear-bg.jpg') }}"
            alt="image" />
        <!-- <img src="{{asset('assets/images/shapewear-bg.jpg')}}" alt=""> -->
    </div>
    <div class="shapewear-content">
        <!-- <h3>{{$section5->heading}}</h3>-->
        <!-- <p>{{$section5->desc}}</p>-->
        <a href="{{$section5->btn_url}}">{{$section5->btn_text}}<i class="fa fa-angle-right" aria-hidden="true"></i></a>
    </div>
</section>
<!-- shapewear end -->

<!-- secret -->
<section class="secret">
    <div class="container-fluid">
        <div class="secret-header text-center">
            <h3>{{$section6->heading}}</h3>
            <!-- <p>{{$section6->sub_heading}}</p>-->
        </div>
        <div class="secret-wrap">
                    <!-- <div class="secret-wrap-box">
                        <img src="{{  isset($section6->image1) ? config("app.url").Storage::url($section6->image1) :asset('assets/images/sa1.png') }}"
                            alt="image" />
                        <h4>{{$section6->image1_heading}}</h4>
                        <p>{{$section6->image1_text}} </p>
                    </div>
                    <div class="secret-wrap-box">
                        <img src="{{  isset($section6->image2) ? config("app.url").Storage::url($section6->image2) :asset('assets/images/sa2.png') }}"
                            alt="image" />
                        <h4>{{$section6->image2_heading}}</h4>
                        <p>{{$section6->image2_text}}</p>
                    </div>
                    <div class="secret-wrap-box">
                        <img src="{{  isset($section6->image3) ? config("app.url").Storage::url($section6->image3) :asset('assets/images/sa3.png') }}"
                            alt="image" />
                        <h4>{{$section6->image3_heading}}</h4>
                        <p>{{$section6->image3_text}}</p>
                    </div>-->
                   <div class="secret-wrap-box">
                        <img src="{{ asset('assets/images/img1.png') }}"
                            alt="image" />
                        <h4>Intricate Design</h4>
                    </div>
          <div class="secret-wrap-box">
                        <img src="{{ asset('assets/images/img2.png') }}"
                            alt="image" />
                        <h4>Delicate Embroidery</h4>
                    </div>
          <div class="secret-wrap-box">
                        <img src="{{ asset('assets/images/img3.png') }}"
                            alt="image" />
                        <h4>Diverse Taste</h4>
                    </div>
          <div class="secret-wrap-box">
                        <img src="{{ asset('assets/images/img4.png') }}"
                            alt="image" />
                        <h4>Unique Lacework</h4>
                    </div>
          <div class="secret-wrap-box">
                        <img src="{{ asset('assets/images/img5.png') }}"
                            alt="image" />
                        <h4>Vibrant Colours</h4>
                    </div>
          <div class="secret-wrap-box">
                        <img src="{{ asset('assets/images/img6.png') }}"
                            alt="image" />
                        <h4>Variety of Fabrics</h4>
                    </div>
          <div class="secret-wrap-box">
                        <img src="{{ asset('assets/images/img7.png') }}"
                            alt="image" />
                        <h4>Cultural Fusion</h4>
                    </div>
          <div class="secret-wrap-box">
                        <img src="{{ asset('assets/images/img8.png') }}"
                            alt="image" />
                        <h4>Comfort and Fit</h4>
                    </div>
          <div class="secret-wrap-box">
                        <img src="{{ asset('assets/images/img9.png') }}"
                            alt="image" />
                        <h4>Affordable and Accessible</h4>
                    </div>
                <!--<div class="col-md-3">-->
                <!--    <div class="secret-wrap-box">-->
                <!--        <img src="{{  isset($section6->image4) ? config("app.url").Storage::url($section6->image4) :asset('assets/images/sa4.png') }}"-->
                <!--            alt="image" />-->
                <!--        <h4>{{$section6->image4_heading}}</h4>-->
                <!--        <p>{{$section6->image4_text}}</p>-->
                <!--    </div>-->
                <!--</div>-->
        </div>
    </div>
</section>
<!-- secret end -->


<!-- shopnow -->
 <section class="shopnow-sec">
    <div class="row m-0 align-items-center">
        <div class="col-md-6 p-0">
            <img src="{{  isset($section7->image) ? config("app.url").Storage::url($section7->image) :asset('assets/images/shopnow.jpg') }}"
                alt="image" style="width: 100%;" />
        </div>
        <div class="col-md-6 p-0">
            <div class="shopnow-sec-content">
                <h4>{{$section7->heading}}</h4>
                <p>{{$section7->desc}}</p>
                <a href="{{$section7->btn_url}}">{{$section7->btn_text}}<i class="fa fa-angle-right"
                        aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</section>
<!-- shopnow-end -->


<!-- testimonial -->
<section class="testimonial text-center">
    <div class="container">
        <div class="testimonial-header">
            <h3>{{$section8->heading}}</h3>
        </div>
        <div id="testimonial-slider" class="owl-carousel owl-theme">
            <div class="item">
                <p>{{$section8->desc}}<br><br> <span>
                        {{$section8->name}}</span></p>
            </div>
            <div class="item">
                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. " <br><br> <span>
                        - P.R.Noida</span></p>
            </div>
        </div>
    </div>
</section>
<!-- testimonial-end -->--}}
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