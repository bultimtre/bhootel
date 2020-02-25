<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewsController extends Controller
{
    public function stat(Request $request) {
        $year_jq = $request->year_jq;
        $msgs = Message::whereYear('created_at', '=', $year_jq)->get() ;
        return response() -> json($msgs);
    }
}
