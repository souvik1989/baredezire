@extends('frontend.master')
@section('title', "Payment Mode")
@section('content')
<section class="cart-section">
    <div class="container">
        <div class="cart-wrap">
            <div class="form__name">Choose payment options</div>
            <form action="{{route('orderPlace')}}" id="myForm" method="POST" enctype="multipart/form-data">

@csrf
            <div class="row">
                <div class="col-md-12 col-lg-8 col-xl-8">
                    <div class="cart-wrap-left">
                        <div class="form__container p-gateway">
                            <section class="form__personal">
                                <div class="sections">
                                    <input type="hidden" name="action" value="{{$action}}" />
                                <input type="hidden" name="product" value="{{$product}}" />
                        <input type="hidden" name="size" value="{{$size}}" />
                                        <div class="radio">
                                            <input id="radio-1" name="payment_method" type="radio" value="cod" checked>
                                            <label for="radio-1" class="radio-label">Cash On Delivery (COD)</label>
                                        </div>

                                        <div class="radio">
                                            <input id="radio-2" name="payment_method" type="radio" value="phonepe">
                                            <label for="radio-2" class="radio-label">Pay with PhonePe</label>
                                        </div>

                                        <div class="radio">
                                            <input id="radio-3" name="payment_method" value="icici_pay" type="radio" >
                                            <label for="radio-3" class="radio-label">Pay With ICICI</label>
                                        </div>

                                </div>

                            </section>

                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 col-lg-4 col-xl-4">
                    <div class="cart-wrap-right">
                        <div class="checkout-button">
                            <a href="#" data-target="#size-modal1" data-toggle="modal">Proceed to checkout</a>
                        </div>

                        <div class="payment-details">
                           {{-- <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Total</th>
                                        <th>₹ {{number_format($total,2)}}</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                     <tr class="special">
                                        <td>Discount</td>
                                        <td>₹ {{number_format($discount,2)}}.00</td>
                                    </tr>
                                      
                                   @if(session()->has('coupon'))
                                    <tr>
                                        <td> Coupon ({{session()->get('coupon')['name']}})<button id="remove">Remove</button>
                           </td>
                                        <td id="coupon">₹ {{number_format(session()->get('coupon')['discount'],2)}}</td>
                                    </tr>
                                    @endif
                                      @if(session()->has('coupon'))
                                  
                                    <tr class="special">
                                        <th>Sub Total</th>
                                        <th>₹ {{number_format($total-$discount-session()->get('coupon')['discount'],2) ?? '00'}}</th>
                                    </tr>
                                    @else
                                    <tr>
                                        <th>Sub Total</th>
                                        <th>₹ {{number_format($total-$discount,2)}}</th>
                                    </tr>
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
                                        <td>Gift Wrap</td>
                                        <td>₹ {{isset($gift)&& $gift=='yes'? number_format($gift_price,2):'0.00'}}</td>
                                    </tr>
                                        @if(session()->has('coupon'))
                                
                                    <tr>
                                        <td>Payable Amount</td>
                                        <td>₹<span id="payableAmount"> {{isset($gift)&& $gift=='yes'?round(($total-$discount-session()->get('coupon')['discount'])+$tax+$gift_price) : round(($total-$discount-session()->get('coupon')['discount'])+$tax) }}</span></td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td>Payable Amount</td>
                                        <td>₹
                                            {{isset($gift)&& $gift=='yes'? round(($total-$discount)+$tax+$gift_price) : round(($total-$discount)+$tax)}}
                                        </td>
                                    </tr>
                                    
                                    @endif
                                </tbody>
                            </table>--}}
                           <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Total</th>
                                        <th>₹ {{$total}}.00</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                     <tr>
                                        <td>Discount</td>
                                        <td>₹ {{$discount}}.00</td>
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
                                        <td id="coupon">₹ {{session()->get('coupon')['discount']}}</td>
                                    </tr>
                                    @endif
                                @if(session()->has('coupon'))
                                    @if($offerqty >= 3)
                                    <tr class="special">
                                        <th>Sub Total</th>
                                        <th>₹ {{$total-$discount-$offer-session()->get('coupon')['discount'] ?? '00'}}</th>
                                    </tr>
                                  @else
                                  <tr class="special">
                                        <th>Sub Total</th>
                                        <th>₹ {{$total-$discount-session()->get('coupon')['discount'] ?? '00'}}</th>
                                    </tr>
                                  @endif
                                    @else
                                   @if($offerqty >= 3)
                                <tr class="special">
                                        <th>Sub Total</th>
                                        <th>₹ {{$total-$discount-$offer}}</th>
                                    </tr>
                                  @else
                                  <tr class="special">
                                        <th>Sub Total</th>
                                        <th>₹ {{$total-$discount}}</th>
                                    </tr>
                                  @endif
                                     @endif
                                    <tr>
                                        <td>GST</td>
                                        <td>₹ {{$tax}}</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping Charge</td>
                                        <td>Free</td>
                                    </tr>
                                    <tr>
                           {{-- <td><input type="checkbox" id="gift" name="gift" value="yes"
                                    {{ (isset($giftWrap) && $giftWrap == 'yes') ? 'checked' : '' }}><label for="gift">
                                    Gift Wrap</label></td>
                            <td>₹ 35</td>--}}
                                      <td>Gift Wrap</td>
                                        <td>₹ {{isset($giftWrap)&& $giftWrap=='yes'? $gift_price:'0'}}</td>
                        </tr>
                    
                                    @if(session()->has('coupon'))
                                   @if($offerqty >= 3)
                                    <tr>
                                        <td>Payable Amount</td>
                                        <td>₹<span id="payableAmount"> {{round($total-$discount-$offer-session()->get('coupon')['discount']+$tax + (isset($giftWrap) && $giftWrap == 'yes' ? $gift_price : 0) ?? '00')}}</span></td>
                                    </tr>
                                  
                                                  @else
                                                  <tr>
                                                            <td>Payble Amount</td>
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
                  <input type="hidden" name="total" value="{{$total}}" />
                        <input type="hidden" name="discount" value="{{$discount}}" />
                       @if($offerqty >= 3)
                                                 <input type="hidden" name="buyTwo" value="{{round($offer)}}" />
                                                       
                                                        
                                                  @endif
                      @if(session()->has('coupon'))
                                   @if($offerqty >= 3)
                      <input type="hidden" name="gross"
                            value="{{round($total-$discount-$offer-session()->get('coupon')['discount']+$tax + (isset($giftWrap) && $giftWrap == 'yes' ? $gift_price : 0) ?? '00')}}" />
                      @else
                      <input type="hidden" name="gross"
                            value="{{round($total-$discount-session()->get('coupon')['discount']+$tax + (isset($giftWrap) && $giftWrap == 'yes' ? $gift_price : 0) ?? '00')}}" />
                       @endif
                      @else
                                    @if($offerqty >= 3)
                      <input type="hidden" name="gross"
                            value="{{round($total - $discount-$offer + $tax + (isset($giftWrap) && $giftWrap == 'yes' ? 35 : 0))}}" />
                      @else
                        <input type="hidden" name="gross"
                            value="{{round($total - $discount + $tax + (isset($giftWrap) && $giftWrap == 'yes' ? 35 : 0))}}" />
                      @endif
                      @endif
                       @if(session()->has('coupon'))
                                    <input type="hidden" name="coupon_dis"
                            value="{{round(session()->get('coupon')['discount'])}}" />
                                        
                                    @endif

                        <div class="checkout-button mb-5">
                            <a href="#" data-target="#size-modal1" data-toggle="modal">Proceed to checkout</a>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade size-chart" id="size-modal1" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="size-modal1">Alert!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                   

                                       
                                        <p class="order_Place">Do you want to proceed and place this order?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn btn-primary">Dismiss</button>
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!--END MODAL-->
                </div>
            </div>
          
        </div>
</form>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
$(document).ready(function() {
    var checkbox = $('#gift');
    var payableAmount = parseFloat($('#payableAmount').text().replace('₹ ', ''));

    // Calculate and update the payable amount based on checkbox status
    function updatePayableAmount() {
        if (checkbox.prop('checked')) {
            payableAmount += 35;
        } else {
            payableAmount -= 35;
        }
        $('#payableAmount').text(payableAmount.toFixed(2));
    }

    // Initialize the payable amount based on initial checkbox status
    updatePayableAmount();

    checkbox.click(function() {
        if ($(this).prop('checked')) {
            if (confirm('Do you want to add Rs 35 as Gift wrap amount to the payable amount?')) {
                updatePayableAmount();
            } else {
                $(this).prop('checked', false);
            }
        } else {
            updatePayableAmount();
        }
    });
});
</script>--}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const confirmModal = $('#myForm');
        const confirmButton = confirmModal.find('.btn-primary:last-child'); // Confirm button inside the modal
        const dismissButton = confirmModal.find('.btn-primary:first-child'); // Dismiss button inside the modal
        const form = $('#yourFormId'); // Replace with your actual form ID

        // Show the modal when the form is about to be submitted
        form.on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            confirmModal.modal('show');

            confirmButton.on('click', function() {
                form.off('submit').submit(); // Submit the form after confirmation
            });

            dismissButton.on('click', function() {
                confirmModal.modal('hide'); // Hide the modal when dismissed
            });
        });
    });
</script>


@endsection