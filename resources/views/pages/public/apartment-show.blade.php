@extends('layouts.base')

@section('apt-show')

<h2>PUBLIC APARTMENT</h2>



  <div>
      
    <p>[{{$apartment -> id}}]- {{$apartment -> address}}</p> 
    <p> {{$apartment -> description}}</p>
    <p>Rooms: {{$apartment -> rooms}}</p>
    <p> Beds:{{$apartment -> beds}}</p>
    <p> M2:{{$apartment -> square_mt}}</p>
    @if ($apartment -> bath)
        <p> Baths:{{$apartment -> bath}}</p>
    @endif
    
</div>

  <img class="map-img" src="" alt="apart-map">

  <div id="apart-map">
    <div class="data-lat" data-lat="{{ $apartment -> lat }}"></div>
    <div class="data-lon" data-lon="{{ $apartment -> lon }}"></div>
  </div>

  


@endsection