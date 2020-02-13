<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Apartment;
use Illuminate\Support\Str;


class UserController extends Controller
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
        //return if logged
        $apartments= Apartment::all();
        return view('pages.index', compact('apartments'));
    }
    public function search(Request $request)
    {
        $data = $request ->all();
        $result = strtolower($data['search_field']);
        $apartments = Apartment::where('address', 'LIKE',strtolower('%'.$result.'%'))->get();
        return view('pages.search',compact('apartments', 'result'));
    }
    public function show($id)
    {
        $apartment= Apartment::findOrFail($id);
        return view('pages.user.show-apt',compact('apartment'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // echo 'hello world';
        return view('pages.user.create-apt');
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

        // request()->validate([
        //     'imagefile' => 'required',
        // ]);

        $validateApartmentData = $request -> validate([
            'imagefile' => 'required',
            'description' => 'required',
            'address' => 'required',
            'lat' => 'nullable',
            'lon' => 'nullable',
            'rooms' => 'required',
            'beds' => 'required',
            'bath' => 'required',
            'square_mt' => 'required',
        ]);

        if ($validateApartmentData) {
            $file = $request->file('imagefile');

            $filename = $file -> getClientOriginalName();
            $file -> move('images/user/'. Auth::user()->name, $filename);
            //save image path db da verificare
            $imageFilePath = 'images/user/'. Auth::user()->name.'/'. $filename;
            $validateApartmentData['image'] = $imageFilePath;

            $user = Auth::user();
            $apartment = Apartment::make($validateApartmentData);
            $apartment -> user() -> associate($user);
            $apartment -> save();



            return Response()->json([
                "success" => true,
                "imagefile" => $filename,
                "description" => $validateApartmentData['description']
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
