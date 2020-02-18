<script type="text/x-template" id="searchvue">
  <div class="searchvue">
    <div>i work</div>
    <div>ricerca fatta: {{ $search_field }}</div>
    <input type="text" v-model="search"/>
    <input type="text" v-model="search_field"/>
    <div>search: @{{search}}</div>
    <div>search: @{{search2}}</div>
    <div class="d-flex flex-wrap justify-content-center">
      <div v-for='apartment in apartments' >
          <div class="card flex-row w-45" style="margin:20px">
            <div class="wrapper">
                <div class="card-body w-100" style="">
                <img  class ="card-img-top w-100" :src="`http://localhost:8000/${apartment.image}`"/>
                <p class="card-text">@{{ apartment.description}}</p>
                <p class="card-text">address: @{{ apartment.address}}</p>
                <p class="card-text">beds: @{{ apartment.beds}}</p>
                <p class="card-text">rooms: @{{ apartment.rooms}}</p>
                <p class="card-text">baths: @{{ apartment.baths}}</p>
                <p class="card-text">square_mt: @{{ apartment.square_mt}}</p>
                <div class="d-flex justify-content-end">
                    <span>@{{ apartment.id}}</span>
                </div>
                <a class="btn btn-primary" :href="`http://localhost:8000/apartment/${apartment.id}`"> Più informazioni</a>
            </div>
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
        search: '{{ $search_field }}',
        // search2: "`http://localhost:8000/${apartment.image}`",
        search2: "",
        route_show: '',
        // search_field: '{{ $search_field }}'
        search_field: 'prova',
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
    this.search_field = '{{ $search_field }}'
    axios.post('http://localhost:8000/search', {
          search_field: this.search_field
          })
          .then(res => {

              console.log('res', res);
              const data = res.data;
              if (data.success == true) {
                this.apartments = data.data;
              }

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
  });

</script>