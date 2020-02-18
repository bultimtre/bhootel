<template>
    <main>
    <div class="d-flex flex-wrap justify-content-center" style="">

            <div v-for="(apt,index) in apts" :key="index" class="card flex-row w-25" style="margin:20px">
                <div class="wrapper">
                    <img  class ="card-img-top w-100" src=''/>
                    <div class="card-body w-100" style="">
                    <p class="card-text"  style="height:80px; overflow-y:hidden">{{apt.description}}</p>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary" href=""> Più informazioni</a>
                    </div>
                    </div>
                </div>
            </div>
        <!-- @endforeach -->
    </div>

    <div class="w-100 d-flex justify-content-center py-5">
        <div>

        </div>
    </div>

    </main>

    <!--  <main>

    <div class="d-flex flex-wrap justify-content-center" style="">
        @foreach ($apartments as $apartment)
            <div class="card flex-row w-25" style="margin:20px">
                <div class="wrapper">
                    <img  class ="card-img-top w-100" src='{{asset ($apartment -> image) }}'/>
                    <div class="card-body w-100" style="">
                    <p class="card-text"  style="height:80px; overflow-y:hidden">{{$apartment -> description}}</p>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary" href="{{route (Auth::user() ? 'user-apt.show' :'guest-apt.show', $apartment -> id )}}"> Più informazioni</a>
                    </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="w-100 d-flex justify-content-center py-5">
        <div>
            {{$apartments->links()}}
        </div>
    </div>

    </main> -->
</template>

<script>
//import Navbar from './bh-navbar.vue'
    export default {
        data:function(){
            return {
                apts:[]
            }
        },
        created: function(){
            axios.get('/test')
                .then(response =>{
                    console.log(response.data)
                this.apts = response.data
            })
        }
    }
</script>
