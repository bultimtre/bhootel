@extends('layouts.base')

@section('guest_index')
  @include('components.header')

    @foreach ($apartments as $apartment)
    
    <a class="apt" href="{{route('apartment.show', $apartment -> id )}}">
      <div class="info">
        <h3> {{$apartment -> id}} </h3>
        <h5> {{$apartment -> address}} </h5>
        <p> {{$apartment -> description}} </p>
      </div>
      <img src="{{$apartment -> image}}"></img>
    </a>
    @endforeach

  <div class="links">
    {{ $apartments->links() }}
  </div>  

  @include('components.footer')
@endsection

