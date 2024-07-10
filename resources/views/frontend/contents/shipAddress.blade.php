@extends('frontend.master')
@section('title', "Edit Shipping Address")
@section('content')


<section class="cart-section">
    <div class="container">
    <form action="{{route('saveAddress')}}" method="POST" enctype="multipart/form-data">
      @csrf
        <div class="cart-wrap">
            <div class="form__name">Shipping and Billing Form</div>

            <div class="row">
                <div class="col-md-12 col-lg-8 col-xl-8">
                    <div class="cart-wrap-left">
                        <div class="form__container">
                            <section class="form__personal">
                                <div class="sections">
                                    <div class="box">1</div><span>Personal Information</span>
                                </div>
                                <div class="shipping--form">
                                    
                                        <div class="row one">
                                            <div class="address">
                                                <label for="address-one">FIRST NAME</label>
                                                <input placeholder="FIRST NAME" id="address-one" type="text"  name="first_name"  value="{{old('first_name', isset($address->first_name) ? $address->first_name:'')}}"/>
                                            </div>
                                            <div class="address-two">
                                                <label for="address-two">LAST NAME</label>
                                                <input placeholder="LAST NAME" id="address-two" type="text" name="last_name" value="{{old('last_name', isset($address->last_name) ? $address->last_name:'')}}"/>
                                            </div>
                                        </div>
                                        <div class="row two">
                                            <div class="city">
                                                <label for="city">MOBILE NUMBER</label>
                                                <input placeholder="+ 91" id="city" type="text" name="mobile" value="{{old('mobile', isset($address->mobile) ? $address->mobile:'')}}"/>
                                            </div>
                                            <div class="state">
                                                <label for="state">EMAIL</label>
                                                <input placeholder="abc@gmail.com" id="state" type="email" name="email" value="{{old('email', isset($address->email) ? $address->email:'')}}"/>
                                            </div>
                                        </div>

                               
                                </div>
                            </section>
                            <section class="form__billing">
                                <div class="sections">
                                    <div class="box billing">2</div><span>Billing Address</span>
                                </div>
                                <div class="shipping--form">
                                  
                                        <div class="row one">
                                            <div class="address">
                                                <label for="address-one">Address Line 1</label>
                                                <input placeholder="e.g. 1 Infinite Loop" id="my_billing_address_line1"
                                                    type="text" name="billing_address_line1" value="{{old('billing_address_line1', isset($address->billing_address_line1) ? $address->billing_address_line1:'')}}"/>
                                            </div>
                                            <div class="address-two">
                                                <label for="address-two">Address Line 2</label>
                                                <input id="my_billing_address_line2" type="text" name="billing_address_line2" value="{{old('billing_address_line2', isset($address->billing_address_line2) ? $address->billing_address_line2:'')}}"/>
                                            </div>
                                        </div>
                                        <div class="row two">
                                            <div class="city">
                                                <label for="city">City</label>
                                                <input placeholder="e.g. Cupertino" id="my_billing_city" type="text" name="billing_city" value="{{old('billing_city', isset($address->billing_city) ? $address->billing_city:'')}}"/>
                                            </div>
                                            <div class="state">
                                                <label for="state">State / Province / Region</label>
                                                <select class="form-control show-tick" name="billing_state" id="my_billing_state">
               <option value="" Disabled selected> Select Type </option>
               @if ($states->count() > 0)
                  @foreach ($states as $state)
                  @if (!empty($address->billing_state) && $address->billing_state== $state->name || collect(old('billing_state'))->contains($state->name))
                  <option value="{{ $state->name }}" selected=""> {{$state->name}} </option>
                  @else
                  <option value="{{ $state->name }}"> {{$state->name}} </option>
                  @endif
                  @endforeach
                  @endif
            </select>
                                                {{--<input placeholder="e.g. California" id="billing_state" type="text" name="billing_state" value="{{old('billing_state', isset($address->billing_state) ? $address->billing_state:'')}}"/>--}}
                                            </div>
                                        </div>
                                        <div class="row three">
                                            <div class="zip">
                                                <label for="zip">Zip / Postal Code</label>
                                                <input placeholder="e.g. 95014" id="my_billing_zip" type="text" name="billing_zip" value="{{old('billing_zip', isset($address->billing_zip) ? $address->billing_zip:'')}}"/>
                                            </div>
                                            <div class="country">
                                                <label for="country">Country</label>
                                                <input placeholder="e.g. U.S.A" id="my_billing_country" type="text" name="billing_country" value="{{old('billing_country', isset($address->billing_country) ? $address->billing_country:'')}}"/>
                                            </div>
                                        </div>
                                   
                                   
                                </div>
                            </section>
                            <section class="form__shipping">
                                <div class="sections">
                                    <div class="box">3</div><span>Shipping Address</span>
                                </div>
                                <div class="form__question">
                                    <input type="checkbox" id="sameAddressCheckbox"/>
                                    <p>Is your shipping address the same as your billing address ?</p>
                                </div>
                                <div class="shipping--form">
                                  
                                        <div class="row one">
                                            <div class="address">
                                                <label for="address-one">Address Line 1</label>
                                                <input placeholder="" id="shipping_address_line1" type="text" name="shipping_address_line1" />
                                            </div>
                                            <div class="address-two">
                                                <label for="address-two">Address Line 2</label>
                                                <input id="shipping_address_line2" type="text" name="shipping_address_line2" />
                                            </div>
                                        </div>
                                        <div class="row two">
                                            <div class="city">
                                                <label for="city">City</label>
                                                <input placeholder="" id="shipping_city" type="text" name="shipping_city" />
                                            </div>
                                            <div class="state">
                                                <label for="state">State / Province / Region</label>
                                               <select class="form-control show-tick" name="shipping_state" id="shipping_state">
               <option value="" Disabled selected> Select Type </option>
               @if ($states->count() > 0)
                  @foreach ($states as $state)
                 
                  <option value="{{ $state->name }}"> {{$state->name}} </option>
                  
                  @endforeach
                  @endif
            </select>
                                                {{--<input placeholder="" id="shipping_state" type="text" name="shipping_state" />--}}
                                            </div>
                                        </div>
                                        <div class="row three">
                                            <div class="zip">
                                                <label for="zip">Zip / Postal Code</label>
                                                <input placeholder="" id="shipping_zip" type="text" name="shipping_zip" />
                                            </div>
                                            <div class="country">
                                                <label for="country">Country</label>
                                                <input placeholder="" id="shipping_country" type="text" name="shipping_country" />
                                            </div>
                                        </div>
                                  
                                </div>
                            </section>

                            <div class="form__confirmation">
                                <button>Confirm Information</button>
                            </div>
                        </div>
                    </div>
                </div>
</form>
                <div class="col-md-12 col-lg-4 col-xl-4">
                <form action="{{route('paymentMode')}}" method="POST" enctype="multipart/form-data">
      @csrf
                    <div class="cart-wrap-right">
                        <div class="checkout-button">
                            <a href="#" data-target="#size-modal5" data-toggle="modal">Proceed to checkout</a>
                        </div>
                      @php
                      $addr=App\Models\ShipAddress::where('user_id',auth()->user()->id)->first();
                    
                      @endphp
    <input type="hidden" name="shipping_detail" value="{{$addr->shipping_address_line1 ?? ''}}" />                   
 <input type="hidden" name="action" value="{{$action}}" />
                        <input type="hidden" name="product" value="{{$product}}" />
                        <input type="hidden" name="size" value="{{$size}}" />
                        <div class="payment-details">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Total</th>
                                        <th>₹ {{number_format($total,2)}}</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                     <tr>
                                        <td>Discount</td>
                                        <td>₹ {{number_format($discount,2)}}</td>
                                    </tr>
                                   @if($offerqty >= 3)
                                                  <tr>
                                                        <td>Buy 2 Get 1 Discount</td>
                                                        <td id="discount">₹ {{ number_format($offer, 2) ?? '0.00' }}
                                                        </td>
                                                    </tr>
                                                  @endif
                                   @if(session()->has('coupon'))
                                    <tr>
                                        <td> Coupon ({{session()->get('coupon')['name']}})<button id="remove">Remove</button>
                            </td>
                                        <td id="coupon">₹ {{number_format(session()->get('coupon')['discount'],2)}}</td>
                                    </tr>
                                    @endif
                                @if(session()->has('coupon'))
                                  @if($offerqty >= 3)
                                    <tr class="special">
                                        <th>Sub Total</th>
                                        <th>₹ {{number_format($total-$discount-$offer-session()->get('coupon')['discount'],2) ?? '00'}}</th>
                                    </tr>
                                  @else
                                   <tr class="special">
                                        <th>Sub Total</th>
                                        <th>₹ {{number_format($total-$discount-session()->get('coupon')['discount'],2) ?? '00'}}</th>
                                    </tr>
                                  @endif
                                    @else
                                  @if($offerqty >= 3)
                                <tr class="special">
                                        <th>Sub Total</th>
                                        <th>₹ {{number_format($total-$discount-$offer,2)}}</th>
                                    </tr>
                                  @else
                                   <tr class="special">
                                        <th>Sub Total</th>
                                        <th>₹ {{number_format($total-$discount,2)}}</th>
                                    </tr>
                                  @endif
                                     @endif
                                    <tr>
                                        <td>GST</td>
                                        <td>₹ {{number_format($tax,2)}}</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping Charge</td>
                                        <td>Free</td>
                                    </tr>
                                    <tr>
                                     
                       {{--<td><input type="checkbox" id="gift" name="gift" value="yes"
                                    {{ (isset($giftWrap) && $giftWrap == 'yes') ? 'checked' : '' }}><label for="gift">
                                    Gift Wrap</label></td>
                            <td>₹ 35</td>--}}
                                        <td>Gift Wrap</td>
                                        <td>₹ {{isset($giftWrap)&& $giftWrap=='yes'? $gift_price:'0'}}</td>
                                      
                        </tr>
                        @if(session()->has('coupon'))
                                   @if($offerqty >= 3)
                                    <tr>
                                        <td>Payble Amount</td>
                                        <td>₹<span id="payableAmount"> {{round($total-$discount-$offer-session()->get('coupon')['discount']+$tax + (isset($giftWrap) && $giftWrap == 'yes' ? $gift_price : 0) ?? '00')}}</span></td>
                                    </tr>
                                  
                                                  @else
                                                  <tr>
                                                            <td>Payable Amount</td>
                                                            <td>₹<span id="payableAmount">
                                                                    {{round($total-$discount-session()->get('coupon')['discount']+$tax + (isset($giftWrap) && $giftWrap == 'yes' ? $gift_price : 0) ?? '00')}}</span>
                                                            </td>
                                                        </tr>
                                                  @endif
                                    @else
                                    @if($offerqty >= 3)
                        <tr>
                            <td>Payable Amount</td>
                            
                            <td>₹ <span
                                    id="payableAmount">{{round($total - $discount-$offer + $tax + (isset($giftWrap) && $giftWrap == 'yes' ? 35 : 0))}}</span>
                            </td>
                        </tr>
                                  @else
                                   <tr>
                            <td>Payable Amount</td>
                            
                            <td>₹ <span
                                    id="payableAmount">{{round($total - $discount + $tax + (isset($giftWrap) && $giftWrap == 'yes' ? 35 : 0))}}</span>
                            </td>
                        </tr>
                                  @endif
                        @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="offer-sec">
                            <p class="offer-heading">Offer</p>
                            <div class="d-flex align-items-baseline">
                                <p><img src="images/discount.png" alt="">Apply Coupon</p>
                                <p class="text-right"><a href="#">View Offers</a></p>
                            </div>
                            <div class="apply-form">
                                <input type="text" name="" placeholder="Have A Coupon? Type here">
                                <a href="#">Apply</a>
                            </div>
                        </div> -->
                        <input type="hidden" name="total"  value="{{$total}}" />
                        <input type="hidden" name="discount"  value="{{$discount}}" />
                       <input type="hidden" name="gift"  value="{{$giftWrap}}" />
                        <input type="hidden" name="offer" value="{{ $offer }}" />
                                       <input type="hidden" name="offerqty" value="{{ $offerqty }}" />
                        <div class="checkout-button mb-5">
                            <a href="#" data-target="#size-modal5" data-toggle="modal">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
                                                
                                                    <!-- Modal -->
                    <div class="modal fade size-chart" id="size-modal5" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="size-modal1">Alert!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                   

                                       
                                        <p class="order_Place">Before proceeding to next step, please make sure you have entered the shipping address .</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn btn-primary">Dismiss</button>
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!--END MODAL-->
</form>
        </div>

    </div>
</section>
                                                
                                            
                                                
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
    $(document).ready(function () {
        $('#gift').click(function () {
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
</script>  -->
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

{{--<script>
    $(document).ready(function () {
        var checkbox = $('#gift');

        checkbox.click(function () {
            var payableAmount = parseFloat($('#payableAmount').text().replace('₹ ', ''));

            if ($(this).prop('checked')) {
                if (confirm('Do you want to add Rs 35 as Gift wrap amount to the payable amount?')) {
                    payableAmount += 35;
                } else {
                    $(this).prop('checked', false);
                }
            } else {
                payableAmount -= 35;
            }

            $('#payableAmount').text( payableAmount.toFixed(2));
        });
    });
</script>--}}

<script>
    $(document).ready(function () {
        // Check if the checkbox is clicked
        $('#sameAddressCheckbox').click(function () {
            // Check if the checkbox is checked
            if ($(this).prop('checked')) {
                // Copy billing address data to shipping address fields
                $('#shipping_address_line1').val($('#my_billing_address_line1').val());
                $('#shipping_address_line2').val($('#my_billing_address_line2').val());
                $('#shipping_city').val($('#my_billing_city').val());
                $('#shipping_state').val($('#my_billing_state').val());
                $('#shipping_zip').val($('#my_billing_zip').val());
                $('#shipping_country').val($('#my_billing_country').val());
            } else {
                // Clear shipping address fields
                $('#shipping_address_line1').val('');
                $('#shipping_address_line2').val('');
                $('#shipping_city').val('');
                $('#shipping_state').val('');
                $('#shipping_zip').val('');
                $('#shipping_country').val('');
            }
        });
    });
</script>
@endsection