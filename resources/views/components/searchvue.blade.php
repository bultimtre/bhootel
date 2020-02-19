<script type="text/x-template" id="searchvue">
  <div class="searchvue">
    <h2>Results for: @{{ prev_search }}</h2>
    {{-- <label for="vue-search_field">Address: </label>
    <input type="text" v-on:keyup="getAparts()" v-model="search_field" id="vue-search_field"/> --}}
    <label for="vue-lat">Lat: </label>
    <input type="text" v-on:keyup="getAparts()" v-model="lat" id="vue-lat"/>
    {{-- <input type="text" v-model="lat" id="vue-lat"/> --}}
    <label for="vue-lon">Lon: </label>
    <input type="text" v-on:keyup="getAparts()" v-model="lon" id="vue-lon"/>
    {{-- <input type="text" v-model="lon" id="vue-lon"/> --}}
    <label for="vue-range">Range km: </label>
    <input type="text" v-on:keyup="getAparts()" v-model="range" id="vue-range"/>
    <label for="vue-rooms">min Rooms: </label>
    <input type="text" v-on:keyup="getAparts()" v-model="rooms" id="vue-rooms"/>
    <label for="vue-beds">min Beds: </label>
    <input type="text" v-on:keyup="getAparts()" v-model="beds" id="vue-beds"/>
    
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
            <p class="card-text">baths: @{{ apartment.baths}}</p>
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
        apart_link: '',
        rooms: 1,
        beds: 1,
        lat: '',
        lon: '',
        range: 20,
        // search2: "`http://localhost:8000/${apartment.image}`",
        route_show: '',
        searchData: {

        },
        apartments: []
      };
    },
    // mounted() {
    //   this.search_field = '{{ $search_field }}'
    // },
    created() {
      // var postData = '?search_field=' + this.search_field;
      this.search_field = '{{ $search_field }}';
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
              } else {
                console.log('success false');
              }
              this.search_field = ''; //clear search field dopo ricerca solo lat lon
              // const data = res.data;

              // if (data.success !== true) {

              //   console.log('error downloading albums');

              //   this.error = "Data success is not true";

              //   return;
              // }

              // this.apartments = data.response;
              // console.log("apartments", apartments);
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
      }
    }
  });

</script>