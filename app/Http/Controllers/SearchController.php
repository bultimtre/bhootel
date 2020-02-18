<?php

namespace App\Http\Controllers;


use App\User;
use App\Apartment;
use App\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function show(Request $request)
    {
        $data = $request -> all();
        $search_field = $data['search_field'];
        $result = strtolower($data['search_field']);
        $apartments = Apartment::where('address', 'LIKE',strtolower('%'.$result.'%')) -> get();
        return view('pages.search',compact('apartments', 'result', 'search_field'));
    }
    public function search(Request $request)
    {
        // return Response()->json($request); //debug
        // return [
        //     'success' => true,
        //     'data' => $request['search_field']
        // ]; //debug
        // $data = $request -> all();
        // $search_field = $data['search_field'];
        // $result = strtolower($data['search_field']);
        // $apartments = Apartment::where('address', 'LIKE',strtolower('%'.$result.'%')) -> get();
        // return view('pages.search',compact('apartments', 'result', 'search_field'));
        $search_field = $request['search_field'];
        $result = strtolower($search_field);
        $apartments = Apartment::where('address', 'LIKE',strtolower('%'.$result.'%')) -> get();
        return [
            'success' => true,
            'data' => $apartments
        ];
    }
}
