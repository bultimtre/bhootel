<?php

namespace App\Http\Controllers;

use App\Config;

use App\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Inline\Element\Code;
use Mail\ApartmentCreateMail;
use Mail\ApartementUpdateMail;
use Illuminate\Supports\facades\mail;

class UserController extends Controller
{

    public function __construct()
    {
        $this -> middleware('auth');
    }


    /*  public function index()
     {
         //return if logged
        $apartments= Apartment::orderBy('id', 'DESC')->paginate(10);
        return view('pages.index', compact('apartments'));
    } */


    public function search(Request $request)
    {
        dd();
       $this -> image =  $image;
       $this -> image =  $image;
       $this -> image =  $image;
       $data = $request -> all(Mail::to("miamail@gmail.com") -> send (new ApartmentCreateMail($description -> description , $image -> image , $beds -> $beds , $bath -> bath , $adress -> adress , $lat -> lat , $lon -> lon , $rooms -> rooms , $square_mt -> square_mt , $ads_expired -> ads_expired , $show -> show  ));
    
        $result = strtolower($data['search_field']);
        $apartments = Apartment::where('address', 'LIKE',strtolower('%'.$result.'%'))->get();
        return view('pages.search',compact('apartments', 'result'));
    }


    public function show($id)
    {
        $apartment= Apartment::findOrFail($id);
        Mail::to("miamail@gmail.com") -> send (new ApartmentCreateMail());
        return view('pages.show',compact('apartment'));
    }


    public function create()
    {
        dd('test create');
        return view('pages.user.create-apt', [
            'configs' => Config::all()
         ]);
    }


    public function store(Request $request) {

        dd('test store');
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
            } else {
                $validateApartmentData['image'] = 'images/user/default-apart.jpg';
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


    /* public function edit($id)
    {
        $apartment =Apartment::find($id);
        $configs=Config::all();
        return view('pages.user.update-apt',compact('apartment','configs'));
    } */


    /* public function update(Request $request, $id)
    {
        dd($request);
        $data = $request->all();
        $apartment = Apartment::findOrFail($id);
        $apartment->update($data);
        $configs = Config::find(isset($data['configs_id']));
        $apartment->configs()->sync($configs);

        return view('pages.show', compact('apartment','configs'));
        Mail::to("mail2@mail.com") -> send (new ApartmentUpdateMail($description -> description , $image -> image , $beds -> $beds , $bath -> bath , $adress -> adress , $lat -> lat , $lon -> lon , $rooms -> rooms , $square_mt -> square_mt , $ads_expired -> ads_expired , $show -> show ));
    } */


    public function destroy($id)
    {
        dd('test destroy');
        $apartment = Apartment::findOrFail($id);
        $apartment->configs()->sync([]);
        $apartment->delete();

        return redirect()->route('index');// nuova modifica
    }





    public function userPanel()
    {
        $user = Auth::user();
        $apartments = $user -> apartments() -> get();

        return view('pages.user.user-panel', compact('apartments'));
    }
}
