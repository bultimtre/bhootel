@extends('layouts.base')

@section('search')
@include('components.header')
    <main>

        <div class="wrapper main-search" style="box-shadow: 0 0 30px 1px rgba(0, 0, 0, 0.2)">
            <div class="top-select d-flex justify-content-around align-items-center w-100">

                <div class="select">
                    <select name="select" id="">
                        <option value="value">value</option>
                        <option value="value2">value2</option>
                        <option value="value3">value3</option>
                        <option value="value4">value4</option>
                    </select>
                </div>

                <div class="input">
                    <input type="text" name="input" id="">
                </div>
                
                <div class="input">
                    <input type="text" name="input" id="">
                </div>

            </div>
    
            <div class="container-fluid d-md-flex m-0 p-0" style="min-height:800px">
                
                <div class="left-select col-12 col-md-3 col-xl-3"></div>
                
                @if($apartments->count()>0)
                <div class="d-md-flex flex-column col-md-9 col-xl-9 mt-4">
                    @foreach ($apartments as $apartment)
                        <div class="card flex-row" style="margin:20px">
                            <div class="wrapper d-lg-flex w-100">
                                <div class="card-img d-lg-flex m-0 p-0"">
                                {{-- <div class="card-img d-md-flex col-12 col-md-4 m-0 p-0" style="background-image:url('{{$apartment -> image}}'); background-repeat:no-repeat; background-position:left; background-size:cover"> --}}
                                    <img class ="card-img-top image-fluid" style="height:100%" src='{{ url('/') }}/{{$apartment -> image}}'/>
                                </div>
                                <div class="card-body w-100 d-flex flex-grow-1 " style="background-color:#f2f2f2">
                                    <div class="desc d-lg-flex flex-column h-100 pr-2">
                                        <p class="card-text text-uppercase font-weight-bold">{{$apartment -> title}}</p>
                                        <p class="card-text long">{{\Illuminate\Support\Str::limit($apartment -> description, $limit = 70, $end = '...')}}</p>
                                        <p class="card-text short">{{\Illuminate\Support\Str::limit($apartment -> description, $limit = 30, $end = '...')}}</p>
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
                                        <i id="heart" class="far fa-heart heart" style="color:$bh-details;"></i>
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

        {{-- <div class="w-100 d-flex justify-content-center py-5">
            <div>
                {{$apartments->links()}}
            </div>
        </div> --}}

    </main>
@include('components.footer')
@endsection
