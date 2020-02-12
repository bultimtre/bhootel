@extends('layouts.base')

@section('content')

    @foreach ($users as $user)

        <h3> {{ $user -> name }}</h3>
<ul>
        @foreach ($user -> apartments as $apartment)
       <li><p>{{$apartment -> description}}</p></li> 
        @endforeach
    </ul>    
        
          
@endforeach
@endsection

