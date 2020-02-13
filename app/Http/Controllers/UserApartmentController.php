<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Apartment;
use App\Config;

class UserApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        echo 'return list all user apartments';

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('user-apart.create', [
            'configs' => Config::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        // $dataAll = $request -> all();
        // dd($dataAll); //Debug not working with ajax call

        $validateApartmentData = $request -> validate([  
            'imagefile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|max:850',
            'address' => 'required|max:255',
            'lat' => 'nullable|numeric|between:-90,90',
            'lon' => 'nullable|numeric|between:-90,180',
            'rooms' => 'required|numeric|max:200',
            'beds' => 'required|numeric|max:200',
            'bath' => 'required|numeric|max:200',
            'square_mt' => 'required|numeric|max:10000',
            'configs_id' => 'nullable|array|exists:configs,id'
        ]);

        if ($validateApartmentData) {
            $file = $request->file('imagefile');

            $filename = $file -> getClientOriginalName(); 
            $file -> move('images/user/'. Auth::user()->name, $filename);
            //save image path db da verificare
            $imageFilePath = 'images/user/'. Auth::user()->name.'/'. $filename;
            $validateApartmentData['image'] = $imageFilePath;
            //creo Appartamento e lo associo allo user
            $user = Auth::user();
            $apartment = Apartment::make($validateApartmentData);
            $apartment -> user() -> associate($user);
            $apartment -> save();
            //associo le configs allo user apartment
            if (isset($validateApartmentData['configs_id'])) {
                $configs = Config::find($validateApartmentData['configs_id']);
                $apartment -> configs() -> attach($configs);
            }

            return Response()->json([
                "success" => true,
                "imagefile" => $filename,
                "description" => $validateApartmentData['description'],
                "configs_id" => $validateApartmentData['configs_id']
            ]);
 
        }
 
        return Response()->json([
                "success" => false,
                "imagefile" => ''
            ]);

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
