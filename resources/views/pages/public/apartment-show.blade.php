@extends('layouts.base')

@section('apt-show')

  <h2>{{$apartment -> id}}</h2>
        
  <p> {{$apartment -> address}}</p> 
  <p> {{$apartment -> description}}</p>
  <p>Rooms: {{$apartment -> rooms}}</p>
  <p>Beds: {{$apartment -> beds}}</p>
  <p>M2: {{$apartment -> square_mt}}</p>
  <p>Baths: {{$apartment -> bath}}</p>
  @if ($apartment -> image)
    <img src="{{$apartment -> image}}"></img>
  @endif

@endsection