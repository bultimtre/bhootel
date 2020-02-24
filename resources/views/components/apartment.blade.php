<script type="text/x-template" id="apartment">
    <div class="card flex-row">
        <div class="card__img-wrap d-lg-flex">
            <div class="card__img-div d-lg-flex m-0 p-0">
                <img class ="card__img-photo card-img-top image-fluid" :src='setImage(apartment.image)'/>
            </div>
        </div>
        <div class="card__body-wrap d-flex flex-grow-1 py-3 pl-3 pr-0" style="background-color:#f2f2f2">
            <div class="card__body-text d-lg-flex flex-column pr-2">
                <p class="card__body-title card-text  text-uppercase font-weight-bold m-0 mb-2" >@{{textTrim(25, "QUESTO E' IL TITOLO DELL'APPARTAMENTO")}}</p>
                <p class="card__body-desc card-text m-0 flex-grow-1">@{{textTrim(50, apartment.description)}}</p>
                <ul class="card__body-configs list-group  list-group-horizontal justify-content-start" v-for="aptConfig in aptConfigs">
                    <li v-if="apartment.id == aptConfig.apt_id"></li>


                    {{-- <li class="list-group-item py-0 pl-0 pr-2"><i class="fas fa-wifi"></i></li>
                    <li class="list-group-item py-0 pr-2"><i class="fas fa-parking"></i></li>
                    <li class="list-group-item py-0 pr-2"><i class="fas fa-swimming-pool"></i></li>
                    <li class="list-group-item py-0 pr-2"><i class="fas fa-concierge-bell"></i></li>
                    <li class="list-group-item py-0 pr-2"><i class="fas fa-hot-tub"></i></li>
                    <li class="list-group-item py-0 pr-2"><i class="fas fa-eye"></i></li> --}}
                </ul>
                <ul>
                    <li v-for="aptConfig in aptConfigs">@{{ aptConfig}}</li>
                </ul>
            </div>
            <div class="card__body-info d-flex flex-column flex-grow-1 justify-content-between align-items-center border-left">
                <div class='likeHeart'>
                    <i class="fa-heart fa-2x" :class="state" @click='classToggle()'></i>
                </div>


                <div class="d-flex flex-column align-items-center justify-content-center">
                    <p class="card-text m-0">72.00€</p>
                    <p class="card-text m-0">/notte</p>
                </div>
                <a class="btn btn-primary button-show" :href="showApart(apartment.id)"> Più informazioni</a>
            </div>
        </div>
    </div>
</script>

<script type="text/javascript">
    Vue.component('single-apartment', {
    template: "#apartment",
    data() {
        return {

            title_trim:'', //solo per testarlo va creato nella tabella;
            state:'far',
            baseUrl: window.location.protocol + "//" + window.location.host + "/",
            aptConfigs:[],
        }
    },
    created(){
        // this.getAptConfigs()
        this.getApartConfigs();
        this.catchType();
    },
    props:{
        apartment:Object
    },
    methods:{
        // getAptConfigs() {
        //     axios.get(this.baseUrl+'search/aptConfigs').then(resp => {

        //         if(resp.status == 200) {
        //             testdata = resp.data;
        //             this.aptConfigs = resp.data;
        //             console.log('test', this.aptConfigs[0])
        //             /* for (let i = 0; i < testData.length; i++) {
        //                 return console.log('tipo', testData[i])

        //             } */
        //             /* for(aptConfig in this.aptConfigs){
        //                 aptConfig.forEach(el => {
        //                     console.log(aptConfig.apt_id)
        //                 });
        //             } */
        //         }
        //     })
        //     .catch(err => {
        //         this.error = "Error downloading configs";
        //         //console.log('err', err)
        //     });
        // },
        getApartConfigs() {
            axios.get(this.baseUrl+'search/apartConfigs/'+this.apartment.id)
            .then(res => {

                console.log('res APART CONFIGS', res);
                var data = res.data;
                for(var i=0; i<data.length;i++) {
                    this.aptConfigs.push(data[i].service);
                }
                // this.aptConfigs = res.data;
                console.log('aptconfigs', this.aptConfigs);
            })
            .catch(err => {
                this.error = "Error downloading configs";
                //console.log('err', err)
            });
        },
        setImage(img) {
            return img.includes('images/user/') ? this.baseUrl + img : img;
        },
        showApart(id) {
            return this.auth_user ?
            this.baseUrl +"/user/apartment/" + id
            : this.baseUrl +"/apartment/" + id;
        },
        textTrim(num, text){
            return text.length>num ? text.substring(0,num)+'...' : text
        },
        classToggle(){
            console.log(this.state)
            this.state = this.state === 'far' ? 'fas':'far'
        },
        catchType(){
            let classFa;
            let setApts = [];
            console.log(this.aptConfigs)

            //this.apartment.id


            /* return{
                aptsWithConfig:setApts,
                log: console.log(this.test)
            } */
            /* switch(type) {
                case 'wifi':
                    classFa = 'fas fa-wifi'
                    console.log(classFa)
                    break;
                case 'parking':
                    classFa = 'fas fa-parking'
                    console.log(classFa)
                    break;
                case 'pool':
                    classFa = 'fas fa-swimming-pool'
                    console.log(classFa)
                    break;
                case 'reception':
                    classFa = 'fas fa-concierge-bell'
                    console.log(classFa)
                    break;
                case 'sauna':
                    classFa = 'fas fa-hot-tub'
                    console.log(classFa)
                    break;
                case 'sight':
                    classFa = 'fas fa-eye'
                    console.log(classFa)
                    break;
                default:
                    break;
            }
            return {

                faClass: classFa
            };  */
        }
    }
});
</script>
