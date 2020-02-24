<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With"); ?>
@extends('layouts.base')


@section('search')
@include('components.header')
<main class='main-search nav-fix'>

    
    @include('components.searchvue')
    @include('components.apartment')


    <div id="data_search_field" data-search="{{ $search_field }}" data-user="{{ Auth::user() ?  Auth::user()-> id : '' }}"></div>
    <div id="app-search" class="container p-0">

      <searchvue />
    </div>


</main>
@include('components.footer')
@endsection
