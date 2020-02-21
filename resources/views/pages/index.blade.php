@extends('layouts.base')

@section('guest_index')
@include('components.header')

<main>

    <div class="container-fluid wrapper main">
        <div class="container-fluid bg-index">
        </div>
        <div class="bg-index-gradient"></div>
        <div class="container-fluid wrapper">
            @include('components.search-bar')
        </div>
    </div>

    <div class="d-flex flex-wrap justify-content-center">
        @foreach ($apartments as $apartment)
            <div class="card flex-row w-25" style="margin:20px">
                <div class="wrapper">
                    <img  class ="card-img-top w-100" src='{{asset ($apartment -> image) }}'/>
                    <div class="card-body w-100" style="">
                    <p class="card-text"  style="height:80px; overflow-y:hidden">{{$apartment -> description}}</p>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary" href="{{route (Auth::user() ? 'user-apt.show' :'guest-apt.show', $apartment -> id )}}"> Più informazioni</a>
                    </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="w-100 d-flex justify-content-center py-5">
        <div>
            {{$apartments->links()}}
        </div>
    </div>

</main>

@include('components.footer')
@endsection

