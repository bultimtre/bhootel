<?php

namespace App\Http\Controllers;
use Braintree_Gateway;
use Illuminate\Http\Request;
use Braintree_Transaction;
use App\Apartment;
use App\Ad;
use Carbon\Carbon;
class PaymentsController extends Controller
{
     public function pay(Request $request,$id)
    {
        //devo estrarre il prezzo dell'ad e mandarlo alla pag del pagamento
        $apartment = Apartment::find($id);
        $adId=($request-> ads);
        $query = Ad::where('id','=',$adId)->select('price')->get();
        $price = $query[0]->price;
     
       
        return view('hosted',compact('apartment','price'));
       // return view('drop-ui',compact('apartment','price'));
    }

    public function make(Request $request,$id,$adId)
{

  $apartment = Apartment::find($id);
 // dd($apartment);
    // $data=Ad::where('id','=',$adId)
    // ->select('created_at')
    // ->get();
    //  $date = $data[0]['created_at'];
    
    // $expire= new Carbon($data[0]['created_at']->addHours(24)); 
   
    $today = Carbon::now();
     $new_expire= new Carbon($today->addHours(24)); 
     $diff= $new_expire-> diffInRealHours($today,false); 
     
       $ads = Ad::all();

       $gateway = new Braintree_Gateway([
                                         'environment' => 'sandbox',
                                         'merchantId' => '8w4hz737npfm33s6',
                                         'publicKey' => 'mq73dj8hqrtn4pvx',
                                         'privateKey' => 'dbad4bb9942aadf39b167d980dcb0893'
                                         ]);

    $paymentMethodNonce =  $_POST['payment_method_nonce']; 
    $amount = $_POST['amount'];

    $time;
    if ($amount == '2.99') {
      $time = '24';
      
    } else if($amount == '5.99'){
      $time = '72';
    }
    else if($amount == '9.99'){
      $time = '144';
    }
     
        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];
        $apartments= Apartment::all();
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $paymentMethodNonce, 
            'options' => [
                'submitForSettlement' => True
                ]]);
                               
      if($result ->success){
        $successo = 'true';
        return view('pages.info-sponsor',compact('apartment','amount','time','today','new_expire'));
       // return view('pages.show',compact('apId'));
     //return redirect('/user/apartment/'.$id)->with(['successo' => $successo]);
      }
}

 public function sponsor($id)
    {
      $apId = $id;
      $successo = 'true';
        return redirect('/user/apartment/'.$id)->with(['successo' => $successo]);
       
    }

}
