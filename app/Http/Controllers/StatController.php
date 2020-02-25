<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Message;
use App\Stat;
use Carbon\Carbon;
class StatController extends Controller
{
    public function charStat($id) {
    
     $apartment=Apartment::findOrFail($id);
     return view('pages.charts',compact('apartment'));
 }

   public function viewStat(Request $request) {

        $year_jq = $request -> year_jq;
        $year_jq+= 5;
        $id_jq = $request -> id;
        $dateView = Stat::where('apartment_id', '=', $id) 
                    -> whereYear('created_at', '=', $year_jq)
                    -> select('created_at') 
                    -> get();
                    
        // return response() -> json($dateView);
        return $year_jq;
    }

    //  public function msgStat(Request $request, $id) {
       
    //     $year_jq = $request -> year_jq;
    //     $msgs = Message::where('apartment_id', '=', $id) 
    //             -> whereYear('created_at', '=', $year_jq)
    //             -> select('created_at')
    //             -> get();
                
    //     return response() -> json($msgs);
    // }
}
