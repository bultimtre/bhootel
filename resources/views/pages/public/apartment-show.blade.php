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



@endsection