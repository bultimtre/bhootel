<?php

namespace App\Http\Controllers;




use App\User;
use App\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('login');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        $apartments= Apartment::orderBy('id', 'DESC')->paginate(10);
        return view('pages.index',compact('users','apartments'));
    }

    public function search(Request $request)
    {
        $data = $request ->all();
        $result = strtolower($data['search_field']);
        $apartments = Apartment::where('address', 'LIKE',strtolower('%'.$result.'%'))->get();
        return view('pages.search',compact('apartments', 'result'));
    }

    // public function show($id)
    // {
    //     $apartment= Apartment::findOrFail($id);
    //     return view('pages.public.show-apt',compact('apartment'));
    // }
    public function show(Request $request, $id)
    {
            // return 'OOOO';
        $apartment= Apartment::findOrFail($id);

        // $userId = Auth::id();
        // return $userId;
        // if(!isset(Auth::user()->name)) {

        $apartment -> viewsCount($request, $id, $apartment);
        // if(Auth::id()) {
        //     return Auth::id();
        // } else {
        //     return 'no id';
        // }

        // if (Auth::id() !== $apartment -> user -> id) {
        //     //implementing view counter with sessions
        //     $apartKey = 'apart_' .$id;

        //     if(!$request->session()->has($apartKey)) {
        //         $request->session()->put('apart_' .$id, 1);
        //         //update view counter apartment
        //         $apartment->increment('views');
        //     } 
        // }


        // $value = $request->session()->all();
        // return $value;
        return $apartment;

        // $apartment= Apartment::findOrFail($id);
        // return view('pages.public.show-apt',compact('apartment'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }


}
