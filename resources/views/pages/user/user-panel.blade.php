@extends('layouts.base')
@section('user-panel')
@include('components.header')
<main class='main-panel nav-fix'>

    <div class="panel container-fluid d-flex m-0 p-0" style="border:1px solid red">
        <div class="panel_left col-1 col-md-3 col-xl-2" style="border:1px solid red">
            pippo
        </div>
        <div class="panel_right d-md-flex flex-column flex-grow-1" style="border:1px solid red">
            <div class="panel_right-cards">
                <div class="panel_right-cards--msgs">
                    <div class="card">
                        {{$apartments->count()}}
                    </div>
                </div>
                <div class="panel_right-cards--apts">
                    <div class="card">
                        {{$countMsg}}
                        {{$collection}}
                        {{-- @foreach($collection as $collected)
                            {{$collected->number}}
                        @endforeach --}}
                    </div>
                </div>
                <div class="panel_right-cards--views">
                    <div class="card"></div>
                </div>
            </div>
            <div class="panel_right-table table-cont p-5 mb-5">
                <div class="panel_right-table--apt ">
                    <div class="title">
                        <h3 class="title pb-2 pl-2 mb-0">I MIEI APPARTAMENTI</h3>
                    </div>
                    <div class="bh-table">
                        <table class="table mt-0">
                            <thead>
                                <tr>
                                <th scope="col" style="border:1px solid red">ID</th>
                                <th scope="col" style="border:1px solid red">TITLE</th>
                                <th scope="col" style="border:1px solid red"></th>
                                <th scope="col" style="border:1px solid red">DESCRIPTION</th>
                                <th scope="col" style="border:1px solid red">SERVICES</th>
                                <th scope="col" style="border:1px solid red"></th>
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
                </div>
                <div class="panel_right-table--msg" style="height:500px; border:10px solid fuchsia" >
                    <table class="panel_right-table-apt table mt-5">
                        <div>
                            <h2>MESSAGGI</h2>
                        </div>
                         <thead>
                         <tr>
                             <th scope="col">ID</th>
                         </tr>
                         </thead>
                     </table>
                </div>
            </div>
        </div>
    </div>

</main>

@include('components.footer')
@endsection
