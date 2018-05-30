<template>
    <div>
        <span>
            <h2>Add Project</h2>
            <form action="#" method="post">
                <div class="form-group">
                    <label for="name" class="control-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" v-model="form.name" />
                </div>
                  <div class="form-group">
                    <label for="client" class="control-label">Client</label>
                    <select name="client" id="client" class="form-control" v-model="form.client">
                        <option value="" selected disabled>Select client</option>
                        <option :value="id" v-for="(name, id) in this.clients">{{ name }}</option>
                    </select>
                </div>
                  <div class="form-group">
                    <label for="estimation" class="control-label">Estimation</label>
                    <input type="text" class="form-control" name="estimation" id="estimation" v-model="form.estimation"/>
                </div>
                 <div class="form-group text-center">
                   <button @click.prevent="submitForm" type="submit" class="btn btn-success btn-lg">Submit</button>
                </div>
            </form>
        </span>
    </div>
</template>

<script>
import axios from 'axios'
import swal from 'sweetalert2'
export default {
  data(){
      return {
          form:{
              name:"",
              client:"",
              estimation:""
          },
          clients:{}
      }
  },
  methods:{
      getClientsList(){
          axios.get('/napi/clientslist').then((response)=>{
              this.clients = response.data
          }).catch((errors)=>{
              console.log(errors.response.data)
          })
      },
      submitForm(){
          axios.post('/napi/saveProject', this.form).then((response)=>{
              if(response.data.id){
              swal('success','Prohect saved','success').then(()=>{
                  $('.wrapper').toggleClass('active-sidebar')
              })
            }else {
                swal('Error','We are totally Fucked...','error')
            }
          }).catch((errors)=>{
              console.log(errors.response.data)
          })
      }
  },
  mounted(){
      this.getClientsList()
  }
}
</script>
