@extends('frontend.master')
@section('title', $category->meta_title ?? "Product Category")
@section('description', $category->meta_description ?? '')
@section('keywords', $category->meta_tags ?? '')
@section('content')
<!-- banner-inner -->
<section class="inner-banner">
    <div class="container-fluid">
        <div class="inner-header">
            <div class="inner-header-menu">
                <ul>
                    <li><a href="{{route('dashboard')}}">Home</a></li>
                    <li><a href="{{route('maincategory-product',[$category->parent->parent->slug])}}">{{$category->parent->parent->name}}</a></li>
                    <li>
                        <p>{{$category->name}}</p>
                    </li>
                </ul>
            </div>
            
        </div>
        <div class="breadcrumb-2">
            <img src="{{  isset($category->banner_image) ? config("app.url").Storage::url($category->banner_image) : asset('assets/images/Bare-Desire-Banner-Design.png') }}"
                alt="">

            <!-- <div class="inner-content">
                <h3>{{$category->name}}</h3>

                {!!$category->description!!}


            </div> -->
        </div>
    </div>
</section>
<!-- banner-inner-end -->
<section class="filter-wrap-mobile d-block d-sm-block d-md-block d-lg-none">
    <div class="row">
        <div class="col-6 p-0">
            <a href="#" class="more part1" data-toggle="modal" data-target="#exampleModal2">Sort By</a>
        </div>
        <div class="col-6 p-0">
            <a href="#" class="more" data-toggle="modal" data-target="#exampleModal">Show Filter</a>
        </div>
    </div>
</section>
@if(isset($selectedFilterNames))
<section class="filter-remove-wrap">
  <div class="container-fluid">
    <div class="filter-remove">
      <span class="alignfilter">You Have Selected:</span>
      <div id="id_selected_filter">
          <ul>
              @foreach($selectedFilterNames as $id=>$filter)
              <li class="sect-close selected-filter">{{ $filter }}<a href="#" onclick="removeFilter({{ $id }})"><i class="fa fa-times" aria-hidden="true"></i></a></li>
              @endforeach
          </ul>
      </div>
    </div>
    <a class="all-close" href="#" onclick="clearAllFilters()">Clear All Filter</a>
  </div>
</section>
@endif
@if(isset($segment) && $segment=='sorting')
<section class="clear-wrap">
    <div class="container-fluid">
      <a class="all-close" href="#" onclick="clearAllFilters()">Clear Filter</a>
  </div>
</section>
@endif
@if(!isset($selectedFilterNames))
<section class="filter-wrap d-none d-lg-block d-md-none d-sm-none">
    <div class="container-fluid">
        <div class="row">
           <div class="col-md-8">
               <div class="sorting-sec">
                   <p> Sort By : </p>
                 <span class="sorting-item">
                    <a href="{{route('category.sorting',[$category->parent->parent->slug,$category->slug,'low-to-high'])}}" class="more">Low to high</a>
                 </span>
                 <span class="sorting-item">
                    <a href="{{route('category.sorting',[$category->parent->parent->slug,$category->slug,'high-to-low'])}}" class="more">High to low</a>
                 </span>
                 <span class="sorting-item">
                    <a href="{{route('category.sorting',[$category->parent->parent->slug,$category->slug,'new-arrivals'])}}" class="more">New arrivals</a>
                 </span>
                 <span class="sorting-item">
                    <a href="{{route('category.sorting',[$category->parent->parent->slug,$category->slug,'most-viewed'])}}" class="more">Most viewed</a>
                 </span>
                 <span class="sorting-item">
                    <a href="#5" class="more">Best seller</a>
                 </span>
                 <span class="sorting-item">
                    <a href="#6" class="more">Discount</a>
                 </span>
               </div>
           </div> 
           <div class="col-md-4">
               <div class="filter-btn">
                    <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-filter" aria-hidden="true"></i> Show Filters</a>
               </div>
           </div> 
        </div>
    </div>
</section>
@endif
<div class="modal fade filter-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
        <form id="filterForm" action="{{ route('filter.cat.fetchProducts') }}" method="get">
                              
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <section class="service-wrap">
            <div class="container">
              <div class="row">
                 
                <div class="col-md-3 col-5">
                  <div class="privacy-sec">
                    <nav>
                      <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            @foreach($parentCategoriesWithChildren as $parentCategoryName => $childCategories)
                       {{-- @foreach($f_categories->where('level', 0) as $parentCategoryName)--}}
                        <a class="nav-item nav-link {{ $loop->first ? 'active' : '' }}" id="nav-{{ $parentCategoryName }}-tab" data-toggle="tab" href="#nav-{{ $parentCategoryName }}" role="tab"
                          aria-controls="nav-{{ $parentCategoryName }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{$parentCategoryName}}</a>
                          @endforeach
                        <!--<a class="nav-item nav-link" id="nav-front-end-tab" data-toggle="tab" href="#nav-front-end" role="tab"-->
                        <!--  aria-controls="nav-front-end" aria-selected="false">Color</a>-->
                        <!--<a class="nav-item nav-link" id="nav-database-tab" data-toggle="tab" href="#nav-database" role="tab"-->
                        <!--  aria-controls="nav-database" aria-selected="false">Collection</a>-->
                        <!--<a class="nav-item nav-link" id="nav-database-tab2" data-toggle="tab" href="#nav-database2" role="tab"-->
                        <!--  aria-controls="nav-database" aria-selected="false">Coverage</a>-->
                        <!--<a class="nav-item nav-link" id="nav-database-tab3" data-toggle="tab" href="#nav-database3" role="tab"-->
                        <!--  aria-controls="nav-database" aria-selected="false">Fabric</a>-->
                        <!--<a class="nav-item nav-link" id="nav-database-tab4" data-toggle="tab" href="#nav-database4" role="tab"-->
                        <!--  aria-controls="nav-database" aria-selected="false">Occasion</a>-->
                        <!--<a class="nav-item nav-link" id="nav-database-tab5" data-toggle="tab" href="#nav-database5" role="tab"-->
                        <!--  aria-controls="nav-database" aria-selected="false">Others</a>-->
                        <!--<a class="nav-item nav-link" id="nav-database-tab6" data-toggle="tab" href="#nav-database6" role="tab"-->
                        <!--  aria-controls="nav-database" aria-selected="false">Padding</a>-->
                      </div>
                    </nav>
                  </div>
                </div>
                
                <div class="col-md-9 col-7">
                  <div class="tab-content" id="nav-tabContent">
                      @foreach($parentCategoriesWithChildren as $parentCategoryName => $childCategories)
                  {{--  @foreach($f_categories->where('level', 0) as $childCategories)--}}
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="nav-{{ $parentCategoryName }}" role="tabpanel" aria-labelledby="nav-{{ $parentCategoryName }}-tab">
                   {{-- <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="nav-{{ $childCategories->name }}" role="tabpanel" aria-labelledby="nav-{{ $childCategories->name }}-tab">--}}
                        <div class="row">
                         
                             @foreach($childCategories as $childCategory)
                          
                            <div class="col-md-3 col-6 p-0">
                              <div class="filter-box">
                                <label>
                                   <input type="checkbox" value="{{ $childCategory->id }}" name="filter_category_ids[]"><span>{{ $childCategory->name }}</span>
                                </label>
                              </div>  
                            </div>
                            @endforeach
                       
                        </div>
                    </div>
                      @endforeach
                   
                  </div>
                </div>
              </div>
            </div>
          </section>
            <input type="hidden" name="category_id" value="{{$category->id}}" />
      <div class="modal-footer">
          <button type="button" class="apply" id="clear">Clear All</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="apply" data-category-id="{{ $category->id }}">Apply</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
@if(!isset($selectedFilterNames))
<div class="modal fade sorting-modal" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sorting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="sorting-sec">
          <span class="sorting-item">
                     <a href="{{route('category.sorting',[$category->parent->parent->slug,$category->slug,'low-to-high'])}}" class="more">Low to high</a>
          </span>
          <span class="sorting-item">
                    <a href="{{route('category.sorting',[$category->parent->parent->slug,$category->slug,'high-to-low'])}}" class="more">High to low</a>
          </span>
          <span class="sorting-item">
                    <a href="{{route('category.sorting',[$category->parent->parent->slug,$category->slug,'new-arrivals'])}}" class="more">New arrivals</a>
          </span>
          <span class="sorting-item">
                    <a href="{{route('category.sorting',[$category->parent->parent->slug,$category->slug,'most-viewed'])}}" class="more">Most viewed</a>
          </span>
          <span class="sorting-item">
                    <a href="#5" class="more">Best seller</a>
          </span>
          <span class="sorting-item">
                    <a href="#6" class="more">Discount</a>
          </span>
               </div>
      <div class="modal-footer">
        <!--  <button type="button" class="apply">Clear All</button>-->
        <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>-->
        <!--<button type="button" class="apply">Apply</button>-->
      </div>
    </div>
  </div>
</div>
</div>
@endif
<div class="container-fluid">
    <section class="feature">
    <div class="container">
        <div class="feature-wrap">
            <div class="row">
                <div class="col-md-4 col-4">
                    <div class="feature-wrap-box">
                        <a href="{{$section9->url1}}">
                            <img src="{{  isset($section9->image1) ? config("app.url").Storage::url($section9->image1) :asset('assets/images/sticker1.png') }}"
                                alt="image" />
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-4">
                    <div class="feature-wrap-box">
                        <a href="{{$section9->url2}}">
                            <img src="{{  isset($section9->image2) ? config("app.url").Storage::url($section9->image2) :asset('assets/images/sticker1.png') }}"
                                alt="image" />
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-4">
                    <div class="feature-wrap-box">
                        <a href="{{$section9->url3}}">
                            <img src="{{  isset($section9->image3) ? config("app.url").Storage::url($section9->image3) :asset('assets/images/sticker1.png') }}"
                                alt="image" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

<!-- feature-end -->
<!-- collection -->
<section class="collection">
    <div class="container-fluid">

      <div class="product-description-text">
        <p class="text-center">
          {!!$category->description ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'!!}
        </p>
      </div>
        <div class="product-wrap inner">
            @if($data_count !==0)
            @php
            $x=1;
            $j=1;
            @endphp
            @foreach($categoryProducts as $product)
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
               @php
                                   
              $new_name=$slug = Str::slug($product->name, '-');
                      $slug = str_replace(['(', ')'], '', $new_name);                
                                      @endphp
              
              
                <a href="{{route('productDetail',[$product->slug])}}" title="{{$product->name}}"><img
                        src="{{  isset($product->product_images->first->image->image) ? config("app.url").Storage::url($product->product_images->first->image->image) :asset('assets/images/pr1.jpg') }}"
                        alt="owl1" />

                    <h4>{{ Str::limit($product->name, 50) }}</h4> </a>
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
              <div class="allproduct-inner-wrap">
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
                     {{--<a href="#"  data-target="#size-modal{{$x}}" data-toggle="modal" class="buy">Buy Now</a>--}}
<!--                    <form action="{{route('addToWish')}}" method="POST" enctype="multipart/form-data">-->
<!--                      @csrf-->
<!--                    <input type="hidden" name="id" value="{{$product->id}}" />-->
<!--                    <button type="submit" class="buy">Buy Now</button>-->
<!--</form>-->
                </div>
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
                    @php
                    $x++;
                    @endphp
                </div>
            </div>
            @endforeach
            @else
             <div class="empty-cart"><p>{{'Coming Soon!'}}</p></div>
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

<script>
    function clearAllFilters() {
        window.location.href = "{{ route('category-product',[$category->parent->parent->slug,$category->slug]) }}";
    }
</script>
<script>
   // Listen for form submission
document.getElementById('filterForm').addEventListener('submit', function(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Get the selected filter category names
    var selectedFilters = [];
    var checkboxes = document.querySelectorAll('input[name="filter_category_ids[]"]:checked');
    checkboxes.forEach(function(checkbox) {
        selectedFilters.push(checkbox.nextElementSibling.textContent.trim());
    });

    // Construct the URL with selected filter category names
    var url = "{{ route('filter.cat.fetchProducts') }}?";
    selectedFilters.forEach(function(filter, index) {
        if (index !== 0) {
            url += "&";
        }
        url += "filterNames=" + encodeURIComponent(filter);
    });

    // Set the form action to the constructed URL
    this.action = url;

    // Submit the form
    this.submit();
});

</script>
<script>
    function removeFilter(filterId) {
        var url = "{{ route('filter.cat.fetchProducts') }}?";
        var params = new URLSearchParams(window.location.search);

        // Remove the filter with the specified ID
        params.delete('filter_category_ids[]', filterId);

        // Reconstruct the URL without the removed filter
        params.forEach(function(value, key) {
            url += key + '=' + value + '&';
        });

        // Remove the trailing '&' character
        url = url.slice(0, -1);

        // Check if there are no more filters left
        if (params.getAll('filter_category_ids[]').length === 0) {
            // Redirect to the main category route
            window.location.href = "{{ route('category-product',[$category->parent->parent->slug,$category->slug]) }}";
        } else {
            // Redirect to the updated URL with remaining filters
            window.location.href = url;
        }
    }
</script>

@endsection