<?php

namespace App\Http\Controllers;

use App\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\IndexController;


class TestController extends Controller
{
    public function test(){
        dd(IndexController::notableApt());
    }

}
