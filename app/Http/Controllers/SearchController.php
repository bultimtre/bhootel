<?php

namespace App\Http\Controllers;


use App\User;
use App\Config;
use App\Apartment;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function show(Request $request)
    {
        $data = $request -> all();
        $search_field = $data['search_field'];

        return view('pages.search',compact('search_field'));
    }
    public function getAllConfigs() {
        $configs = Config::all();
        return Response()->json($configs);
    }
    public function getAptConfig() {
        $apartments=Apartment::all();
        $aptAd = [];
        foreach ($apartments as $apartment) {
            foreach ($apartment->configs as $config) {
                array_push($aptAd,[
                    'service' => $config->service,
                    'apt_id'=>$apartment->id
                    ]);
            }
        }
        return Response()->json($aptAd);
    }
    public function search(Request $request)
    {
        // return Response()->json($request); //debug

        $searchData = $request->all();
        $search_field = $searchData['search_field'];
        $lat = $searchData['lat'];
        $lon = $searchData['lon'];
        $rooms = $searchData['rooms'];
        $beds = $searchData['beds'];
        $range = $searchData['range'] * 1000;
        $configs = $searchData['configs'];

        if($search_field) {

            $result = strtolower($search_field);
            // $apartments = Apartment::where('address', 'LIKE', strtolower('%'.$result.'%'));
            $apartments = Apartment::where(function ($query) use ($result) {
                $query->where('address', 'LIKE', strtolower('%'.$result.'%'))
                    ->orWhere('description', 'LIKE', strtolower('%'.$result.'%'));
            });

        } else if ($lat && $lon) {
            $apartments = Apartment::whereRaw('
                ST_Distance_Sphere(
                    point(lon, lat),
                    point(?, ?)
                ) < '.$range.'
            ', [
                $lon,
                $lat
            ]);
        } else {
            return [
                'success' => true,
                'data' => [],
                'response' => 'missing parameters'

            ];

        }

        if($beds) {
            $apartments -> where('beds' , '>=', $beds);
        }
        if($rooms) {
            $apartments -> where('rooms' , '>=', $rooms);
        }

        if($configs) {
            $apartments->whereHas('configs', function ($query) use ($configs) {
                $query->whereIn('configs.id', $configs);

            });

        }

        // appartamento visibile o meno
        $apartments->where('show', '=', 1);

        $send_data = $apartments->get();

        return [
            'success' => true,
            'data' => $send_data,
            'searchFor' => [
                'search_field' => $search_field,
                'lat' => $lat,
                'lon' => $lon,
                'range' => $range
            ]

        ];


    }
}
