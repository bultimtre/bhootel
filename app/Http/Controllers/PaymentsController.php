<?php

namespace App\Http\Controllers;
use Braintree_Gateway;
use Illuminate\Http\Request;
use Braintree_Transaction;
use App\Apartment;
use App\Ad;
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
        $apartment -> ads() -> attach($adId);
     
       $ads = Ad::all();

       $gateway = new Braintree_Gateway([
                                         'environment' => 'sandbox',
                                         'merchantId' => '8w4hz737npfm33s6',
                                         'publicKey' => 'mq73dj8hqrtn4pvx',
                                         'privateKey' => 'dbad4bb9942aadf39b167d980dcb0893'
                                         ]);

    $paymentMethodNonce =  $_POST['payment_method_nonce'];
    $amount = $_POST['amount'];

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
        $result = 'true';
      // return redirect('/user/apartment/'.$id)->with('result');
      }
      
//dd($result);
    //return response()->json($result.success);
    //return view('pages.show');
   return redirect('/user/apartment/'.$id);
}

}


  