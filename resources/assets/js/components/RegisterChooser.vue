<template>
    <span>
        <button @click.prevent="change" type="button" class="btn btn-success btn-block">{{ company ? "User" : "Company" }}</button>
        <register-company v-if="company"></register-company>
        <register v-if="!company"></register>
    </span>
</template>

<script>
    export default {
        data(){
            return {
                company: false
            }
        },
        methods:{
            change(){
                this.company = !this.company
            }
        }
    }
</script>