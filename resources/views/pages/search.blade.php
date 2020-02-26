
@extends('layouts.base')


@section('search')
@include('components.header')
<main class='main-search nav-fix'>


    @include('components.searchvue')
    @include('components.apartment')


    <div id="data_search_field" data-search="{{ $search_field }}" data-user="{{ Auth::user() ?  Auth::user()-> id : '' }}"></div>
    <div id="app-search" class="container px-0 pb-0">

      <searchvue />
    </div>


</main>
@include('components.footer')
@endsection
