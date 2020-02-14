<template>
    <div class="text-center dark" style="border:1px solid red; color:white" >
        <p v-for="apartment in apartments" :key=index>{{apartments}}</p>
        <li v-for="color in colors" :key='color'>{{color}}</li>

    </div>
</template>

<script>

    export default {
        props:{
            apts:Array,
        },
        data(){
            return{
                colors:['red','green','blue'],
                apartments:[],
            }

        }
    }

</script>
