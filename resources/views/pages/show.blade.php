
@extends('layouts.base')
@section('apt-show')
@include('components.header')
@php
    $now = date('Y-m-d H:i:s');
@endphp
<main class='main-show nav-fix' style="border:3px solid red">

    <div class="jumbotron jumbotron-fluid" style="background-image: url('{{asset('/images/sea_4_1920.jpg')}}');">
        {{-- <div class="container">
          <h1 class="display-4">{{$apartment->title}}</h1>
          <p class="lead">{{$apartment->description}}</p>
        </div> --}}

        <div class="container">
            <div>
                @guest
                    <p style="border:1px solid red"><a class="btn btn-lg btn-primary plus-info" href="#plus-info" data-scroll="plus-info" role="button">Chiedi Informazioni</a></p>
                @endguest
                {{-- @auth
                @if (Auth::user() -> id == $apartment -> user -> id)
                    <p><a class="btn btn-lg btn-primary" href="{{route('user-apt.edit', $apartment->id)}}" role="button">Modifica</a></p>

                    <form action=" {{route('user-apt.destroy', $apartment->id)}} " method="GET">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Elimina" class="btn btn-lg btn-danger">
                    </form>
                @else
                    <p><a class="btn btn-lg btn-primary" href="{{route('guest-apt.show', $apartment->id)}}" role="button">Chiedi Informazioni</a></p>
                @endif
                @endauth --}}
            </div>
        </div>

        <div class="main-wrapper px-md-5">
            {{-- Apartment MAP --}}
            <div class="d-flex justify-content-end">
                <div  id="apart-map" style="height:500px; width:500px;">
                    <div class="data-lat" data-lat="{{ $apartment -> lat }}"></div>
                    <div class="data-lon" data-lon="{{ $apartment -> lon }}"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9 div-colored offset-xl-1 p-0">
        <h1>&#8220; {{ $apartment->title }} &#8221;</h1>
    </div>


    @auth
        @if(Auth::user()->id == $apartment->user->id and $apartment->ads_expired > $now)
            <div class="ad-result">
                <p>Hai una sponsorizzazione attiva  </p>

                <p>scadrà giorno:</p>
                {{-- per tirarsi fuori i pagamenti precedenti  --}}
                @foreach ($apartment->ads  as $ad)
                    @if($loop->last)
                        <p>{{$ad->pivot->expire_date}}</p>
                    @endif
                @endforeach
            </div>
        @else
            <form action="{{route('payment.pay', $apartment->id)}}" method="get">
            @csrf
                @if (Auth::user()->id == $apartment->user->id)
                    <div class="alert alert-success">
                        <p>Seleziona la tua sponsorizzazione:</p>
                        <div class="form-group">
                        @foreach ($ads  as $ad)
                                <input  type="radio" name="ads" value="{{ $ad->id}}">
                                <label for="{{ $ad->price }}">
                                    {{ $ad->price/100 }} €
                                </label>
                                <br>
                        @endforeach
                            </div>
                        <button type="submit">Sponsorizza</button>
                    </div>
                @endif
            </form>
        @endif
    @endauth


    <div class="d-flex flex-wrap mt-3">
        <div class="col-4 p-5">
            <h3>Configurazione</h3>
            <span>Letti: {{$apartment -> beds}}</span>
            <p>Stanze: {{$apartment -> rooms}}</p>
            <p>Metri quadri: {{$apartment -> square_mt}}</p>
        </div>

        <div class="col-4 p-5">
            <h3>Descrizione</h3>
            <p> {{$apartment -> description}}</p>
        </div>

        <div class="col-4 p-5">
            <h3>Servizi</h3>
            @foreach ($apartment->configs as $config)
                <li> {{$config -> service}}</li>
            @endforeach
        </div>
    </div>

    <div class="d-flex flex-wrap mt-3">
        <div class="col-12 p-5">
            <h2>View Count: {{$apartment -> views}}</h2>
            <h3>Posizione dell'appartamento</h3>
            <p>{{$apartment -> address}}</p>
        </div>
    </div>


    @auth
        @if (Auth::user() -> id == $apartment -> user -> id)
            <a href="{{route('charts', $apartment -> id)}}">Vedi Statistiche</a>
        @endif
    @endauth


    @auth
        @if (Auth::user() -> id != $apartment -> user -> id)
            <form class="mt-5" id="uploadForm" method="POST" action="{{route('mail-store')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="email" class="col-md-4 col-form-label">Indirizzo Email</label>
                    <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" name="email" value="{{ Auth::user() -> email }}" required autocomplete="off">
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }} formField">
                    <label for="comment">Contatta il proprietario</label>
                    <input type="hidden" name="id" value=" {{$apartment -> user -> id}} ">
                    <input type="hidden" name="id-apt" value=" {{$apartment -> id}} ">
                    <textarea class="form-control" rows="5" name="text" maxlength="750"></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" name="button" class="btn btn-primary">Invia</button>
                </div>
            </form>
        @endif
    @endauth


    @guest
    <form id="plus-info" class="mt-5" id="uploadForm" method="POST" action="{{route('mail-store')}}" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="email" class="col-md-4 col-form-label">Indirizzo Email</label>
            <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="Inserisci email" name="email" value="" required autocomplete="email">
        </div>

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }} formField">
            <label for="comment">Contatta il proprietario</label>
            <input type="hidden" name="id" value=" {{$apartment -> user -> id}} ">
            <input type="hidden" name="id-apt" value=" {{$apartment -> id}} ">
            <textarea class="form-control" rows="5" name="text" maxlength="750"></textarea>
        </div>

        <div class="form-group">
            <button type="submit" name="button" class="btn btn-primary">Invia</button>
        </div>
    </form>
    @endguest

</main>
@include('components.footer')
@endsection
