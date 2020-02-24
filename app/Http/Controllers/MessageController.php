<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Apartment;
use App\Message;

class MessageController extends Controller
{
    public function store(Request $request) {

        $toSend = $request -> all();
        $data = Message::make([
            "body" => $request['text'],
            "title" => 'prova',
            "email" => 'mia@mail.com'
        ]);
        $apartment = Apartment::findOrFail($request['id-apt']);

        $apartment->messages()->save($data);

        // return redirect() -> route('mail-send');
        return Redirect::route('mail-send', $toSend['text']);
    }



    public function sendMail(Request $request, $toSend) {

        $to_email = "from@example.com";
        // $data = ['msg' => $toSend];
        $data = array("body" => $toSend);
        Mail::send('mail', $data, function ($message) use ($to_email) {
            $message -> to($to_email)
                     -> subject('Mail object');
        });

        return redirect() -> back();
    }


    public function stat(Request $request) {

        $request['year'] = 2020;

        // dd($request -> all());

        $msgs = Message::all();
        
        return response() -> json($msgs);

    }
}




// Route::get('/mail', function() {
//     $user = Auth::user(); 
//     $to_name = $user;
//     $to_email = "from@example.com";
//     $data = array("name" => $user, "body" => "");
//     Mail::send('mail', $data, function ($message) use ($to_name, $to_email) {
//         $message -> to($to_email)
//                  -> subject('Mail object');
//     });
// });

