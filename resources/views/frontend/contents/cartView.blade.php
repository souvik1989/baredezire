@extends('frontend.master')
@section('title', 'Cart View')
@section('content')
    <!-- banner-inner -->
    <section class="inner-banner">
        <div class="container-fluid">
            <div class="inner-header">
                <div class="inner-header-menu">
                    <ul>
                        <li><a href="{{ route('dashboard') }}">Home</a></li>
                        <li><a href="{{ route('cartView') }}">Cart</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- banner-inner-end -->
    @if (auth()->check())
        @if ($carts->isEmpty())


            <div class="empty-cart">
                <p>{{ 'Cart is empty!!' }}</p>
            </div>
        @else
            <section class="cart-section">
                <div class="container">
                    <div class="cart-wrap">
                        <form action="{{ route('removeCart') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="Delete Delete-1">Clear Cart<i class="fa fa-trash-o"
                                    aria-hidden="true"></i></button>
                        </form>
                    
                        <div class="row">
                            <div class="col-md-12 col-lg-8 col-xl-8">
                                <div class="cart-wrap-left">
                                    @php
                                    $totalOfferQuantity = 0;
                                    $offerDiscount = 0;
                                    $productPrice = 0;
                                
                                  @endphp
                                    @foreach ($carts as $cart)
                                        @php
                                            $product = App\Models\Product::find($cart->product_id);
                                                 if ($product->is_offer === 0) {
                                                        // Increment the total offer quantity for each product with an offer status
                                                        $totalOfferQuantity += $cart->quantity;
                                                        $productPrice = $product->original_price;
                                                    }
                                        @endphp
                                        <div class="cart-wrap-box">
                                            <div class="cart-wrap-box-img">
                                                @php

                                                    $new_name = $slug = Str::slug($product->name, '-');
                                                    $slug = str_replace(['(', ')'], '', $new_name);
                                                @endphp
                                                <a href="{{ route('productDetail', [$product->slug]) }}"><img
                                                        src="{{ isset($product->product_images->first->image->image) ? config('app.url') . Storage::url($product->product_images->first->image->image) : asset('assets/images/fun2.jpg') }}"
                                                        alt="owl1" /></a>
                                            </div>
                                            <div class="cart-wrap-box-content">
                                                @php
                                                    
                                                    $size = App\Models\ProductSize::find($cart->size);
                                                    $inventory = App\Models\Inventory::where('product_id', $product->id)
                                                        ->where('product_size_id', $size->id)
                                                        ->first();
                                                   
                                                @endphp
                                                <p><span class="special"> {{ Str::limit($product->name, 50) }}</span></p>
                                                <p><span class="special">Size:</span> {{ $size->size ?? '--' }}</p>
                                                <ul class="cart-wrap-box-content-buttons myClass">
                                                    <li>
                                                        <p><span class="special">Qty:</span>

                                                            <button class="decrease{{ $product->id }}"
                                                                id="d-{{ $product->id }}"
                                                                onclick="decrement({{ $product->id }},{{ $cart->id }})"
                                                                data-id="{{ $cart->id }}"
                                                                data-product="{{ $product->id }}">-</button>

                                                            <input class="quantity" id="demoInput{{ $cart->id }}"
                                                                type="number" value="{{ $cart->quantity }}" min="1"
                                                                max="1">


                                                            <button class="increase{{ $product->id }}"
                                                                id="i-{{ $product->id }}"
                                                                onclick="increment({{ $product->id }},{{ $cart->id }})"
                                                                data-product="{{ $product->id }}"
                                                                data-id="{{ $cart->id }}">+</button>


                                                        </p>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('saveLater', $cart->id) }} " method="POST">
                                                            @csrf


                                                            <p><button type="submit" class="Confirm"><i
                                                                        class="fa fa-heart-o" aria-hidden="true"></i>Save
                                                                    For
                                                                    Later</button></p>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('removeItem', $cart->id) }} " method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <p><button type="submit" class="Delete"><i
                                                                        class="fa fa-trash-o"
                                                                        aria-hidden="true"></i>Remove</button></p>
                                                        </form </li>
                                                </ul>
                                            </div>
                                            <div>
                                                <p class="price" id="price{{ $cart->id }}">₹
                                                    {{ $product->original_price * $cart->quantity }}.00</p>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- <div class="cart-wrap-box">
                    <div class="cart-wrap-box-img">
                      <a href="#"><img src="{{ asset('assets/images/fun2.jpg') }}" alt=""></a>
                    </div>
                    <div class="cart-wrap-box-content">
                      <p>Low Impact Cotton Non-Padded Non-Wired Sports Bra in...</p>
                      <ul class="cart-wrap-box-content-buttons">
                        <li><p><span>Qty:</span><button onclick="decrement()">-</button> <input id=demoInput type=number min=1 max=99>
                          <button onclick="increment()">+</button>
                        </p></li>
                        <li><p><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i>Save For Later</a></p></li>
                        <li><p><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i>Remove</a></p></li>
                      </ul>
                    </div>
                    <div class="price">
                      <p>₹ 245.00</p>
                    </div>
                  </div>
                  <div class="cart-wrap-box">
                    <div class="cart-wrap-box-img">
                      <a href="#"><img src="{{ asset('assets/images/fun2.jpg') }}" alt=""></a>
                    </div>
                    <div class="cart-wrap-box-content">
                      <p>Low Impact Cotton Non-Padded Non-Wired Sports Bra in...</p>
                      <ul class="cart-wrap-box-content-buttons">
                        <li><p><span>Qty:</span><button onclick="decrement()">-</button> <input id=demoInput type=number min=1 max=99>
                          <button onclick="increment()">+</button>
                        </p></li>
                        <li><p><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i>Save For Later</a></p></li>
                        <li><p><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i>Remove</a></p></li>
                      </ul>
                    </div>
                    <div class="price">
                      <p>₹ 245.00</p>
                    </div>
                  </div> -->
                                </div>
                            </div>
                            @php
                                // Calculate the offer discount based on the total offer quantity
                                if ($totalOfferQuantity >= 3) {
                                    // Calculate the offer discount for every 3rd product in multiples of 3
                                    $offerDiscount = floor($totalOfferQuantity / 3) * $productPrice;
                                }
                              // dd($totalOfferQuantity);
                            @endphp
                            <div id="pincode-message" class=""></div>
                            <div class="col-md-12 col-lg-4 col-xl-4">
                                <form action="{{ route('postCart') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="cart-wrap-right">
                                        <div class="checkout-button">
                                            <button type="submit" class="btn">Proceed to checkout</button>
                                        </div>

                                        <div class="payment-details">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Total</th>
                                                        <th id="total">₹ {{ number_format($price, 2) ?? '0.00' }}</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td>Discount</td>
                                                        <td id="discount">₹ {{ number_format($discount, 2) ?? '0.00' }}
                                                        </td>
                                                    </tr>
                                                  @if($totalOfferQuantity >= 3)
                                                  <tr>
                                                        <td>Buy 2 Get 1 Discount</td>
                                                        <td id="discount">₹ {{ number_format($offerDiscount, 2) ?? '0.00' }}
                                                        </td>
                                                    </tr>
                                                  @endif
                                                    @if (session()->has('coupon'))
                                                        <tr>
                                                            <td> Coupon ({{ session()->get('coupon')['name'] }})<button
                                                                    id="remove">Remove</button>

                                                            </td>
                                                            <td id="coupon">₹
                                                                {{ number_format(session()->get('coupon')['discount'], 2) }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @if (session()->has('coupon'))
                                                  @if($totalOfferQuantity >= 3)
                                                        <tr class="special">
                                                            <th>Sub Total</th>
                                                            <th>₹
                                                                {{ number_format($price - $discount-$offerDiscount - session()->get('coupon')['discount'], 2) ?? '0.00' }}
                                                            </th>
                                                        </tr>
                                                  @else
                                                  <tr class="special">
                                                            <th>Sub Total</th>
                                                            <th>₹
                                                                {{ number_format($price - $discount - session()->get('coupon')['discount'], 2) ?? '0.00' }}
                                                            </th>
                                                        </tr>
                                                  @endif
                                                    @else
                                                   @if($totalOfferQuantity >= 3)
                                                        <tr class="special">
                                                            <th>Sub Total</th>
                                                            <th>₹ {{ number_format($price -$offerDiscount- $discount, 2) ?? '0.00' }}</th>
                                                        </tr>
                                                  @else
                                                  <tr class="special">
                                                            <th>Sub Total</th>
                                                            <th>₹ {{ number_format($price - $discount, 2) ?? '0.00' }}</th>
                                                        </tr>
                                                  @endif
                                                    @endif
                                                    <tr>
                                                        <td>GST</td>
                                                        <td>₹ {{ number_format($tax, 2) ?? '00' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping Charge</td>
                                                        <td>Free</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="checkbox" id="giftWrap" name="giftWrap"
                                                                value="yes"><label for="giftWrap"> Gift
                                                                Wrap</label></td>
                                                        <td>₹ 35</td>
                                                    </tr>
                                                    @if (session()->has('coupon'))
                                                   @if($totalOfferQuantity >= 3)
                                                        <tr>
                                                            <td>Payable Amount</td>
                                                            <td>₹<span id="payableAmount">
                                                                    {{ round($price - $discount -$offerDiscount- session()->get('coupon')['discount'] + $tax) ?? '00' }}</span>
                                                            </td>
                                                        </tr>
                                                  @else
                                                  <tr>
                                                            <td>Payable Amount</td>
                                                            <td>₹<span id="payableAmount">
                                                                    {{ round($price - $discount - session()->get('coupon')['discount'] + $tax) ?? '00' }}</span>
                                                            </td>
                                                        </tr>
                                                  @endif
                                                    @else
                                                   @if($totalOfferQuantity >= 3)
                                                        <tr>
                                                            <td>Payable Amount</td>
                                                            <td>₹<span id="payableAmount">
                                                                    {{ round($price -$offerDiscount- $discount + $tax) ?? '00' }}</span></td>
                                                        </tr>
                                                  @else
                                                  <tr>
                                                            <td>Payable Amount</td>
                                                            <td>₹<span id="payableAmount">
                                                                    {{ round($price - $discount + $tax) ?? '00' }}</span></td>
                                                        </tr>
                                                  @endif
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <input type="hidden" name="total" value="{{ $price }}" />
                                        <input type="hidden" name="discount" value="{{ $discount }}" />
                                               <input type="hidden" name="offer" value="{{ $offerDiscount }}" />
                                       <input type="hidden" name="offerqty" value="{{ $totalOfferQuantity }}" />


@if (!session()->has('coupon'))
                                    <div class="offer-sec mb-3">
                                        
                                        <div class="coupon-button-wrap align-items-baseline">
                                            <p><img src="{{ asset('assets/images/discount.png') }}" alt="">Apply
                                                Coupon</p>
                                            <p class="text-right"><a href="#"data-target="#size-modal1"
                                                    data-toggle="modal">View Offers</a></p>
                                        </div>
                                        <form action="{{ route('couponCheck') }}" method="post">
                                            @csrf
                                            <div class="apply-form">
                                                <input type="hidden" name="total" value="{{ $price }}" />
                                                <input type="text" name="code" id="code"
                                                    placeholder="Have A Coupon? Type here">
                                                <button type="submit" class="btn">Apply</button>
                                            </div>
                                        </form>

                                    </div>
                                @endif



                                        <div class="checkout-button mb-3">
                                            <button type="submit" class="btn">Proceed to checkout</button>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                            <!-- Modal -->
                            <div class="modal fade size-chart" id="size-modal1" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="size-modal1">Offers and coupons!</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach ($coupons as $coupon)
                                                <p class="order_Place">Coupon code:{{ $coupon->code }}</p>
                                      

                                                <div class="modal-body-cont">
                                                    @if ($coupon->type == 'amount')
                                                        <!-- Note the quotes around 'amount' -->
                                                        <p class="order_Place">Get ₹ {{ $coupon->value }} off</p>
                                                    @else
                                                        <p class="order_Place">Get {{ $coupon->percent }}% off</p>
                                                </div>
                                            @endif

                                            <form action="{{ route('couponCheck') }}" method="post">
                                                @csrf

                                                <input type="hidden" name="total" value="{{ $price }}" />
                                                <input type="hidden" name="code" id="code"
                                                    value="{{ $coupon->code }}">
                                                <button type="submit" class="btn">Add</button>

                                            </form>
                                               @endforeach
                                        </div>
   



        <p class="order_Place">Copy the coupon code you want and paste it in coupon section!</p>
                                      <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-primary">Dismiss</button>

        </div>
        </div>
        

        </div>
        </div>
        </div>
        <!--END MODAL-->



        </div>

        </div>

        </div>
        </section>
        <!-- collection-head -->

    @endif
@else
    @if (empty(session('cart')))

        <div class="empty-cart">
            <p>{{ 'Cart is empty!!' }}</p>
        </div>
    @else
        <section class="cart-section">
            <div class="container">
                <div class="cart-wrap">
                    <form action="{{ route('removeCartSession') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="Delete Delete-1">Clear Cart<i class="fa fa-trash-o"
                                aria-hidden="true"></i></button>
                    </form>
                    <div class="row">
                        <div class="col-md-12 col-lg-8 col-xl-8">
                            <div class="cart-wrap-left">
                                @foreach (session('cart') as $index => $cartItem)
                                    @php
                                        $product = App\Models\Product::find($cartItem['product_id']);
                                    @endphp
                                    <div class="cart-wrap-box">
                                        <div class="cart-wrap-box-img">
                                            @php

                                                $new_name = $slug = Str::slug($product->name, '-');
                                                $slug = str_replace(['(', ')'], '', $new_name);
                                            @endphp
                                            <a href="{{ route('productDetail', [$product->slug]) }}"><img
                                                    src="{{ isset($product->product_images->first->image->image) ? config('app.url') . Storage::url($product->product_images->first->image->image) : asset('assets/images/fun2.jpg') }}"
                                                    alt="owl1" /></a>
                                        </div>
                                        <div class="cart-wrap-box-content">
                                            @php
                                                $size = App\Models\ProductSize::find($cartItem['size']);
                                                $inventory_cart = App\Models\Inventory::where('product_id', $product->id)
                                                    ->where('product_size_id', $size->id)
                                                    ->first();
                                            @endphp
                                            <p><span class="special">{{ Str::limit($product->name, 50) }}</span></p>
                                            <p><span class="special">Size:</span> {{ $size->size ?? '--' }}</p>
                                            <ul class="cart-wrap-box-content-buttons myClass">
                                                <li>
                                                    <p><span class="special">Qty:</span>
                                                        <button class="decrease{{ $product->id }}"
                                                            id="ds-{{ $product->id }}"
                                                            onclick="decrements({{ $product->id }}, {{ $index }})"
                                                            data-id="{{ $index }}"
                                                            data-product="{{ $product->id }}">-</button>
                                                        <input class="quantity" id="demoInputs{{ $index }}"
                                                            type="number" value="{{ $cartItem['quantity'] }}" min=1
                                                            max=10>
                                                        <button class="increase{{ $product->id }}"
                                                            id="is-{{ $product->id }}"
                                                            onclick="increments({{ $product->id }}, {{ $index }})"
                                                            data-product="{{ $product->id }}"
                                                            data-id="{{ $index }}">+</button>
                                                    </p>
                                                </li>
                                                <li>
                                                    <form action="#" method="POST">

                                                        <p><button type="button"><i class="fa fa-heart-o"
                                                                    aria-hidden="true"></i>Save For
                                                                Later</button></p>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route('removeCartItem', $index) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="Delete">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i> Remove
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        <div>
                                            <p class="price" id="price{{ $index }}">₹
                                                {{ $product->original_price * $cartItem['quantity'] }}.00</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="pincode-message" class=""></div>
                        <div class="col-md-12 col-lg-4 col-xl-4">
                            <form action="{{ route('postCart') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="cart-wrap-right">
                                    <div class="checkout-button">
                                        <button type="submit" class="btn">Proceed to checkout</button>
                                    </div>

                                    <div class="payment-details">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Total</th>
                                                    <th id="total">₹ {{ number_format($price, 2) ?? '0.00' }}</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>Discount ({{ $percent }}%)</td>
                                                    <td id="discount">₹ {{ number_format($discount, 2) ?? '0.00' }}</td>
                                                </tr>
                                                @if (session()->has('coupon'))
                                                    <tr>
                                                        <td> Coupon ({{ session()->get('coupon')['name'] }})<button
                                                                id="remove">Remove</button>
                                                        </td>
                                                        <td id="coupon">₹
                                                            {{ number_format(session()->get('coupon')['discount'], 2) }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if (session()->has('coupon'))
                                                    <tr class="special">
                                                        <th>Sub Total</th>
                                                        <th>₹
                                                            {{ number_format($price - $discount - session()->get('coupon')['discount'], 2) ?? '0.00' }}
                                                        </th>
                                                    </tr>
                                                @else
                                                    <tr class="special">
                                                        <th>Sub Total</th>
                                                        <th>₹ {{ number_format($price - $discount, 2) ?? '0.00' }}</th>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td>GST (5%)</td>
                                                    <td>₹ {{ $tax ?? '00' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Shipping Charge</td>
                                                    <td>Free</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="checkbox" id="giftWrap" name="giftWrap"
                                                            value="yes"><label for="giftWrap"> Gift
                                                            Wrap</label></td>
                                                    <td>₹ 35</td>
                                                </tr>
                                                @if (session()->has('coupon'))
                                                    <tr>
                                                        <td>Payble Amount</td>
                                                        <td>₹<span id="payableAmount">
                                                                {{ round($price - $discount - session()->get('coupon')['discount'] + $tax) ?? '00' }}</span>
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td>Payable Amount</td>
                                                        <td>₹<span id="payableAmount">
                                                                {{ round($price - $discount + $tax) ?? '00' }}</span></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="hidden" name="total" value="{{ $price }}" />
                                    <input type="hidden" name="discount" value="{{ $discount }}" />







                                    <div class="checkout-button mb-5">
                                        <button type="submit" class="btn">Proceed to checkout</button>
                                    </div>
                                </div>
                            </form>




                        </div>

                    </div>

                </div>
        </section>
        <!-- collection-head -->

    @endif

    @endif

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#remove').click(function(e) {
                e.preventDefault(); // Prevent the form from submitting normally

                $.ajax({
                    type: 'POST',
                    url: '{{ route('coupon.remove') }}', // Replace with your actual route URL
                    data: {
                        _token: '{{ csrf_token() }}',

                    },
                    success: function(response) {
                        // Display the response message in the message div
                        console.log(response)

                        /*if (response.status == 404) {
                            $('#pincode-message').html(response.message).removeClass(
                                'success-message').addClass('error-message');;
                        } else {
                            $('#pincode-message').html(response.message).removeClass(
                                'success-message').addClass('success-message');

                        }*/
                        setTimeout(function() {
                            location.reload();
                        }, 2000);


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

    <script>
        $('.Confirm').on('click', function(e) {

            e.preventDefault();
            //alert(0);
            var single = $(this);

            iziToast.question({
                overlay: true,
                toastOnce: true,
                id: 'question',
                title: 'Hey',
                message: 'Do you want to add this product to wishlist?',
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script>
        $(document).ready(function() {
            $('#giftWrap').change(function() {
                var giftWrapAmount = 35;
                var currentPayableAmount = parseFloat($('#payableAmount').text().replace('₹ ', ''));

                if ($(this).prop('checked')) {
                    currentPayableAmount += giftWrapAmount;
                } else {
                    currentPayableAmount -= giftWrapAmount;
                }

                $('#payableAmount').text(currentPayableAmount.toFixed(2));
            });
        });
    </script> -->

    {{-- <script>
    $(document).ready(function () {
        $('#giftWrap').click(function () {
            var payableAmount = parseFloat($('#payableAmount').text().replace('₹ ', ''));

            if ($(this).prop('checked')) {
                var newPayableAmount = payableAmount + 35;
                $('#payableAmount').text(newPayableAmount.toFixed(2));
                
                if (confirm('Do you want to add Rs 35 as Gift wrap amount to the payable amount?')) {
                    // Handle user confirmation here, if needed
                } else {
                    $(this).prop('checked', false);
                    $('#payableAmount').text(payableAmount.toFixed(2));
                }
            } else {
                var newPayableAmount = payableAmount - 35;
                $('#payableAmount').text( newPayableAmount.toFixed(2));
            }
        });
    });
</script> --}}
    <script>
        $(document).ready(function() {
            // Function to update payable amount based on checkbox state
            function updatePayableAmount() {
                var giftWrapChecked = localStorage.getItem('giftWrapChecked') === 'true';
                $('#giftWrap').prop('checked', giftWrapChecked);

                if (giftWrapChecked) {
                    var payableAmount = parseFloat($('#payableAmount').text().replace('₹ ', ''));
                    var newPayableAmount = payableAmount + 35;
                    $('#payableAmount').text(newPayableAmount.toFixed(2));
                }
            }

            // Initialize payable amount based on checkbox state
            updatePayableAmount();

            // Handle checkbox click event
            $('#giftWrap').off('click').on('click', function() {
                var giftWrapChecked = $(this).prop('checked');
                localStorage.setItem('giftWrapChecked', giftWrapChecked);

                if (giftWrapChecked) {
                    var payableAmount = parseFloat($('#payableAmount').text().replace('₹ ', ''));
                    var newPayableAmount = payableAmount + 35;
                    $('#payableAmount').text(newPayableAmount.toFixed(2));

                    if (!confirm('Do you want to add Rs 35 as Gift wrap amount to the payable amount?')) {
                        $(this).prop('checked', false);
                        $('#payableAmount').text(payableAmount.toFixed(2));
                    }
                } else {
                    var payableAmount = parseFloat($('#payableAmount').text().replace('₹ ', ''));
                    var newPayableAmount = payableAmount - 35;
                    $('#payableAmount').text(newPayableAmount.toFixed(2));
                }
            });

            // Listen for window unload event to clear localStorage
            $(window).on('unload', function() {
                localStorage.removeItem('giftWrapChecked');
            });
        });
    </script>



    {{-- <script>
    function updateQuantity(cartId, newQuantity) {
        $.ajax({
            url: "{{ route('update.quantity') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                cart_id: cartId,
                quantity: newQuantity
            },
            success: function (data) {
                
                        console.log(data)
                        if (data.status == 200) {
                            window.location.reload();
                           // const quantitySpan = document.querySelector('#price'+data.cart);
                //const priceSpan = button.closest('.cart-wrap-box-content').siblings().find('.price');
               // quantitySpan.textContent = '$'+parseInt(data.price*data.quantity) +'.00';
                           
                        iziToast.success({
                            title: 'Success',
                            message: data.message,
                            position:'topCenter'
                        })
                    }else{
                        iziToast.error({
                            title: 'Error',
                            message: data.message,
                            position:'topCenter'
                        });
                    }
                    
            },
            error: function() {
                // Handle error case
            }
        });
    }
    function increment(productId, cartId) {
        var input = $('#demoInput' + cartId);
        var newQuantity = parseInt(input.val()) + 1;
        if (newQuantity <= 10) {
            // Update input field and quantity in the database
            input.val(newQuantity);
            updateQuantity(cartId, newQuantity);
        }
    }

    function decrement(productId, cartId) {
        var input = $('#demoInput' + cartId);
        var newQuantity = parseInt(input.val()) - 1;
        if (newQuantity >= 1) {
            // Update input field and quantity in the database
            input.val(newQuantity);
            updateQuantity(cartId, newQuantity);
        }
    }
</script> --}}
    <script>
        function updateQuantity(cartId, newQuantity) {
            $.ajax({
                url: "{{ route('update.quantity') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    cart_id: cartId,
                    quantity: newQuantity
                },
                success: function(data) {

                    console.log(data)
                    if (data.status == 200) {
                        window.location.reload();
                        // const quantitySpan = document.querySelector('#price'+data.cart);
                        //const priceSpan = button.closest('.cart-wrap-box-content').siblings().find('.price');
                        // quantitySpan.textContent = '$'+parseInt(data.price*data.quantity) +'.00';

                        iziToast.success({
                            title: 'Success',
                            message: data.message,
                            position: 'topCenter'
                        })
                    } else {
                        iziToast.error({
                            title: 'Error',
                            message: data.message,
                            position: 'topCenter'
                        });
                    }

                },
                error: function() {
                    // Handle error case
                }
            });
        }

        function increment(productId, cartId) {
            var input = $('#demoInput' + cartId);
            var newQuantity = parseInt(input.val()) + 1;
            if (newQuantity <= {{ $inventory->stock ?? 10 }}) {
                // Update input field and quantity in the database
                input.val(newQuantity);
                updateQuantity(cartId, newQuantity);
            }
        }

        function decrement(productId, cartId) {
            var input = $('#demoInput' + cartId);
            var newQuantity = parseInt(input.val()) - 1;
            if (newQuantity >= 1) {
                // Update input field and quantity in the database
                input.val(newQuantity);
                updateQuantity(cartId, newQuantity);
            }
        }
    </script>



    <script>
        function updateQuantitySession(index, newQuantity) {
            $.ajax({
                url: "{{ route('quantity.session') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    index: index,
                    quantity: newQuantity
                },
                success: function(data) {
                    if (data.status == 200) {
                        window.location.reload();
                        // const quantitySpan = document.querySelector('#price'+data.cart);
                        //const priceSpan = button.closest('.cart-wrap-box-content').siblings().find('.price');
                        // quantitySpan.textContent = '$'+parseInt(data.price*data.quantity) +'.00';

                        iziToast.success({
                            title: 'Success',
                            message: data.message,
                            position: 'topCenter'
                        })
                    } else {
                        iziToast.error({
                            title: 'Error',
                            message: data.message,
                            position: 'topCenter'
                        });
                    }
                },
                error: function() {
                    alert('An error occurred.');
                }
            });
        }

        function increments(productId, index) {
            var input = $('#demoInputs' + index);
            var newQuantity = parseInt(input.val()) + 1;
            if (newQuantity <= {{ $inventory_cart->stock ?? 10 }}) {
                input.val(newQuantity);
                updateQuantitySession(index, newQuantity);
            }
        }

        function decrements(productId, index) {
            var input = $('#demoInputs' + index);
            var newQuantity = parseInt(input.val()) - 1;
            if (newQuantity >= 1) {
                input.val(newQuantity);
                updateQuantitySession(index, newQuantity);
            }
        }
    </script>
@endsection
