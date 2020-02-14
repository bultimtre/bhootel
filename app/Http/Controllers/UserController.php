<?php

namespace App\Http\Controllers;

use App\Config;

use App\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Inline\Element\Code;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this -> middleware('auth');
    }
    public function index()
    {
        //return if logged
        $apartments= Apartment::orderBy('id', 'DESC')->paginate(10);
        return view('pages.index', compact('apartments'));
    }
    public function search(Request $request)
    {
        $data = $request -> all();
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

        return view('pages.user.create-apt', [
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

        // return Response()->json($request); //debug
        $validateApartmentData = $request -> validate([
            'imagefile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|max:850',
            'address' => 'required|max:255',
            'lat' => 'nullable|numeric|between:-90,90',
            'lon' => 'nullable|numeric|between:-90,180',
            'rooms' => 'required|integer|max:200',
            'beds' => 'required|integer|max:200',
            'bath' => 'required|integer|max:200',
            'square_mt' => 'required|integer|max:10000',
            'configs_id' => 'nullable|array|exists:configs,id',
            'show' => 'required|integer|min:0|max:1'
        ]);
            
        if ($validateApartmentData) {
            
            if (isset($validateApartmentData['imagefile'])) {
                

                $file = $request->file('imagefile');
                $filename = $file -> getClientOriginalName();
                $file -> move('images/user/'. Auth::user()->name, $filename);
                //save image path db da verificare
                $imageFilePath = 'images/user/'. Auth::user()->name.'/'. $filename;
                $validateApartmentData['image'] = $imageFilePath;
            }
            
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
                "description" => $validateApartmentData['description']
            ]);

        }
        

        return Response()->json([
                "success" => false,
                "imagefile" => ''
            ]);

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $apartment =Apartment::find($id);
        $configs=Config::all();
        return view('pages.user.update-apt',compact('apartment','configs'));
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
        $data = $request->all();
        $apartment = Apartment::findOrFail($id);
        $apartment->update($data);
        $configs = Config::find(isset($data['configs_id']));
        $apartment->configs()->sync($configs);
        
        return view('pages.user.show-apt', compact('apartment','configs'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apartment = Apartment::findOrFail($id);
        $apartment->configs()->sync([]);
        $apartment->delete();

        return redirect()->route('index.index');// nuova modifica
    }





    public function userPanel()
    {
        $user = Auth::user();
        $apartments = $user -> apartments() -> get();

        return view('pages.user.user-panel', compact('apartments'));
    }
}
