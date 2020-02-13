@extends('layouts.base')

@section('search')
@include('components.header')
    <main>
        @if($apartments->count()>0)
            <div class="d-flex flex-wrap justify-content-center" style="">
                @foreach ($apartments as $apartment)
                    <div class="card flex-row w-25" style="margin:20px">
                        <div class="wrapper">
                            <img  class ="card-img-top w-100" src='{{$apartment -> image}}'/>
                            <div class="card-body w-100" style="">
                            <p class="card-text"  style="height:80px; overflow-y:hidden">{{$apartment -> description}}</p>
                            <div class="d-flex justify-content-end">
                                <span>{{ $apartment -> id }}</span>
                                <a class="btn btn-primary" href="{{route(Auth::user()? 'user-apt.show':'guest-apt.show', $apartment -> id )}}"> Più informazioni</a>
                            </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
        <div class="w-100 d-flex flex-column justify-content-center align-items-center">
            <h1 class="cover-heading">Errore di ricerca</h1>
            <p class="lead">Nessun appartamento trovato con "{{ $result }}"</p>
        </div>
        @endif
    </main>
@include('components.footer')
@endsection
