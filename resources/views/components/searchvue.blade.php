<script type="text/x-template" id="searchvue">
  <div class="searchvue">
    <div>i work</div>
    <div>ricerca fatta: {{ $search_field }}</div>
    <input type="text" v-model="search"/>
    <input type="text" v-model="search_field"/>
    <div>search: @{{search}}</div>
    <div>search: @{{search2}}</div>
    <div v-for='apartment in apartments'>
      @{{ apartment.description}}
    </div>
  </div>
</script>

<script type="text/javascript">
  Vue.component('searchvue', {
    template: "#searchvue",
    data() {
      return {
        search: '',
        search2: '',
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