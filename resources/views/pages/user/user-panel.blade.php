@extends('layouts.base')
@section('user-panel')
@include('components.header')
<main>

    <div class="text-center">
        <h1>PANNELLO UTENTE</h1>
    </div>
@foreach ($apartments as $apartment)

  <a class="apt" href="{{route('user-apt.show', $apartment -> id )}}">
    <div class="info">
      <h3> {{$apartment -> id}} </h3>
      <h5> {{$apartment -> address}} </h5>
      <p> {{$apartment -> description}} </p>
    </div>
    <img src="{{$apartment -> image}}"/>
  </a>

@endforeach
</main>
@endsection
