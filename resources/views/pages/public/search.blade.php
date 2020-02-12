@extends('layouts.base')

@section('search')

@foreach ($apartments as $apartment)

  <div>
      
    <p>[{{$apartment -> id}}]- {{$apartment -> address}}</p> 
    <p> {{$apartment -> description}}</p>
</div>

@endforeach

@endsection