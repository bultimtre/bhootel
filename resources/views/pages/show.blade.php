@extends('layouts.base')
@section('apt-show')
@include('components.header')
@php
    $now = date('Y-m-d H:i:s');
@endphp
<main>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>


    <div class="carousel-inner" style="height:600px">

        <div class="carousel-caption text-left" style="bottom:200px" >
            <h1>Vista sul Mare</h1>
            <p>Descrizione {{$apartment -> description}}</p>
            @auth
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
            @endauth
        </div>
        <div class="carousel-item active">
            <img class="first-slide" src="{{ $apartment -> image }}" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="second-slide" src="{{ $apartment -> image }}" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="third-slide" src="{{ $apartment -> image }}" alt="Third slide">
        </div>
    </div>


    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>

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

         
    <div class="alert alert-success">
        @if (Auth::user()->id == $apartment->user->id)
        
            <p>Seleziona la tua sponsorizzazione:</p>

            <div class="form-group">
        
            @foreach ($ads  as $ad)

                    <input  type="radio" name="ads" value="{{ $ad->id}}">
                    <label for="{{ $ad->price }}">
                        [{{ $ad->id }}]-{{ $ad->price/100}}
                    </label>
                    <br>
            
            @endforeach
        
                </div>
            <button type="submit">Sponsorizza</button>
    
        @endif
    </div>
    </form>

@endif
@endauth
<p>data scadenza{{$apartment->ads_expired}}</p>
   <p>data oggi{{$now}} </p>                    
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
<hr>

<div class="d-flex flex-wrap mt-3">
    <div class="col-12 p-5">
        <h2>View Count: {{$apartment -> views}}</h2>
        <h3>Posizione dell'appartamento</h3>
        <p>{{$apartment -> address}}</p>
        {{-- Apartment MAP --}}
        <div id="apart-map" style="height:500px; width:500px;">
            <div class="data-lat" data-lat="{{ $apartment -> lat }}"></div>
            <div class="data-lon" data-lon="{{ $apartment -> lon }}"></div>
        </div>
    </div>
</div>

<a href="{{route('charts', $apartment -> id)}}">vedi stats</a>

@auth
@if (Auth::user() -> id != $apartment -> user -> id)

<form class="mt-5" id="uploadForm" method="POST" action="{{route('mail-store')}}" enctype="multipart/form-data">
    @csrf
    @method('POST')
    
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
<form class="mt-5" id="uploadForm" method="POST" action="{{route('mail-store')}}" enctype="multipart/form-data">
    @csrf
    @method('POST')
    
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