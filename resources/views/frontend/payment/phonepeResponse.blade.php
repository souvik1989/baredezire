  <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/fav.png') }}">
<style>
  
  .response-wrap{
    position: relative;
    padding-top: 100px;
  }

  .response-wrap .logo{
  width: 30%;
margin: 0 auto;
    display: flex;
}
  .response-wrap .logo img{
    width: 50%;
    margin: 0 auto;
  }
  .response-btn{
    background-image: linear-gradient(45deg, #160d10, #bc6183);
    color: #fff;
    text-decoration: none;
    padding: 10px 40px;
    display: inline-block;
    border-radius: 30px;
    margin-top : 30px;
  }
  
  /*// Medium devices (tablets, less than 992px)*/
  @media (max-width: 991.98px) { 
  
    
    .response-wrap .logo{
  width: 50%;
margin: 0 auto;
    display: flex;
}
  .response-wrap .logo img{
    width: 100%;
    margin: 0 auto;
  }
  .response-wrap center{
    font-size: 30px;
  }
    .response-wrap center table tr td{
      font-size: 40px;
    }
    
  }
  
</style>

  
  <div class="response-wrap">
    <div class="logo">
      <img src="https://baredezire.com/public/storage/siteSetting/8PC4u7wq8cOjcUP4FHPZeLmuW8yB1d6hXfAi3iHD.png" alt="">
    </div>
    
    <center>
    
    @if($response==="COMPLETED")
    <br>Thank you for shopping with us. Your transaction is successful. We will be shipping your order to you soon.

@else
    <br>Error! Something went wrong.
@endif

	
  <br><br>
  
  <table cellspacing=4 cellpadding=4>
   
                                 
   <tr>
        <td>Order Status :</td>
        <td>{{ $response }}</td>
    </tr>
  <tr>
        <td>Order Number :</td>
        <td>{{ $order_no}}</td>
    </tr>

  </table>
<a class="btn btn-primary response-btn" href="{{ route('dashboard') }}">Continue Shopping</a>
</center>
    
  </div>
  
