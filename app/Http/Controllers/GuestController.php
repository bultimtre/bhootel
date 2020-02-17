<?php

namespace App\Http\Controllers;

use App\User;
use App\Apartment;
use App\Config;
use Illuminate\Http\Request;
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
    public function search(Request $request)
    {
        $data = $request -> all();
        $result = strtolower($data['search_field']);
        $apartments = Apartment::where('address', 'LIKE',strtolower('%'.$result.'%')) -> get();
        return view('pages.search',compact('apartments', 'result'));
    }
    //'guest-apt.show'
    public function show($id)
    {
        $apartment= Apartment::findOrFail($id);
        return view('pages.show',compact('apartment'));
    }
}
