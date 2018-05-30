<template>
    <span class="text-center">
        <h2>Registration finished</h2>
        <a href="#" class="btn btn-success btn-lg" @click.prevent="to_site">Take me to the site!</a>
    </span>
</template>

<script>
    export default {
        props:['info'],
        methods:{
            to_site(){
                window.location.href = "/dashboard"
            }
        }
    }
</script>