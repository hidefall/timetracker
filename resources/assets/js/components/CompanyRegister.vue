<template>
    <form>
        <div class="form-group">
            <label for="firstname">Firstname</label>
            <input @keyup="cleanErrors" type="text" class="form-control" id="firstname" v-model="form.firstname">
            <span v-if="errors.firstname" class="text-danger">{{ errors.firstname[0] }}</span>
        </div>
        <div class="form-group">
            <label for="lastname">Lastname</label>
            <input @keyup="cleanErrors" type="text" class="form-control" id="lastname" v-model="form.lastname">
            <span v-if="errors.lastname" class="text-danger">{{ errors.lastname[0] }}</span>
        </div>
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
            <label for="password_confirmation">Password confirmation</label>
            <input @keyup="cleanErrors" type="password" class="form-control" id="password_confirmation" v-model="form.password_confirmation">
        </div>
        <h3>Company</h3>
        <div class="form-group">
            <label for="company_name">Company name</label>
            <input @keyup="cleanErrors" type="text" class="form-control" id="company_name" v-model="form.company_name">
            <span v-if="errors.company_name" class="text-danger">{{ errors.company_name[0] }}</span>
        </div>
        <div class="form-group">
            <label for="company_number">Company number</label>
            <input @keyup="cleanErrors" type="text" class="form-control" id="company_number" v-model="form.company_number">
            <span v-if="errors.company_number" class="text-danger">{{ errors.company_number[0] }}</span>
        </div>
        <div class="form-group">
            <button class="btn btn-success btn-lg" @click.prevent="submitForm">Register</button>
        </div>
    </form>
</template>

<script>
    import axios from 'axios'
    import swal from 'sweetalert2'
    export default {
        props:['info'],
        data(){
            return{
                form:{
                    firstname:"",
                    lastname:"",
                    email:"",
                    password:"",
                    password_confirmation:"",
                    company_name:"",
                    company_number:""
                },
                errors:{}
            }
        },
        methods:{
            submitForm(){
                axios.post('/registerCompany', this.form).then((response)=>{
                    if(response.data.company && response.data.company.id){
                        this.info.company = response.data
                        this.info.currentStep += 1
                    }else if(response.data == 0){
                        swal('Error','Something is wrong...','error')
                    }
                }).catch((errors)=>{
                    this.errors = errors.response.data.errors
                })
            },
            cleanErrors(){
                this.errors = {}
            }
        }
    }
</script>













