<script type="text/x-template" id="searchvue">
  <div class="searchvue container">
    <h3 style="display:inline">@{{ res_num }} </h3><h3 style="display:inline" v-text="searchString"></h3>
    <form role="form">
      <div class="form-group">
        <label for="vue-search_field">Cerca appartamento: </label>
        <input type="text" class="form-control inputsrc" v-on:keyup="evData()" v-model="search_field" id="vue-search_field"/>
      </div>

      <fieldset id="coords-disable">
        <h5>Ricerca alternativa per coordinate</h5>
        <div class="row">
          <div class="col-sm-4">
            <label for="vue-lat">latitudine: </label>
            <input type="text" class="form-control" v-on:keyup="evData()" v-model="lat" id="vue-lat" placeholder="latitude"/>
          </div>
          <div class="col-sm-4">
            <label for="vue-lon">longitudine: </label>
            <input type="text" class="form-control" v-on:keyup="evData()" v-model="lon" id="vue-lon" placeholder="longitudine"/>
          </div>
          <div class="col-sm-4">
            <label for="vue-range">distanza (km): </label>
            <input type="text" class="form-control" v-on:keyup="evData()" v-model="range" id="vue-range" placeholder="raggio"/>
          </div>
        </div>
      </fieldset>

      <div class="row">
        <div class="col-sm-6">
          <label for="vue-rooms">stanze minime: </label>
          <input type="text" class="form-control" v-on:keyup="evData()" v-model="rooms" id="vue-rooms"/>
        </div>
        <div class="col-sm-6">
          <label for="vue-beds">numero minimo letti: </label>
          <input type="text" class="form-control" v-on:keyup="evData()" v-model="beds" id="vue-beds"/>
        </div>
      </div>

      <div class="form-group">
        <div v-for='config in configs' class="form-check form-check-inline">
          <input type="checkbox" :value='config.id' v-model="checkedConfigs" class="form-check-input config-checkbox" @change="evData()">
          <label for="config-checkbox" >@{{ config.service}}</label>
        </div>
      </div>

      
    </form>

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
        auth_user: '{{ Auth::user() ?  Auth::user()-> id : ''}}',
        baseUrl: window.location.protocol + "//" + window.location.host + "/",
        search_field: '',
        rooms: 1,
        beds: 1,
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
      // this.search_field = '{{ $search_field }}';
      this.search_field = $('#data_search_field').attr('data-search');
      this.getAparts();
      this.getAllConfigs();
    },
    methods: {
      getAllConfigs() {
        axios.get(this.baseUrl+'search/configs').then(resp => {
                console.log('configs ', resp);
                if(resp.status == 200) {
                  this.configs = resp.data;
                }
            })
            .catch(err => {
              this.error = "Error downloading configs";
              console.log('err', err)
              });
      },
      evData() { // da controllare, alt sost tutti eventi v-on e @change con getAparts()
        if((this.search_field.length >=1) || 
            ((this.lat >=-90 && this.lat <=90) && (this.lon >=-180 && this.lon <=180) && (this.range > 0))
          ) {
          this.getAparts();
        } else {
          this.res_num = 'Inserire i parametri corretti';
          this.apartments = [];
          this.searchString = '';
        }

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
                this.updateResults(data.searchFor);
              } else {
                console.log('success false');
                this.updateResults('');
              }
              if(this.apartments.length == 1) {
                this.res_num = '1 Risultato trovato';
              } else if (this.apartments.length > 0){
                this.res_num = this.apartments.length + ' Risultati trovati';
                
              }  else {
                this.res_num = 'Nessun Risultato trovato';
              }
              console.log('ajax res num', this.res_num);

          })
          .catch(err => {

            this.error = "Error downloading data albums";
            console.log('err', err)
          });
      },
      setImage(img) {
        return img.includes('images/user/') ? 
            this.baseUrl + img 
            : img; 
        // return img.includes('images/user/') ? `http://localhost:8000/${img}` : img; 
      },
      showApart(id) {
        // return this.auth_user ? "http://localhost:8000/user/apartment/" + id : "http://localhost:8000/apartment/" + id;
        return this.auth_user ? 
            this.baseUrl +"/user/apartment/" + id 
            : this.baseUrl +"/apartment/" + id;
      },
      updateResults(data) {
        console.log('update results', data);
        if(data) {
          this.searchString = (data.search_field) ? `per: ${data.search_field}` 
            : `per: lat: ${data.lat} - lon: ${data.lon} - range: ${data.range / 1000}km`;
        } else {
          this.searchString = '';
        }
        
      }
    }
  });

</script>