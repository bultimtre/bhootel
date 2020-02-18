<?php

namespace App\Http\Controllers;

use App\User;
use App\Apartment;
use App\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    public function __construct()
    {
        $this -> middleware('guest') -> except(['login','index']);
    }
    //'indx'
    public function index()
    {
        $users = User::all();
        $apartments = Apartment::orderBy('id', 'DESC') -> paginate(10);
        return view('pages.index',compact('users','apartments'));
    }
    //'search'
    //DA CANCELLARE SOSTITUITA NEL SEARCH CONTROLLER
    // public function search(Request $request)
    // {
    //     $data = $request -> all();
    //     $result = strtolower($data['search_field']);
    //     $apartments = Apartment::where('address', 'LIKE',strtolower('%'.$result.'%')) -> get();
    //     return view('pages.search',compact('apartments', 'result'));
    // }


    // public function show($id)
    // {
    //     $apartment= Apartment::findOrFail($id);
    //     return view('pages.show',compact('apartment'));
    // }

    //nuova show per view count
    public function show(Request $request, $id)
    {
            // return 'OOOO';
        $apartment= Apartment::findOrFail($id);
        $apartment -> viewsCount($request, $id, $apartment);
        return view('pages.show',compact('apartment'));
    }    


    public function create()
    {
        // $this -> middleware('Auth');

        return view('pages.user.create-apt', [
            'configs' => Config::all()
        ]);
    }


    public function store(Request $request)
    {
        //
    }


    public function edit(User $user)
    {
        //
    }


    public function update(Request $request, User $user)
    {
        //
    }


    public function destroy(User $user)
    {
        //
    }


}
