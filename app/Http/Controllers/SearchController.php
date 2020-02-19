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
        // $result = strtolower($data['search_field']);
        // $apartments = Apartment::where('address', 'LIKE',strtolower('%'.$result.'%')) -> get();
        // return view('pages.search',compact('apartments', 'result', 'search_field'));
        return view('pages.search',compact('search_field'));
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
        $searchData = $request->all();
        $search_field = $searchData['search_field'];
        $lat = $searchData['lat'];
        $lon = $searchData['lon'];
        $rooms = $searchData['rooms'];
        $beds = $searchData['beds'];
        $range = $searchData['range'] * 1000;

        if($search_field) {
            $result = strtolower($search_field);
            $apartments = Apartment::where('address', 'LIKE', strtolower('%'.$result.'%')) -> get();
            return [
                'success' => true,
                'data' => $apartments,
                // 'lat' => $lat,
                // 'search' => $search_field
            ];

        }
        //  else {
        //     return [
        //         'success' => false
        //     ];
        // }
        // $range = 20000;
        if($lat && $lon) {
            $apartments = Apartment::whereRaw('
                ST_Distance_Sphere(
                    point(lon, lat),
                    point(?, ?)
                ) < '.$range.'
            ',[
                $lon,
                $lat
            ]); 

            if($beds) {
                $apartments -> where('beds' , '>=', $beds);
            }
            if($rooms) {
                $apartments -> where('rooms' , '>=', $rooms);
            }

            //add config
            //add appartamento visibile o meno
            $send_data = $apartments->get();

            return [
                'success' => true,
                // 'data' => $apartments,
                'data' => $send_data,
                'lat' => $lat,
                'lon' => $lon
                // 'search' => $search_field
            ];

        }
    }
}
