<!-- banner-inner-end -->

<section class="cart-section order-details">
    <div class="container">
        <div class="cart-wrap">
            <div class="row">
                <div class="col-md-12 col-lg-7 col-xl-7">
                    <div class="cart-wrap-left">

                        @foreach($order->products as $prod)
                        @php
                        $product=App\Models\Product::find($prod->id);

                        @endphp
                        <div class="cart-wrap-box">
                            <div class="cart-wrap-box-img">
                               @php
                                   
              $new_name=$slug = Str::slug($product->name, '-');
                      $slug = str_replace(['(', ')'], '', $new_name);                
                                      @endphp
                                <a href="{{route('productDetail',[$product->slug])}}"><img
                                        src="{{  isset($product->product_images->first->image->image) ? config("app.url").Storage::url($product->product_images->first->image->image) :asset('assets/images/fun2.jpg') }}"
                                        alt="owl1" /></a>
                            </div>
                            <div class="cart-wrap-box-content">
                                <p>{{ Str::limit($product->name, 50) }}</p>
                                <div class="cart-wrap-box-content-detail">
                                    <p><span>Order No:</span> {{$order->order_number}}</p>
                                   <p><span>SKU:</span> {{$product->sku}}</p>
                                    <p><span>Qty:</span>{{$order->products()
    ->where('products.id', $prod->id)
    ->first()
    ->pivot
    ->quantity}}</p> @php
                                  $size=$order->products()
    ->where('products.id', $prod->id)
    ->first()
    ->pivot
    ->size;
                                   $p_size=App\Models\ProductSize::find($size);
                                  @endphp
                                    <p><span>Size:</span>{{$p_size->size ?? '--'}}</p>
                                   
                                    
                                </div>

                            </div>
                            <div class="price">
                                <p>₹ {{$product->original_price * $order->products()
    ->where('products.id', $prod->id)
    ->first()
    ->pivot
    ->quantity}}.00</p>
                            </div>
                        </div>
                        @endforeach


                    </div>
                </div>

                <div class="col-md-12 col-lg-5 col-xl-5">
                    <div class="cart-wrap-right">
                        <div class="payment-details order-details-price">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Total</th>
                                        <th>₹ {{$price}}.00</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        <td>Discount</td>
                                        <td>₹ {{$discount}}.00</td>
                                    </tr>
                                    @if ($order->coupon_dis !== null && $order->buy2get1 !== null)
                                    <tr>
                                        <th>Sub Total</th>
                                        <th>₹ {{$price-$discount-$order->coupon_dis-$order->buy2get1}}.00</th>
                                    </tr>
                                   @elseif ($order->coupon_dis !== null)
                                  <tr>
                                        <th>Sub Total</th>
                                        <th>₹ {{$price-$discount-$order->coupon_dis}}.00</th>
                                    </tr>
                                   @elseif ($detail->buy2get1 !== null)
                                   <tr>
                                        <th>Sub Total</th>
                                        <th>₹ {{$price-$discount-$order->buy2get1}}.00</th>
                                    </tr>
                                  @else
                                   <tr>
                                        <th>Sub Total</th>
                                        <th>₹ {{$price-$discount}}.00</th>
                                    </tr>
                                  @endif
                                  
                                    
                                    @if($order->buy2get1 !== null)
                                  <tr>
                                        <td>Buy 2 Get 1 Deal</td>
                                        <td>₹ {{$order->buy2get1}}.00</td>
                                    </tr>
                                  @endif
                                     @if($order->coupon_dis !== null)
                                  <tr>
                                        <td>Coupon({{$order->coupon_code}})</td>
                                        <td>₹ {{$order->coupon_dis}}.00</td>
                                    </tr>
                                  @endif
                                    <tr>
                                        <td>Estimated Tax</td>
                                        <td>₹ {{$tax}}.00</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping Charge</td>
                                        <td>Free</td>
                                    </tr>
                                    @if($order->coupon_dis !== null)
                                 @if($order->buy2get1 !== null)
                                    <tr>
                                        <td> Gift
                                            Wrap</td>
                                        @if(($order->total_price) > ($price-$discount+$tax-$order->coupon_dis-$order->buy2get1))
                                        <td>₹ 35.00</td>
                                        @else
                                        <td>₹ 00.00</td>
                                        @endif
                                    </tr>
                                  @else
                                   <tr>
                                        <td> Gift
                                            Wrap</td>
                                        @if(($order->total_price) > ($price-$discount+$tax-$order->coupon_dis))
                                        <td>₹ 35.00</td>
                                        @else
                                        <td>₹ 00.00</td>
                                        @endif
                                    </tr>
                                  @endif
                                  @else
                                    @if($order->buy2get1 !== null)
                                  <tr>
                                        <td> Gift
                                            Wrap</td>
                                        @if($price > ($price-$discount+$tax-$order->buy2get1))
                                        <td>₹ 35.00</td>
                                        @else
                                        <td>₹ 00.00</td>
                                        @endif
                                    </tr>
                                  @else
                                  <tr>
                                        <td> Gift
                                            Wrap</td>
                                        @if($price > ($price-$discount+$tax))
                                        <td>₹ 35.00</td>
                                        @else
                                        <td>₹ 00.00</td>
                                        @endif
                                    </tr>
                                  @endif
                                  @endif
                                 {{-- ///////////
                                    @if($order->coupon_dis !== null)
                                    <tr>
                                        <td> Gift
                                            Wrap</td>
                                        @if(($order->total_price) > ($price-$discount+$tax-$order->coupon_dis))
                                        <td>₹ 35.00</td>
                                        @else
                                        <td>₹ 00.00</td>
                                        @endif
                                    </tr>
                                  @else
                                  <tr>
                                        <td> Gift
                                            Wrap</td>
                                        @if($order->total_price > ($price-$discount+$tax))
                                        <td>₹ 35.00</td>
                                        @else
                                        <td>₹ 00.00</td>
                                        @endif
                                    </tr>
                                  @endif --}}
                                  
                                    <tr>
                                        <td>Payable Amount</td>
                                        <td>₹{{$order->total_price}}.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="order-status">
                        <h3 class="text-center">Order Detail</h3>

                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="order-list-status">
                                    <p><span>Customer Name:</span>{{$order->user->ship_address->first_name}} {{$order->user->ship_address->last_name}}<i
                                            class="fa fa-check-circle-o" aria-hidden="true"></i>
                                    </p>
                                      <p><span>Customer Email:</span>{{$order->user->ship_address->email}}<i
                                            class="fa fa-check-circle-o" aria-hidden="true"></i>
                                    </p>
                                    <p><span>Customer Phone:</span>{{$order->user->ship_address->mobile}}<i
                                            class="fa fa-check-circle-o" aria-hidden="true"></i>
                                    </p>
                                    <p><span>Customer Shipping Address:</span>{{$order->user->ship_address->shipping_address_line1}} , {{$order->user->ship_address->shipping_address_line2}} , <br>{{$order->user->ship_address->shipping_city}} , {{$order->user->ship_address->shipping_state}} , {{$order->user->ship_address->shipping_zip}},  {{$order->user->ship_address->shipping_country}}<i
                                            class="fa fa-check-circle-o" aria-hidden="true"></i>
                                    </p>
                                    <p><span>Order Placed:</span>{{$order->created_at->format('Y-m-d')}}<i
                                            class="fa fa-check-circle-o" aria-hidden="true"></i>
                                    </p>
                                    <p><span>Estemated
                                            Delivery:</span>{{$order->created_at->addDays(3)->format('Y-m-d')}}<i
                                            class="fa fa-check-circle-o" aria-hidden="true"></i>
                                    </p>
                                    @if($order->status == 'order_placed')
                                    <p><span>Order Status:</span>Order Placed<i class="fa fa-check-circle-o"
                                            aria-hidden="true"></i>

                                    </p>
                                    @elseif($order->status == 'in_transit')
                                    <p><span>Order Status:</span>In Transit <i class="fa fa-spinner"
                                            aria-hidden="true"></i>


                                    </p>
                                    @elseif($order->status == 'completed')
                                    <p><span>Order Status:</span>Delivered <i class="fa fa-check-circle"
                                            aria-hidden="true"></i>

                                    </p>
                                    @else
                                    <p><span>Order Status:</span>Cancelled
                                        <i class="fa fa-times" aria-hidden="true"></i>

                                    </p>
                                    @endif
                                    <p><span>Payment
                                            Mode:</span>{{isset($order->payment_method) && $order->payment_method=='cod'? 'Cash on Delivery(COD)':(isset($order->payment_method) && $order->payment_method=='icici_pay'? 'Paid':"" )}}
                                    </p>
                                    @if($order->payment_status == 'pending')
                                    <p><span>Payment Status:</span>Pending <i class="fa fa-spinner"
                                            aria-hidden="true"></i>
                                    </p>
                                    @elseif($order->payment_status == 'confirmed')
                                    <p><span>Payment Status:</span>Paid<i class="fa fa-check-circle-o"
                                            aria-hidden="true"></i>


                                    </p>
                                    @else
                                    <p><span>Payment Status:</span>Cancelled
                                        <i class="fa fa-times" aria-hidden="true"></i>

                                    </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                               

                                @if($order->status== 'cancelled')
                                <div class="cancel">
                                  @php 
                                $carbonDate = \Carbon\Carbon::parse($order->cancelled_at);
                                        
                                        $dateOnly = $carbonDate->format('Y-m-d');
                                        @endphp
                                    <p><span>Order cancelled on:</span>{{$dateOnly}}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="modal fade size-chart" id="size-modal1" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="size-modal1">Are you sure about cancelling this order?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('cancel.order',$order->id)}}" method="POST"
                            enctype="multipart/form-data">

                            @csrf
                            <textarea rows="12" class="form-control form-control
      
      
      
      no-resize" name="notes" placeholder="Mention Reason for your cancellation!(Optional)"></textarea>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" data-dismiss="modal" class="btn btn-primary">Back</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <button type="submit" class="btn btn-primary">{{isset($order) ? 'Update' : 'Create'}}</button>
  <a class="btn btn-dark" href="{{ route('order.index') }}">Cancel</a>
</section>