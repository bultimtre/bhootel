@extends('layouts.base')
@section('user-panel')
@include('components.header')
<main class='main-panel nav-fix'>


    <div class="panel container-fluid d-flex m-0 p-0">
        <div class="panel_left col-md-3 m-0 p-0 pt-5">
            <div class="panel_left--avatar d-flex w-100 align-items-center py-2">
                <div class="div-icon px-2">
                    <img src="https://img.icons8.com/cute-clipart/64/000000/iron-man.png">
                </div>
                <div class="div-label px-2 " onclick="location.href=window.location.origin+'/user/user-panel'">
                    {{Auth::user()->name}}
                </div>
            </div>
            <div class="panel_left--create d-flex w-100 align-items-center py-2">
                <div class="div-icon px-3 disable">
                    <img src="https://img.icons8.com/ios/35/000000/plus.png">
                </div>
                <div class="div-label px-2" onclick="location.href=window.location.origin+'/user/create-apt'">
                    Nuovo appartamento
                </div>
            </div>
            <div class="panel_left--ads_price d-flex w-100 align-items-center py-2" data-toggle="modal" data-target="#price-table">
                <div class="div-icon px-3">
                    <img src="https://img.icons8.com/ios/35/000000/rating.png">
                </div>
                <div class="div-label px-2">
                    Tabella prezzi
                </div>
            </div>
            <div class="panel_left--disable d-flex w-100 align-items-center py-2" data-toggle="modal" data-target="#apt-disable">
                <div class="div-icon px-3">
                    <img src="https://img.icons8.com/ios/35/000000/box.png">
                </div>
                <div class="div-label px-2">
                    Annunci disattivati
                </div>
            </div>
            <div class="panel_left--profle d-flex w-100 align-items-center py-2 disable">
                <div class="div-icon px-3">
                    <img src="https://img.icons8.com/ios/35/000000/contacts.png">
                </div>
                <div class="div-label px-2">
                    Profilo Utente
                </div>
            </div>
            <div class="panel_left--settings d-flex w-100 align-items-center py-2 disable">
                <div class="div-icon px-3">
                    <img src="https://img.icons8.com/ios/35/000000/settings.png">
                </div>
                <div class="div-label px-2">
                    Impostazioni
                </div>
            </div>

        </div>
        <div class="panel_right d-md-flex flex-column flex-grow-1">
            <div class="title-panel py-4 px-5">
                <h3>La mia Dashboard</h3>
                <p>opzioni e interazioni</p>
            </div>
            <div class="panel_right-cards d-flex flex-row justify-content-around py-3 text-center">
                <div class="panel_right-cards--msgs py-3 px-2">
                    <div class="card">
                        <div class="card-title">APPARTAMENTI</div>
                        <h2>{{$apartments->count()}}</h2>
                    </div>
                </div>
                <div class="panel_right-cards--apts py-3 px-2">
                    <div class="card">
                        <div class="card-title">MESSAGGI</div>
                        <h2>{{$countMsg}}</h2>
                    </div>
                </div>
                <div class="panel_right-cards--views py-3 px-2">
                    <div class="card">
                        <div class="card-title">IN VETRINA</div>
                        <h2>{{$allAdsApt->count()}}</h2>
                    </div>
                </div>
            </div>
            <div class="panel_right-table table-cont p-5 mb-5">
                <div class="panel_right-table--apt ">
                    <div class="title">
                        <h5 class="title p-3 mb-0">I MIEI APPARTAMENTI</h5>
                    </div>
                    <div class="bh-table">
                        <table class="table mt-0">
                            <tbody>
                                @foreach ($apartments as $apartment)
                                <tr class="first-row">
                                    <td class="col-img">
                                        <a href="{{route('user-apt.show', $apartment -> id)}}">
                                            <div class="img-apt">
                                                <div class="wrap-div">
                                                    <div class="img-div">
                                                        <img src='{{ url('/') }}/{{$apartment -> image}}'/>
                                                    </div>
                                                    <div class="id-apt">
                                                        {{$apartment->id}}
                                                    </div>
                                                </div>

                                            </div>
                                        </a>
                                    </td>
                                    <td class="col-title">
                                        <div class="title-apt">
                                            {{$apartment->title}}
                                        </div>
                                    </td>
                                    <td class="col-desc">
                                        <div class="desc-apt">
                                            {{$apartment->description}}
                                        </div>
                                    </td>
                                    <td class="col-config">
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
                                    <td colspan="option">
                                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#promo{{$apartment->id}}" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fab fa-paypal"></i>
                                        </button>
                                        <div class="collapse" id="promo{{$apartment->id}}">
                                            <form action="">
                                                <ul>
                                                    <li>
                                                        <label for="price-a">2.99</label>
                                                        <input type="radio" name="price" id="price-a" value="2.99">
                                                    </li>
                                                    <li>
                                                        <label for="price-b">5.99</label>
                                                        <input type="radio" name="price" id="price-b" value="5.99">
                                                    </li>
                                                    <li>
                                                        <label for="price-b">6.99</label>
                                                        <input type="radio" name="price" id="price-c" value="6.99">
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>

                                        <button type="button" class="btn btn-primary show-hide mb-3" data-toggle="button" aria-pressed="false" autocomplete="off">
                                            Nascondi appartamento
                                        </button>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel_right-table-group mt-5 d-flex justify-content-xl-around justify-content-between">
                    <div class="panel_right-table--msg">
                        <div class="title">
                            <h5 class="title p-3 mb-0">POSTA IN ARRIVO</h5>
                        </div>
                        <div class="bh-table">
                            <table class="table">
                                <tbody>
                                    @foreach($allMsgsApt as $item)
                                        @foreach($item as $el)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="msg-icon px-2">
                                                        <i class="fas fa-envelope    "></i>
                                                    </div>
                                                    <div class="msg-msg">
                                                        {{$el->body}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="panel_right-table--ads">
                        <div class="title">
                            <h5 class="title p-3 mb-0">PROMO ATTIVE</h5>
                        </div>
                        <table class="table" >
                            <tbody>

                                @foreach($allAdsApt as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <div class="ads-icon px-2">
                                                    <i class="fas fa-award"></i>
                                                </div>
                                                <div class="ads-time activated">
                                                    attivato il:{{\Carbon\Carbon::create($item)->isoFormat('MM/DD/YYYY')}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>

                                            <div class="ads-time expire">
                                            @if(( \Carbon\Carbon::now())->diffInDays($item, false) < 0)
                                                stato: SCADUTO
                                                @else
                                                stato: ATTIVO
                                            @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- modals --}}
        <div class="price-table modal fade" id="price-table" tabindex="-1" role="dialog" aria-labelledby="price-table" aria-hidden="true">
            <div class="d-flex w-100 h-100 align-items-center ">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title px-5" id="exampleModalLabel">La nostra offerta</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body d-flex flex-row justify-content-center">

                            <!-- First -->
                            <div class="bh-modal-item bRad-all">
                                <div class="card mb-5 mb-lg-0 h-100 bRad-all">
                                    <div class="card-body p-0 bRad-top bRad-bottom">
                                        <div class="price_title p-3 pb-5 text-center bRad-top">
                                            <h1 class="bRad-top mb-3">24h</h1>
                                        </div>
                                        <div class="price_info">
                                            <div class="price_price text-center base">
                                                €2.99
                                            </div>
                                            <div class="price_details pt-5 px-3">
                                            <div class="py-2">Annuncio in vetrina</div>
                                            <div class="py-2">Durata 24h (1 giorno) <span class="sub_text">*previo annullamento dell'offerta</span></div>
                                            <div class="py-2">Possibilità di rinnovo</div>
                                            <div class="py-2">Offerta cumulabile</div>
                                        </div>
                                    </div>
                                        <div class="price_footer p-2 bRad-bottom"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Secondo-->
                            <div class="bh-modal-item bRad-all">
                                <div class="card mb-5 mb-lg-0 h-100 bRad-all">
                                    <div class="card-body p-0 bRad-top bRad-bottom">
                                        <div class="price_title p-3 pb-5 text-center bRad-top">
                                            <h1 class="bRad-top mb-3">72h</h1>
                                        </div>
                                        <div class="price_info">
                                            <div class="price_price text-center mid">
                                                €5.99
                                            </div>
                                            <div class="price_details pt-5 px-3">
                                            <div class="py-2">Annuncio in vetrina</div>
                                            <div class="py-2">Durata 24h (1 giorno) <span class="sub_text">*previo annullamento dell'offerta</span></div>
                                            <div class="py-2">Possibilità di rinnovo</div>
                                            <div class="py-2">Offerta cumulabile</div>
                                        </div>
                                    </div>
                                        <div class="price_footer p-2 bRad-bottom"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Third -->
                            <div class="bh-modal-item bRad-all">
                                <div class="card mb-5 mb-lg-0 h-100 bRad-all">
                                    <div class="card-body p-0 bRad-top">
                                        <div class="price_title p-3 pb-5 text-center bRad-top">
                                            <h1 class="bRad-top mb-3">144h</h1>
                                        </div>
                                        <div class="price_info">
                                            <div class="price_price text-center high">
                                                €9.99
                                            </div>
                                            <div class="price_details pt-5 px-3">
                                            <div class="py-2">Annuncio in vetrina</div>
                                            <div class="py-2">Durata 24h (1 giorno) <span class="sub_text">*previo annullamento dell'offerta</span></div>
                                            <div class="py-2">Possibilità di rinnovo</div>
                                            <div class="py-2">Offerta cumulabile</div>
                                        </div>
                                    </div>
                                        <div class="price_footer p-2 bRad-bottom"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="apt-disable modal fade" id="apt-disable" tabindex="-1" role="dialog" aria-labelledby="apt-disable" aria-hidden="true">
            <div class="d-flex w-100 h-100 align-items-center">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title px-5" id="exampleModalLabel">Appartamenti che hai nascosto dal nostro portale</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body d-flex flex-row justify-content-center">
                            <!-- First -->
                            <div class="bh-modal-item bRad-all">
                                <div class="card mb-5 mb-lg-0 h-100 bRad-all">
                                    <div class="card-body p-0 bRad-top bRad-bottom">
                                        <div class="apt_title p-3 pb-3 text-center bRad-top">
                                        <h1 class="bRad-top mb-3">{{$countHide->count()}}</h1>
                                            <p>nascosti</p>
                                        </div>
                                        <div class="apt_info">
                                            <div class="apt_details pt-2 px-3">
                                            @foreach($countHide as $apt)
                                            <div class="py-2">{{$apt->id}} - <a href="{{route('user-apt.show', $apartment -> id)}}">{{$apt->title}}</a></div>
                                            @endforeach
                                        </div>
                                    </div>
                                        <div class="price_footer p-2 bRad-bottom"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</main>

@include('components.footer')
@endsection
