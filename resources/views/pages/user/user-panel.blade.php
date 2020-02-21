@extends('layouts.base')
@section('user-panel')
@include('components.header')
<main>
  
  <div class="container-fluid d-md-flex m-0 p-0" style="min-height:800px">
                
    <div class="left-select col-12 col-md-3 col-xl-3">
    </div>
    <div class="d-md-flex flex-column col-md-9 col-xl-9 mt-4">
      <div style="overflow-y:scroll; overflow-x:hidden; height: 400px">
        <table class="table mt-5">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">TITLE</th>
              <th scope="col">THUMB</th>
              <th scope="col">DESCRIPTION</th>
              <th scope="col">SERVICES</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($apartments as $apartment)
              <tr>
                <td scope="row">
                  <a href="{{route('user-apt.show', $apartment -> id)}}">
                    {{$apartment->id}}
                  </a>
                </td>
                <td>
                  <a href="{{route('user-apt.show', $apartment -> id)}}">
                    {{$apartment->title}}
                  </a>
                </td>
                <td>
                  <img style="height:50px" src='{{ url('/') }}/{{$apartment -> image}}'/>
                </td>
                <td>
                  {{$apartment->description}}
                </td>
                <td>
                  <ul class="list-group list-group-horizontal justify-content-start">
                    @foreach ($apartment->configs as $config)
                        @switch($config->service)
                            @case('wifi')
                            <li class="list-group-item py-0 pr-2"><i class="fas fa-wifi"></i></li>
                                @break
                            @case('parking')
                            <li class="list-group-item py-0 pr-2"><i class="fas fa-parking"></i></li>
                                @break
                            @case('pool')
                            <li class="list-group-item py-0 pr-2"><i class="fas fa-swimming-pool"></i></li>
                                @break
                            @case('reception')
                            <li class="list-group-item py-0 pr-2"><i class="fas fa-concierge-bell"></i></li>
                                @break
                            @case('sauna')
                            <li class="list-group-item py-0 pr-2"><i class="fas fa-hot-tub"></i></li>
                                @break
                            @case('sight')
                            <li class="list-group-item py-0 pr-2"><i class="fas fa-eye"></i></li>
                                @break
                            @default
                                
                        @endswitch
                    @endforeach
                    </ul>
                </td>
              </tr>
              <tr>
                <td colspan="5">
                  <button>view</button>
                  <button>ad</button>
                </td>
              </tr>
              <tr>
                <td>
                  PROMOZIONI
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <table class="table mt-5">
        <thead>
          <tr>
            <th scope="col">MESSAGGI</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

</main>
@endsection
