@extends('layouts.base')

@section('search')
@include('components.header')
    <main>

    
    <div id="data_search_field" data-search="{{ $search_field }}" data-user="{{ Auth::user() ?  Auth::user()-> id : ''}}"></div>
    @include('components.searchvue')
    <div id="app-search">

      <searchvue />
    </div>  


    </main>
@include('components.footer')
@endsection
