<template>
    <a @click.prevent="toggleSidebar" href="#" class="btn btn-success btn-lg">
        <i class="fa fa-plus-square-o"></i>
    </a>
</template>

<script>
    export default {
        methods:{
            toggleSidebar(){
                $('.wrapper').toggleClass('active-sidebar')
            }
        }
    }
</script>

<style scoped>

</style>