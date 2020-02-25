<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stat;
use Carbon\Carbon;

class ViewsController extends Controller
{
    public function viewStat(Request $request, $id) {
 
        $dateView = Stat::where('apartment_id', '=', $id) 
                    -> select('created_at') 
                    -> get();
                    
        return response() -> json($dateView);
    }
}
