<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree_Transaction;
use App\Apartment;
class PaymentsController extends Controller
{
    public function make(Request $request)
{
    //dd($request);
    
    $payload = $request->input('payload', false);
    $nonce = $payload['nonce'];
    $apartments= Apartment::all();
    
    $status = Braintree_Transaction::sale([
                            'amount' => '12.00',
                            'paymentMethodNonce' => $nonce,
                            'options' => [
                                       'submitForSettlement' => True
                                         ]
              ]);
              
    return response()->json($status);
   // return view('hosted',compact('status'));
}
}
