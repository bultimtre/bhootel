@extends('layouts.base')
@section('user-panel')
@include('components.header')
<main>
  
  <div class="container-fluid d-md-flex m-0 p-0" style="min-height:800px">
                
    <div class="left-select col-12 col-md-3 col-xl-2">
    </div>
    <div class="d-md-flex flex-column col-md-9 col-xl-10 mt-4 p-0">
      <div class="table-cont mb-5" style="overflow-y:scroll; overflow-x:hidden; height: 500px">
        <table class="table mt-5">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">TITLE</th>
              <th scope="col">THUMB</th>
              <th scope="col">DESCRIPTION</th>
              <th scope="col">SERVICES</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($apartments as $apartment)
              <tr class="first-row">
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
                <tr>
                  <td colspan="3">
                    <span>Promuovi questo appartamento</span>
                    <button style="background-color:#ff00c2; border:none" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#promo{{$apartment->id}}" aria-expanded="false" aria-controls="collapseExample">
                      <i class="fas fa-plus"></i>
                    </button>
                  </td>
                  <td colspan="2">
                    <button type="button" style="background-color:#ff00c2; border:none" class="btn btn-primary show-hide mb-3" data-toggle="button" aria-pressed="false" autocomplete="off">
                      Nascondi dagli annunci
                    </button>
                  </td>
                </tr>
                <tr>
                  <th>
                    <td colspan="5" class="collapse" id="promo{{$apartment->id}}">
                      <span>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Unde fuga mollitia ratione ut, deleniti consequuntur vel minus cumque molestiae perferendis, assumenda commodi accusantium iusto, totam veritatis sed quas. Ea, incidunt.
                      </sp>
                    </td>
                  </th>
                </tr>
              </tr>
              <tr>
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



<script>
  // script pulsanti user-panel
  $(".show-hide").click(function(){
    $(this).text($(this).text() == 'Mostra negli annunci' ? 'Nascondi dagli annunci' : 'Mostra negli annunci');
    $(this).css('opacity') === '1' ? $(this).css({'opacity':'0.3'}) : $(this).css({'opacity':'1'});
  });

</script>
@include('components.footer')
@endsection
