@extends('layouts.base')
@section('apt-show')
@include('components.header')
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
            @if (Auth::user() -> id == $apartment -> user -> id) 
                <p><a class="btn btn-lg btn-primary" href="{{route('index.edit', $apartment->id)}}" role="button">Modifica</a></p>
                <form action=" {{route('index.destroy', $apartment->id)}} " method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Elimina" class="btn btn-lg btn-danger">
                </form>
            @else
                <p><a class="btn btn-lg btn-primary" href="{{route('index.edit', $apartment->id)}}" role="button">Chiedi Informazioni</a></p>
            @endif
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

<div class="d-flex flex-wrap mt-3">
    <div class="col-4 p-5">
        <h3>Configurazione</h3>
        <span> Beds:{{$apartment -> beds}}</span>
        <p>Rooms: {{$apartment -> rooms}}</p>
        <p> M2:{{$apartment -> square_mt}}</p>
        <p> M2:{{$apartment -> sight_mt}}</p>
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
{{-- <div class="d-flex flex-wrap mt-3">
    <div class="col-12 p-5">
        <h3>Posizione dell'appartamento</h3>
        <p>{{$apartment -> address}}</p>
        <p>MAPPA QUI?</p>
    </div>
</div> --}}


</main>
{{-- mettere le statistiche --}}
@include('components.footer')
@endsection