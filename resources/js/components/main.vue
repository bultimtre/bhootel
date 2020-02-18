<template>
    <div>
        <router-view></router-view>
        <bh-navbar></bh-navbar>
        <!-- <bh-index></bh-index>
        <bh-login></bh-login> -->
    </div>
</template>

<script>

import Navbar from './bh-navbar.vue'

export default {
    components:{
        'bh-navbar':Navbar,

    }
}
</script>
