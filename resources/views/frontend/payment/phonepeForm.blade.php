@extends('frontend.master')
@section('title', "Order Summary")
@section('content')


<script>
	window.onload = function() {
		var d = new Date().getTime();
		document.getElementById("tid").value = d;
	};
</script>  

  
<section class="order-report-wrap">

  <form method="POST" name="customerData" action="{{route('phonepe.payment')}}">
	 @csrf   
      <div class="container">
        <div class="heading">
          <h2>
            Order Summary
          </h2>
        </div>
        <table width="50%" height="100" border='1' align="center" class="table table-striped">
				
				
					
				
           
				
				<input type="hidden" name="merchant_id" value="PGTESTPAYUAT"/>
				
				<tr>
					<td>Order Id	:</td><td><input type="text" name="order_id" value="{{$order->order_number}}"/></td>
				</tr>
				<tr>
					<td>Amount	:</td><td><input type="text" name="amount" value="{{$order->total_price}}.00"/></td>
				</tr>
				<tr>
					<td>Currency	:</td><td><input type="text" name="currency" value="INR"/></td>
				</tr>
			
					
			 	
			 	
			
		
		  

	      	</table>
        <div class="order-report-btn">
          <button class="submit" value="CheckOut">CheckOut</button>
        </div>
      </div>
		        
	      </form>
  
</section>
@endsection