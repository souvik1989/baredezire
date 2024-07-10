<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\AdminUser;
use App\Models\ShipAddress;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Mail;
use App\Mail\paymentConfirmMail;
use App\Mail\orderConfirmAdmin;

class PaymentController extends Controller
{
  
    
  function hextobin($hexString) 
 { 
	$length = strlen($hexString); 
	$binString="";   
	$count=0; 
	while($count<$length) 
	{       
	    $subString =substr($hexString,$count,2);           
	    $packedString = pack("H*",$subString); 
	    if ($count==0)
	    {
			$binString=$packedString;
	    } 
	    
	    else 
	    {
			$binString.=$packedString;
	    } 
	    
	    $count+=2; 
	} 
        return $binString; 
  } 
    
   function encrypt($plainText,$key)
{ 
    
	$key = $this->hextobin(md5($key));
    
	$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	$openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
    
	$encryptedText = bin2hex($openMode);
      //dd($encryptedText);
	return $encryptedText;
} 
  
  function decrypt($encryptedText,$key)
{
	$key = $this->hextobin(md5($key));
	$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	$encryptedText = $this->hextobin($encryptedText);
	$decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
	return $decryptedText;
}
  
    public function initiatePayment(Request $request)
    {

        error_reporting(0);

        $merchant_data = '';
      
        $working_key ='0681E6946C84F17B13BF7D60DE7E6D06'; // Shared by CCAVENUES
        $data['accessCode'] = 'AVCF34KK85BY16FCYB'; // Shared by CCAVENUES

        foreach ($request->all() as $key => $value) {
          $merchant_data.=$key.'='.$value.'&';
        }
     
     //dd($merchant_data);

        $data['encryptedData'] = $this->encrypt($merchant_data, $working_key); // Method for encrypting the data.
     // dd($encrypted_data);

      //dd($data);
        return view('frontend.payment.initiate',$data);
    }
  
   public function responsePayment(Request $request)
    {
  $admin=AdminUser::first();
        error_reporting(0);
	   
	$workingKey='0681E6946C84F17B13BF7D60DE7E6D06';		//Working Key should be provided here.
	$encResponse=$request->encResp;	
     //dd($encResponse);//This is the response sent by the CCAvenue Server
	$rcvdString=$this->decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
     $order_no="";
  
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
     	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
          if($i==0)	$order_no=$information[1];
         
	}
     $order=Order::where('order_number',$order_no)->first();
     $user=User::find($order->user_id);
     if($order_status==="Success")
	{
		$order->payment_status="confirmed";

	}
	else if($order_status==="Aborted")
	{
		$order->payment_status="cancelled";
      $order->status="cancelled";
	
	}
	else if($order_status==="Failure")
	{
		$order->payment_status="failed";
      $order->status="cancelled";
	}
	else
	{
		$order->payment_status="pending";
	
	}
     
     $order->save();
      $data = [
              'order_no' => $order_no,
              'status'   =>$order_status,
         'payment_method'=>'Paid via ICICI',
          ];


      Mail::to($user->email)->send(new paymentConfirmMail($data));
      Mail::to($admin->order_email)->send(new orderConfirmAdmin($data));
     //return $decryptValues;
      return view('frontend.payment.response', [
           'decryptValues' => $decryptValues,
          'orderStatus' => $order_status
        ]);

    }


}
