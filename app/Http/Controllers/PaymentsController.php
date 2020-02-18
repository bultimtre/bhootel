<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree_Transaction;
use App\Apartment;
class PaymentsController extends Controller
{
    public function make(Request $request)
{
       $data = $request -> all();
        dd($data);

        $ad = Ad::findOrFail($id);
        $aparment = Apartment::make($data);
        $apartment -> ad() -> associate($ad);
        $apartment -> save();
        
        $ad = Task::find($data['ads']);
      
        $apartment -> ads() -> attach($ads);

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
