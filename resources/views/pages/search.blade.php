@extends('layouts.base')

@section('search')
@include('components.header')
    <main>

        <div class="wrapper main-search">
            <div class="top-select"></div>
    
            <div class="container-fluid d-md-flex m-0 p-0" style="min-height:800px">
                
                <div class="left-select col-12 col-md-3 col-xl-3"></div>
                
                @if($apartments->count()>0)
                <div class="d-md-flex flex-column col-md-10 col-xl-9 mt-4">
                    @foreach ($apartments as $apartment)
                        <div class="card flex-row" style="margin:20px">
                            <div class="wrapper d-md-flex w-100">
                                <div class="img col-md-4 m-0 p-0">
                                    <img class ="card-img-top image-fluid" style="height:100%" src='{{$apartment -> image}}'/>
                                </div>
                                <div class="card-body w-100 d-flex flex-grow-1 " style="background-color:#f2f2f2; height:170px">
                                    <div class="desc d-md-flex flex-column h-100 pr-2">
                                        <p class="card-text text-uppercase font-weight-bold">{{$apartment -> title}}</p>
                                        <p class="card-text">{{\Illuminate\Support\Str::limit($apartment -> description, $limit = 70, $end = '...')}}</p>
                                        <ul class="list-group list-group-horizontal justify-content-start">
                                        @foreach ($apartment->configs as $config)
                                            @switch($config->service)
                                                @case('wifi')
                                                <li class="list-group-item py-0 pr-2"><i class="fas fa-wifi"></i></li>
                                                    @break
                                                @case('parking')
                                                <li class="list-group-item py-0 pr-2"><i class="fas fa-parking"></i></li>
                                                    @break
                                                @case('pool')
                                                <li class="list-group-item py-0 pr-2"><i class="fas fa-swimming-pool"></i></li>
                                                    @break
                                                @case('reception')
                                                <li class="list-group-item py-0 pr-2"><i class="fas fa-concierge-bell"></i></li>
                                                    @break
                                                @case('sauna')
                                                <li class="list-group-item py-0 pr-2"><i class="fas fa-hot-tub"></i></li>
                                                    @break
                                                @case('sight')
                                                <li class="list-group-item py-0 pr-2"><i class="fas fa-eye"></i></li>
                                                    @break
                                                @default
                                                    
                                            @endswitch
                                        @endforeach
                                        </ul>
                                    </div>
                                    <div class="d-flex flex-column justify-content-between align-items-center border-left mx-auto pl-3">
                                        <i onclick="click()" id="heart" class="far fa-heart heart"></i>
                                        <p class="card-text" style="font-weight:700; font-size:1.3rem">{{($apartment -> price)/100}}€</p>
                                        <a class="btn btn-primary button-show" href="{{route(Auth::user()? 'user-apt.show':'guest-apt.show', $apartment -> id )}}">Info</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @else
                <div class="w-100 d-flex flex-column justify-content-start align-items-center pt-5">
                    <h1 class="cover-heading">Errore di ricerca</h1>
                    <p class="lead">Nessun appartamento trovato con "{{ $result }}"</p>
                </div>
                @endif
            </div>
        </div>

        <div class="w-100 d-flex justify-content-center py-5">
            <div>
                {{$apartments->links()}}
            </div>
        </div>

    </main>
@include('components.footer')
@endsection
