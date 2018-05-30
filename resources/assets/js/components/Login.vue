<template>
    <form>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input @keyup="cleanErrors" type="text" class="form-control" id="email" v-model="form.email">
            <span v-if="errors.email" class="text-danger">{{ errors.email[0] }}</span>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input @keyup="cleanErrors" type="password" class="form-control" id="password" v-model="form.password">
            <span v-if="errors.password" class="text-danger">{{ errors.password[0] }}</span>
        </div>
        <div class="form-group">
            <button class="btn btn-success btn-lg" @click.prevent="submitForm">Log in</button>
        </div>
    </form>
</template>

<script>
    import swal from 'sweetalert2'
    import axios from 'axios'
    export default {
        data(){
            return {
                form:{
                    email:"",
                    password:""
                },
                errors:{}
            }
        },
        methods:{
            submitForm(){
                axios.post('/login', this.form).then((response)=>{
                    if(response.data.id){
                        swal('Success','YAY!','success').then(()=>{
                            window.location.href="/dashboard"
                        })
                    }else if(response.data == 0){
                        swal('Error','Something is wrong...','error')
                    }
                }).catch((errors)=>{
                    this.errors = errors.response.data.errors
                    console.log(errors.response.data)
                })
            },
            cleanErrors(){
                this.errors = {}
            }
        }
    }
</script>











