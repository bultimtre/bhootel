<?php

namespace App\Http\Controllers;

use App\Apartment;
use Illuminate\Support\Carbon;


class IndexController extends Controller
{
    public function notableApt(){
        $apartments=Apartment::all();
        $aptsWithAd =[];

        foreach($apartments as $apartment){
            foreach($apartment->ads as $ad){
                array_push($aptsWithAd,[
                    'date'=> $ad->pivot->created_at,
                    'id_apt'=> $apartment->id,
                    'hours'=> $ad->Hours,
                    'price_ad'=>$ad->id
                    ]);
            }
        };

        $aptsNotable = [];
        foreach ($aptsWithAd as $aptWithAd) {
            $now = new Carbon();
            $diff = $now->diffInHours($aptWithAd['date']);
            $adHours = $aptWithAd['hours'];
            if($diff<$adHours){
                array_push($aptsNotable,
                [
                    'start'=>$aptWithAd['date'],
                    'price_ad'=>$aptWithAd['price_ad'],
                    'hours'=>$adHours,
                    'diff'=> $diff,

                ]);
            }
        }

        $apts = Apartment::all();
        $result= ['result'=> $aptsNotable];
        //$aptsNotable = htmlspecialchars($aptsNotable, ENT_DISALLOWED, "UTF-8");;
        $resultColl = collect($result['result'])->map(function ($result) {
            return (object) $result;
        });

        //$aptsNotable= $aptsNotable->all();
        //$aptsNotable=collect($aptsNotable);
        //aptsNotable = collect(json_decode(json_encode($aptsNotable),true));
        //$aptsNotable = collect($aptsNotable);
        //dd($resultColl);
        /* return [
            'aptsAd'=> $aptsNotable,
            'apartaments'=>$apts
        ] */;
        //return $apts;
        return view('components.list-notable', compact('resultColl','apts') );

    }
}
