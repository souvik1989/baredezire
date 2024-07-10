<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Models\Order;
use App\Models\User;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Mail;
use App\Mail\paymentConfirmMail;
use App\Mail\orderConfirmAdmin;
use PhonePe\payments\v1\PhonePePaymentClient;
use PhonePe\Env;
use PhonePe\payments\v1\models\request\builders\InstrumentBuilder;
use PhonePe\payments\v1\models\request\builders\PgPayRequestBuilder;

class PhonepeController extends Controller
{
     public function phonePe(Request $request)
    {
       
      $MERCHANTID = env('MERCHANTID');
$SALTKEY = env('SALTKEY');
$SALTINDEX = env('SALTINDEX');
        
        $SHOULDPUBLISHEVENTS = env('SHOULDPUBLISHEVENTS');
        $userId=auth()->user()->id;
        $phonePePaymentsClient = new PhonePePaymentClient($MERCHANTID, $SALTKEY, $SALTINDEX,Env::PRODUCTION, $SHOULDPUBLISHEVENTS);

        //$merchantTransactionId = 'PHPSDK' . date("ymdHis") . "payPageTest";
        $request = PgPayRequestBuilder::builder()
            ->mobileNumber("9999999999")
            ->callbackUrl(route('phonepe.response'))
            ->merchantId($MERCHANTID)
            ->merchantUserId($userId)
            ->amount((int)$request->amount*100)
            ->merchantTransactionId($request->order_id)
            ->redirectUrl(route('phonepe.response',['merchantTransactionId' => $request->order_id]))
            ->redirectMode("REDIRECT")
            ->paymentInstrument(InstrumentBuilder::buildPayPageInstrument())
            ->build();

        $response = $phonePePaymentsClient->pay($request);
        $url = $response->getInstrumentResponse()->getRedirectInfo()->getUrl();

        // Redirect the user to the PhonePe payment URL
        return redirect()->to($url);
    }

    public function response(Request $request)
    {
        
  $admin=AdminUser::first();
$MERCHANTID = env('MERCHANTID');
$SALTKEY = env('SALTKEY');
$SALTINDEX = env('SALTINDEX');

$SHOULDPUBLISHEVENTS = env('SHOULDPUBLISHEVENTS');
  $merchantTransactionId = $request->input('merchantTransactionId');

$phonePePaymentsClient = new PhonePePaymentClient($MERCHANTID, $SALTKEY, $SALTINDEX, Env::PRODUCTION, $SHOULDPUBLISHEVENTS);
//dd($phonePePaymentsClient->statusCheck("merchantTransactionId"));
$checkStatus = $phonePePaymentsClient->statusCheck($merchantTransactionId);
      
$state=$checkStatus->getState();
      //dd($checkStatus->getMerchantTransactionId());
      $order=Order::where('order_number',$checkStatus->getMerchantTransactionId())->first();
       $user=User::find($order->user_id);
      if($state==="COMPLETED")
	{
		$order->payment_status="confirmed";

	}else
	{
		$order->payment_status="pending";
	
	}
       $order->save();
      
    $data = [
              'order_no' => $checkStatus->getMerchantTransactionId(),
              'status'   =>$state,
         'payment_method'=>'Paid via PhonePe',
          ];


      Mail::to($user->email)->send(new paymentConfirmMail($data));
      Mail::to($admin->order_email)->send(new orderConfirmAdmin($data));
        //dd(json_decode($response));
       return view('frontend.payment.phonepeResponse', [
           'response' => $state,
             'order_no'=>$checkStatus->getMerchantTransactionId(),
          
        ]);
    }
}
