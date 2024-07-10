<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Invoice</title>

		<style>
           
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #f7d1df;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(1) {
				border-top: 2px solid #eee;
				font-weight: bold;
				text-align: right;
			}
			.invoice-box table tr.total td:nth-child(1) ul{
				list-style: none;
				padding-left: 0;
			}
			.invoice-box table tr.total td:nth-child(1) ul li:nth-child(7){
			    background: #b85f81;
    padding: 10px;
    font-size: 20px;
    color: #fff;
    margin-top: 10px;

	}
	/*.invoice-box .new-table tr:nth-child(3){
    background: #f7d1df;
    padding: 10px;

	}*/
          .invoice-box .new-table .sub-total-highlight{
    background: #f7d1df;
    padding: 10px;

	}
          
	/*.invoice-box table tr.total td:nth-child(2) ul li:nth-child(1)
	{
		    display: inline-block;
    background: #f7d1df;
    font-size: 18px;
    padding: 10px;
    margin-bottom: 10px;
	}*/
	.invoice-box .new-table
	{
		border-spacing:0;
		    background: #f1f1f1;
	}
	.invoice-box .new-table tr td:nth-child(1){
		border: 0!important;
	}
	.invoice-box .new-table tr:nth-last-child(1){
		background: #b85f81;
    padding: 10px;
    font-size: 20px;
    color: #fff;
    margin-top: 10px;
	}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img
										src="{{$img}}"
										style="width: 100%; max-width: 300px"
									/>
								</td>

								<td>
									Invoice #: {{$order->order_number}}<br />
									Created: {{ \Carbon\Carbon::parse($order->created_at)->format('jS F, Y') }}<br />
									Due: {{ \Carbon\Carbon::parse($order->created_at->addDays(3))->format('jS F, Y') }}
								</td>
							</tr>
						</table>
					</td>
				</tr>
                <tr class="heading">
								<td>Address</td>

								<td>Info</td>
				</tr>
				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									{{$order->user->ship_address->shipping_address_line1}}<br />
								{{$order->user->ship_address->shipping_address_line2}} <br />
								{{$order->user->ship_address->shipping_city}}<br />
								{{$order->user->ship_address->shipping_zip}}, {{$order->user->ship_address->shipping_state}}, {{$order->user->ship_address->shipping_country}}
								</td>

								<td>
									{{$order->user->name}}<br />
								{{$order->user->phone}}<br />
								{{$order->user->email}}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Item - Quantity</td>

					<td>Price</td>
				</tr>
  @foreach($order->products as $prod)
                        @php
                        $product=App\Models\Product::find($prod->id);

                        @endphp
				<tr class="item">
					<td>{{ Str::limit($product->name, 50) }} - {{$order->products()
    ->where('products.id', $prod->id)
    ->first()
    ->pivot
    ->quantity}} piece(s)</td>

					<td style="font-family: DejaVu Sans; sans-serif;">&#8377; {{$order->products()
    ->where('products.id', $prod->id)
    ->first()
    ->pivot
    ->subtotal}}.00</td>
				</tr>
@endforeach
				{{--<tr class="item">
					<td>Bra 2</td>

					<td>₹75.00</td>
				</tr>

				<tr class="item last">
					<td>Bra 3</td>

					<td>₹100.00</td>
				</tr>--}}

				<tr class="total">

					<td colspan="2">

						<!-- <ul><li>Total: ₹475.00</li>
							<li>Discount: ₹85.00</li>
							<li>Sub Total: ₹390</li>
							<li>Estimate Tax: ₹5</li>
							<li>Shipping Charge: Free</li>
							<li>Gift Wrap: ₹1</li>
							<li>Payble Amount: ₹396 </li>
						</ul> -->
						
						<table class="new-table">
							<tr>
								<td>Total: </td>
								<td style="font-family: DejaVu Sans; sans-serif;">&#8377;{{$price}}.00</td>
							</tr>
							<tr>
								<td>Discount:</td>
								<td style="font-family: DejaVu Sans; sans-serif;">&#8377;{{$discount}}.00</td>
							</tr>
                           @if($order->buy2get1 !== null)
                                  <tr>
                                        <td>Buy 2 Get 1 Deal</td>
                                        <td style="font-family: DejaVu Sans; sans-serif;">&#8377; {{$order->buy2get1}}.00</td>
                                    </tr>
                                  @endif
                           @if($order->coupon_dis !== null)
                                  <tr>
                                        <td>Coupon({{$order->coupon_code}})</td>
                                        <td style="font-family: DejaVu Sans; sans-serif;">&#8377;{{$order->coupon_dis}}.00</td>
                                    </tr>
                                  @endif
                            @if ($order->coupon_dis !== null && $order->buy2get1 !== null)
                           <tr class="sub-total-highlight">
								<td>Sub Total:</td>
								<td style="font-family: DejaVu Sans; sans-serif;">&#8377;{{$price-$discount-$order->coupon_dis-$order->buy2get1}}.00</td>
							</tr>
                             @elseif ($order->coupon_dis !== null)
                          <tr class="sub-total-highlight">
								<td>Sub Total:</td>
								<td style="font-family: DejaVu Sans; sans-serif;">&#8377;{{$price-$discount-$order->coupon_dis}}.00</td>
							</tr>
                           @elseif ($order->buy2get1 !== null)
                          <tr class="sub-total-highlight">
								<td>Sub Total:</td>
								<td style="font-family: DejaVu Sans; sans-serif;">&#8377;{{$price-$discount-$order->buy2get1}}.00</td>
							</tr>
                          @else
							<tr class="sub-total-highlight">
								<td>Sub Total:</td>
								<td style="font-family: DejaVu Sans; sans-serif;">&#8377;{{$price-$discount}}.00</td>
							</tr>
                          @endif
							<tr>
								<td>Estimate Tax: </td>
								<td style="font-family: DejaVu Sans; sans-serif;">&#8377;{{$tax}}.00</td>
							</tr>
							<tr>
								<td>Shipping Charge:</td>
								<td>Free</td>
							</tr>
							{{--@if($order->coupon_dis !== null)
                                    
                                        
                                        @if($order->total_price > ($price-$discount+$tax-$order->coupon_dis))
                          <tr>
                                      <td> Gift
                                            Wrap</td>
                                        <td style="font-family: DejaVu Sans; sans-serif;">&#8377;35.00</td>
                                       </tr>
                                        @endif
                                    
                                  @else
                                 
                                       
                                        @if($order->total_price > ($price-$discount+$tax))
                           <tr>
                                     <td> Gift
                                            Wrap</td>
                                        <td style="font-family: DejaVu Sans; sans-serif;">&#8377; 35.00</td>
                                        </tr>
                                        @endif
                                   
                                  @endif--}}
                          <tr>
    <td>Gift Wrap</td>
    <td style="font-family: DejaVu Sans; sans-serif;"> &#8377;
        @php
        $giftWrapPrice = $order->total_price > ($price - $discount + $tax - $order->coupon_dis);
        @endphp
        @if ($order->coupon_dis !== null && $order->buy2get1 !== null)
            @php
            $giftWrapPrice = $order->total_price > ($price - $discount + $tax - $order->coupon_dis - $order->buy2get1);
            @endphp
        @elseif ($order->coupon_dis !== null)
            @php
            $giftWrapPrice = $order->total_price > ($price - $discount + $tax - $order->coupon_dis);
            @endphp
        @elseif ($order->buy2get1 !== null)
            @php
            $giftWrapPrice = $order->total_price > ($price - $discount + $tax - $order->buy2get1);
            @endphp
        @endif
        {{ $giftWrapPrice ?'35.00' : '00.00' }}
    </td>
</tr>
							<tr>
								<td>Payable Amount:</td>
								<td style="font-family: DejaVu Sans; sans-serif;">&#8377;{{$order->total_price}}.00</td>
							</tr>
							
						</table>
					</td>

				</tr>
			</table>
		</div>
	</body>
</html>