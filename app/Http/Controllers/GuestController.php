<?php

namespace App\Http\Controllers;

use App\User;
use App\Apartment;
use Illuminate\Http\Request;

class GuestController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        $apartments= Apartment::all();
        return view('pages.public.index',compact('users','apartments'));
    }

      public function search(Request $request)
    {
        $data = $request ->all();
        $result = $data['search_field'];
    
        $apartments = Apartment::where('address', 'LIKE','%'.$result.'%')->get();
       
        return view('pages.public.search',compact('apartments'));
    }

    public function show($id)
    {
       
        $apartment= Apartment::findOrFail($id);
        return view('pages.public.apartment-show',compact('apartment'));
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
