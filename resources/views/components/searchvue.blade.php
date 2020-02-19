<script type="text/x-template" id="searchvue">
  <div class="searchvue">
    {{-- <h2 v-if="!showResults()">@{{ res_num }} Results found for: @{{ prev_search }} </h2> --}}
    <h3 style="display:inline">@{{ res_num }} Risultati trovati </h3><h3 style="display:inline" v-text="searchString"></h3>
    {{-- <input v-model="searchString" /> --}}
    <form>
      <label for="vue-search_field">Ricerca per indirizzo: </label>
      <input type="text" v-on:keyup="getAparts()" v-model="search_field" id="vue-search_field"/>
      <fieldset id="coords-disable">
        <label for="vue-lat">Ricerca per coordinate - lat: </label>
        <input type="text" v-on:keyup="getAparts()" v-model="lat" id="vue-lat" placeholder="latitude"/>
      
        {{-- <input type="text" v-model="lat" id="vue-lat"/> --}}
        <label for="vue-lon">Lon: </label>
        <input type="text" v-on:keyup="getAparts()" v-model="lon" id="vue-lon" placeholder="longitudine"/>
        {{-- <input type="text" v-model="lon" id="vue-lon"/> --}}
        <label for="vue-range">Range km: </label>
        <input type="text" v-on:keyup="getAparts()" v-model="range" id="vue-range" placeholder="raggio"/>
      </fieldset>
      <label for="vue-rooms">min Rooms: </label>
      <input type="text" v-on:keyup="getAparts()" v-model="rooms" id="vue-rooms"/>
      <label for="vue-beds">min Beds: </label>
      <input type="text" v-on:keyup="getAparts()" v-model="beds" id="vue-beds"/>
    </form>
    {{-- <button v-on:click="getAparts()">SEARCH</button> --}}

    <div class="d-flex flex-wrap justify-content-center">

      <div v-for='apartment in apartments' class="card flex-row w-25" style="margin:20px">
        <div class="wrapper">
            <div class="card-body w-100" style="">
            {{-- <img  class ="card-img-top w-100" :src="apartment.image"/> --}}
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
            {{-- <a class="btn btn-primary" :href="`http://localhost:8000/apartment/${apartment.id}`"> Più informazioni</a> --}}
            <a class="btn btn-primary" :href="showApart(apartment.id)"> Più informazioni</a>
        </div>
      </div>

        
      </div>
    </div>

    
  </div>
</script>

<script type="text/javascript">
  Vue.component('searchvue', {
    template: "#searchvue",
    data() {
      return {
        // search: '{{ $search_field }}',
        auth_user: '{{ Auth::user() ?  Auth::user()-> id : ''}}',
        prev_search: '',
        search_field: '',
        rooms: 1,
        beds: 1,
        lat: '',
        lon: '',
        range: 20,
        // search2: "`http://localhost:8000/${apartment.image}`",
        route_show: '',
        searchDone: {},
        searchString: '',
        apartments: [],
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
    mounted() {
      // this.search_field = '{{ $search_field }}'
    },
    created() {
      this.search_field = '{{ $search_field }}';
      // var postData = '?search_field=' + this.search_field;
      // this.search_field = '{{ $search_field }}';
      console.log('search field ', this.search_field);
      this.prev_search = '{{ $search_field }}';
      this.getAparts();
    },
    methods: {
      getAparts() {
        axios.post('http://localhost:8000/search', {
          search_field: this.search_field,
          rooms: this.rooms,
          beds: this.beds,
          lat: this.lat,
          lon: this.lon,
          range: this.range,
          })
          .then(res => {

              console.log('res', res);
              const data = res.data;
              if (data.success == true) {
                this.apartments = data.data;
                this.updateResults(data.searchFor);
              } else {
                console.log('success false');
                this.updateResults('');
              }
              // this.search_field = ''; //clear search field dopo ricerca solo lat lon
              this.res_num = this.apartments.length;
              console.log('res num', this.res_num);

          })
          .catch(err => {

            this.error = "Error downloading data albums";
            console.log('err', err)
          });
      },
      setImage(img) {
        return img.includes('images/user/') ? 
            window.location.protocol + "//" + window.location.host + "/"+img 
            : img; 
        // return img.includes('images/user/') ? `http://localhost:8000/${img}` : img; 
      },
      showApart(id) {
        // return this.auth_user ? "http://localhost:8000/user/apartment/" + id : "http://localhost:8000/apartment/" + id;
        return this.auth_user ? 
            window.location.protocol + "//" + window.location.host + "/" +"/user/apartment/" + id 
            : window.location.protocol + "//" + window.location.host + "/" +"/apartment/" + id;
      },
      showResults() {
        // if(this.lat && this.lon) {
        //   this.prev_search = 'lat ' + this.lat + ' - lon ' + this.lon + ' - range '+this.range;
        // }
      },
      updateResults(data) {
        console.log('update results', data);
        if(data) {
          this.searchString = (data.search_field) ? `per ${data.search_field}` 
            : `per lat: ${data.lat} - lon: ${data.lon} - range: ${data.range / 1000}km`;
        } else {
          this.searchString = '';
        }
        
      }
    }
  });

</script>