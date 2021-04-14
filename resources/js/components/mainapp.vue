<template>
    <div>
        <!-- Navigation -->
        <appHeader></appHeader>
        <!-- Navigation Ends -->
        <!-- Body -->
        <router-view></router-view>
        <!-- Body Ends -->
    </div>
</template>
<script>
import appHeader from './parts/header'
export default {
    components:{
        // Registered Application Header
        appHeader,
    }
}
</script>