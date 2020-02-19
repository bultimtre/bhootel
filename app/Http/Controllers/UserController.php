<?php

namespace App\Http\Controllers;

use App\Config;
use App\Ad;
use App\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Inline\Element\Code;

class UserController extends Controller
{

    public function __construct()
    {
        $this -> middleware('auth');
    }

//non ho fatto nnt
    /*  public function index()
     {
         //return if logged
        $apartments= Apartment::orderBy('id', 'DESC')->paginate(10);
        return view('pages.index', compact('apartments'));
    } */


    public function search(Request $request)
    {
        $data = $request -> all();
        $result = strtolower($data['search_field']);
        $apartments = Apartment::where('address', 'LIKE',strtolower('%'.$result.'%'))->get();
        return view('pages.search',compact('apartments', 'result'));
    }


    // public function show($id)
    // {
    //     $apartment= Apartment::findOrFail($id);
    //     return view('pages.show',compact('apartment'));
    // }

    //nuova show per view count
        public function show(Request $request, $id)
    {

        $apartment= Apartment::findOrFail($id);
        $ads = Ad::all();
        $apartment -> viewsCount($request, $id, $apartment);

        return view('pages.show',compact('apartment','ads'));
    }



    public function create()
    {

        return view('pages.user.create-apt', [
            'configs' => Config::all()
         ]);
    }


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


    public function edit($id)
    {
        $apartment =Apartment::find($id);
        $configs=Config::all();
        return view('pages.user.update-apt',compact('apartment','configs'));
    }


    public function update(Request $request)
    {
        // return Response()->json($request); //debug
        $validateApartmentData = $request -> validate([
            'id' => 'required|exists:apartments,id',
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

        $userId = Auth::id();
        $apartment = Apartment::findOrFail($validateApartmentData['id']);

        if ($validateApartmentData
            && ($userId == $apartment -> user -> id)) {
            if (isset($validateApartmentData['imagefile'])) {
                $file = $request->file('imagefile');
                $filename = $file -> getClientOriginalName();
                $file -> move('images/user/'. Auth::user()->name, $filename);
                //save image path db da verificare
                $imageFilePath = 'images/user/'. Auth::user()->name.'/'. $filename;
                $validateApartmentData['image'] = $imageFilePath;
            }

            $apartment->update($validateApartmentData);

            if (isset($validateApartmentData['configs_id'])) {

                $configs = Config::find($validateApartmentData['configs_id']);
                $apartment->configs()->sync($configs);
            } else {
                $apartment->configs()->detach();
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


    public function destroy($id)
    {
        $apartment = Apartment::findOrFail($id);
        $apartment->configs()->sync([]);
        $apartment->delete();

        return redirect()->route('all.index');// nuova modifica
    }

    public function userPanel()
    {
        $user = Auth::user();
        $apartments = $user -> apartments() -> get();

        return view('pages.user.user-panel', compact('apartments'));
    }
<<<<<<< HEAD

    //  public function pay($id)
    // {
    //     //devo estrarre il prezzo dell'ad e mandarlo alla pag del pagamento
    //     $apartment = Apartment::find($id);
    //     //mi devo collegare all'ad
    //     dd($apartment);
    //    $ads = Ad::find($apartment['ads_id']);
    //             $apartment->configs()->sync($ads);
    //       dd($ads);
    //     return view('drop-ui',compact('ad'));
    // }
=======
    //commento provv
>>>>>>> 86bcbd0cb9ee362b12b292885f97b19ba0a988d1
}
