<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stat;
use Carbon\Carbon;

class ViewsController extends Controller
{
    public function viewStat(Request $request, $id) {

        $year_jq = $request -> year_jq;
        $id_jq = $request -> id;
        $dateView = Stat::where('apartment_id', '=', $id) 
                    -> whereYear('created_at', '=', $year_jq)
                    -> select('created_at') 
                    -> get();
                    
        // return response() -> json($dateView);
        return $id_jq;
    }
}
