<script type="text/x-template" id="searchvue">


        <div class="searchvue container p-0">
            <div class="search__top d-flex w-100">
                <form role="form" class='w-100'>


                    <fieldset id="coords-disable">
                        <h5>Ricerca alternativa per coordinate</h5>
                        <div class="row">
                        {{-- <div class="col-sm-4">
                            <label for="vue-lat">latitudine: </label>
                            <input type="text" class="form-control" v-on:keyup="evData()" v-model="lat" id="vue-lat" placeholder="latitude"/>
                        </div>
                        <div class="col-sm-4">
                            <label for="vue-lon">longitudine: </label>
                            <input type="text" class="form-control" v-on:keyup="evData()" v-model="lon" id="vue-lon" placeholder="longitudine"/>
                        </div> --}}
                        <div class="col-sm-8">
                            <label for="vue-alt-search">Cerca appartamento: </label>
                            <input type="text" class="form-control" v-on:keyup="evData()" v-model="alt_search_field" id="vue-alt-search" placeholder="Inserisci indirizzo"/>
                        </div>
                        <div class="col-sm-4">
                            <label for="vue-range">distanza (km): </label>
                            <input type="text" class="form-control" v-on:keyup="evData()" v-model="range" id="vue-range" placeholder="raggio"/>
                        </div>
                        </div>
                    </fieldset>

                </form>
            </div>


            <div class="container-fluid search__bottom d-md-flex m-0 p-0">

                <div class="search__bottom-left col-12 col-md-3 col-xl-3">
                    <div class="quick-search">
                        <div class="form-group">
                            <label for="vue-search_field">Cerca appartamento: </label>
                            <input type="text" class="form-control inputsrc" v-on:keyup="evData()" v-model="search_field" id="vue-search_field"/>
                            <h3 style="display:inline">@{{ res_num }} </h3>
                            {{-- <h3 style="display:inline" v-text="searchString"></h3> --}}
                        </div>
                    </div>
                    <div class="row m-0 option-search" style="border:1px solid red">

                        <div class="d-flex flex-column align-items-start p-0 div-num-input">
                            <label class="input-label-style m-0 py-2" for="vue-rooms">Numero di stanze:</label>
                            <div class="d-flex input-num-style">
                                <input class="input-num" v-on:keyup="evData()" v-model="rooms" id="vue-rooms" type="number" step="1" min="1" max="50">
                                <div class='num-arrow'>
                                    <span id='num-up' v-on:click="updateNum()" data-finder="rooms_up"></span>
                                    <span id='num-down' v-on:click="updateNum()" data-finder="rooms_down"></span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column align-items-start p-0 ml-5 div-num-input">
                            <label class="input-label-style m-0 py-2" for="vue-beds">Numero di letti:</label>
                            <div class="d-flex input-num-style">
                                <input class="input-num" v-on:keyup="evData()" v-model="beds" id="vue-beds" type="number" step="1" min="1" max="50">
                                <div class='num-arrow'>
                                    <span id='num-up' v-on:click="updateNum()" data-finder="beds_up"></span>
                                    <span id='num-down' v-on:click="updateNum()" data-finder="beds_down"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group check-search">
                        <div v-for='config in configs' class="form-check form-check-inline">
                        <input type="checkbox" :value='config.id' v-model="checkedConfigs" class="form-check-input config-checkbox" @change="evData()">
                        <label for="config-checkbox" >@{{ config.service}}</label>
                        </div>
                    </div>

                </div>

                <div class="search__bottom-right d-md-flex flex-column col-md-9 col-xl-9">
                        <single-apartment v-for='(apartment, index) in apartments' :key="index" :apartment='apartment'></single-apartment>
                </div>
            </div>
        </div>





</script>

<script type="text/javascript">
  Vue.component('searchvue', {
    template: "#searchvue",
    data() {
      return {
        api_key : 'eHsDmslbcIzT8LG5Yw54AH9p2munbhhh',
        CSRF_TOKEN : '',
        auth_user: '',
        baseUrl: window.location.protocol + "//" + window.location.host + "/",
        search_field: '',
        alt_search_field: '',
        rooms:1,
        beds:1,
        lat: '',
        lon: '',
        range: 20,
        route_show: '',
        searchDone: {},
        searchString: '',
        apartments: [],
        configs: [],
        checkedConfigs: [],
        res_num: '',
      };
    }
    ,
    watch: {
      search_field: function() {
        if (this.search_field.length > 0) {
          $('#coords-disable').prop("disabled", true);
        } else {
          $('#coords-disable').removeAttr("disabled");
        }
      }
    },
    created() {
        // window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'; //????//????

      this.CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      this.search_field = $('#data_search_field').attr('data-search');
      this.auth_user = $('#data_search_field').attr('data-user');
      this.getAparts();
      this.getAllConfigs();
    },
    methods: {
        getAllConfigs() {
            axios.get(this.baseUrl+'search/configs').then(resp => {
                // console.log('configs ', resp);
                if(resp.status == 200) {
                    this.configs = resp.data;
                }
            })
            .catch(err => {
                this.error = "Error downloading configs";
                console.log('err', err)
            });
        },
        // evData() { // da controllare, alt sost tutti eventi v-on e @change con getAparts()
        //     if((this.search_field.length >=1) ||
        //     ((this.lat >=-90 && this.lat <=90) && (this.lon >=-180 && this.lon <=180) && (this.range > 0))
        //     ) {
        //         this.getAparts();
        //     } else {
        //         this.res_num = 'Inserire i parametri corretti';
        //         this.apartments = [];
        //         this.searchString = '';
        //     }

        // },
        evData() { // da controllare, alt sost tutti eventi v-on e @change con getAparts()
            if(this.search_field.length >=1) {
                this.getAparts();
            } else if (this.alt_search_field.length >=1) {
                this.getCoords();
            }
             else {
                this.res_num = 'Inserire i parametri corretti';
                this.apartments = [];
                this.searchString = '';
            }

        },
        getCoords() {
            window.axios.defaults.headers.common = {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            };
            axios.get("https://api.tomtom.com/search/2/geocode/" + this.alt_search_field + ".json?limit=1&key=" + this.api_key)
            .then(resp => {
                // console.log('configs ', resp);
                if(resp.status == 200) {
                    console.log('coord resp', resp);
                    var position = resp.data.results[0].position;
                    this.lat = position.lat;
                    this.lon = position.lon;
                    this.getAparts();
                }
            })
            .catch(err => {
                this.error = "Error downloading configs";
                console.log('err', err)
            });
        },
        getAparts() {
            axios.post(this.baseUrl + 'search', {
                search_field: this.search_field,
                rooms: this.rooms,
                beds: this.beds,
                lat: this.lat,
                lon: this.lon,
                range: this.range,
                configs: this.checkedConfigs
            })
            .then(res => {

                console.log('res', res);

                const data = res.data;
                if (data.success == true) {
                    this.apartments = data.data;
                    // this.updateResults(data.searchFor);
                } else {
                    console.log('success false');
                    // this.updateResults('');
                }
                if(this.apartments.length == 1) {
                    this.res_num = '1 Risultato trovato';
                } else if (this.apartments.length > 0){
                    this.res_num = this.apartments.length + ' Risultati trovati';

                }  else {
                    this.res_num = 'Nessun Risultato trovato';
                }
                console.log('ajax call: ', this.res_num);

            })
            .catch(err => {

                this.error = "Error downloading data albums";
                console.log('err', err)
            });
        },
        // updateResults(data) {
        //     // console.log('update results', data);
        //     if(data) {
        //         this.searchString = (data.search_field) ? `per: ${data.search_field}`
        //         : `per: lat ${data.lat} - lon ${data.lon} - raggio ${data.range / 1000}km`;
        //     } else {
        //         this.searchString = '';
        //     }

        // },
        updateNum(){
            e_obj = event.target
            finder = e_obj.getAttribute('data-finder');
            if(finder.includes('rooms')){
                finder=='rooms_up'? this.rooms++ : this.rooms == 1 ? this.rooms=1 : this.rooms--;
            } else if(finder.includes('beds')){
                finder=='beds_up'? this.beds++ : this.beds == 1 ? this.beds=1 : this.beds--;
            }
            this.evData()
        },
    }
});

</script>
{{-- //css --}}
{{--<div class="container-fluid d-md-flex m-0 p-0" style="min-height:800px">

    <div class="left-select col-12 col-md-3 col-xl-3"></div>







                    {{-- <div class="card-img d-md-flex col-12 col-md-4 m-0 p-0" style="background-image:url('{{$apartment -> image}}'); background-repeat:no-repeat; background-position:left; background-size:cover"> --}}
                     {{--   <img class ="card-img-top image-fluid" style="height:100%" src='{{ url('/') }}/{{$apartment -> image}}'/>
                    </div>

                    <div class="card-body w-100 d-flex flex-grow-1 " style="background-color:#f2f2f2">
                        <div class="desc d-lg-flex flex-column h-100 pr-2">
                            <p class="card-text text-uppercase font-weight-bold">{{$apartment -> title}}</p>
                            <p class="card-text long">{{\Illuminate\Support\Str::limit($apartment -> description, $limit = 70, $end = '...')}}</p>
                            <p class="card-text short">{{\Illuminate\Support\Str::limit($apartment -> description, $limit = 30, $end = '...')}}</p>
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
                        </div>
                        <div class="d-flex flex-column justify-content-between align-items-center border-left mx-auto pl-3">
                            <i id="heart" class="far fa-heart heart" style="color:$bh-details;"></i>
                            <p class="card-text" style="font-weight:700; font-size:1.3rem">{{($apartment -> price)/100}}€</p>
                            <a class="btn btn-primary button-show" href="{{route(Auth::user()? 'user-apt.show':'guest-apt.show', $apartment -> id )}}">Info</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @else
    <div class="w-100 d-flex flex-column justify-content-start align-items-center pt-5">
        <h1 class="cover-heading">Errore di ricerca</h1>
        <p class="lead">Nessun appartamento trovato con "{{ $result }}"</p>
    </div>
    @endif
</div>

{{-- css --}}
{{-- <div class="w-100 d-flex justify-content-center py-5">
    <div>
        @{{$apartments->links()}}
    </div>
</div> --}}

{{-- resultato in stringa --}}
{{-- <h3 style="display:inline">@{{ res_num }} </h3><h3 style="display:inline" v-text="searchString"></h3>
    <div class="form-group">
    <label for="vue-search_field">Cerca appartamento: </label>
    <input type="text" class="form-control inputsrc" v-on:keyup="evData()" v-model="search_field" id="vue-search_field"/>
    </div> --}}

             {{-- <div v-for='apartment in apartments' class="card flex-row" style="margin:20px">
                <div class="wrapper">
                    <div class="card-body w-100" style="">
                    <img  class ="card-img-top w-100" :src="setImage(apartment.image)"/>
                    <p class="card-text">@{{ apartment.description}}</p>
                    <p class="card-text">address: @{{ apartment.address}}</p>
                    <p class="card-text">beds: @{{ apartment.beds}}</p>
                    <p class="card-text">rooms: @{{ apartment.rooms}}</p>
                    <p class="card-text">baths: @{{ apartment.bath}}</p>
                    <p class="card-text">square_mt: @{{ apartment.square_mt}}</p>
                    <div class="d-flex justify-content-end">
                        <span>@{{ apartment.id}}</span>
                    </div>
                    <a class="btn btn-primary" :href="showApart(apartment.id)"> Più informazioni</a>
                </div>
            </div> --}}
