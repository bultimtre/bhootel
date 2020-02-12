@extends('layouts.base')

@section('guest_index')

<form action="{{route('guest.search')}}" method="post">
@csrf
@method('POST')

<label for="search_field">Search:</label>
<input name= 'search_field' type="text">

<button type="submit"> Cerca </button>
</form>


  @foreach ($apartments as $apartment)

  <div>
      <a href="{{route('apartment.show', $apartment -> id )}}"> [{{$apartment -> id}}]</a>
      
    <p>- {{$apartment -> address}}</p> 
    <p> {{$apartment -> description}}</p>
</div>
@endforeach  


@endsection

