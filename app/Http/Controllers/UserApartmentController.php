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
        // echo 'hello world';
        // return view('user-apart.create');
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
    public function testStore(Request $request) {

        // $dataAll = $request -> all();
        // dd($dataAll); //Debug not working with ajax call

        $validateApartmentData = $request -> validate([  // migliorare validazione
            'imagefile' => 'required',
            'description' => 'required',
            'address' => 'required',
            'lat' => 'nullable',
            'lon' => 'nullable',
            'rooms' => 'required',
            'beds' => 'required',
            'bath' => 'required',
            'square_mt' => 'required',
            'configs_id' => 'nullable'
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
        // $data = $request -> values();
        // echo 'hello';
        // return response()->json(compact('data'));
        // return response()->json('ok');
    }

    public function store(Request $request)
    {
        $validateApartmentData = $request -> validate([
            'description' => 'required',
            'address' => 'required',
            'lat' => 'nullable',
            'lon' => 'nullable'
        ]);
        // return $validateApartmentData;

        $user = Auth::user();
        $apartment = Apartment::make($validateApartmentData);
        $apartment -> user() -> associate($user);
        $apartment -> save();
        
        // return view('user-apart.index'); // error con jquery
        return response() -> json(compact('validateApartmentData'));
        // return redirect(route('aparts.index'));
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
