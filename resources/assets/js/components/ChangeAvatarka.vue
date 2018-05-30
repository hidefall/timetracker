<template>
  <div>
      <div @click.prevent="choosePhoto" class="avatarka" style="margin: 0 auto;">
          <img :src="this.avt ? this.avt : 'http://placehold.it/300x300?text=Avatarka'" alt="" class="img-responsive">
      </div>
        <input @change="photoHasBeenChosen" id="image" type="file" name="image" class="hidden" />
  </div>
</template>


<script>
import axios from 'axios'
export default {
  props:['profile'],
  data(){
      return{
        avt: null
      }
  },
  methods:{
      choosePhoto(){
          document.getElementById('image').click()
      },
      photoHasBeenChosen(){
                var file    = document.querySelector('input[type=file]').files[0];
                var reader  = new FileReader();

                reader.onloadend = ()=>{
                    let image = reader.result
                    axios.post('/user/savephoto',{'file':image}).then((response)=>{
                        if(Object.keys(response.image).length){
                            this.avt = response.data.image.profile.url
                        }
                    })
                }
                if (file) {
                    reader.readAsDataURL(file);
                }
          }
      },
  mounted(){
      if(this.profile && this.profile.image && this.profile.image.profile && this.profile.image.profile.url) {
          this.avt = this.profile.image.profile.url
      }
  }
}
</script>

<style scoped>
    .avatarka {
        cursor: pointer;
        border-radius: 50%;
        overflow: hidden;
        width: 120px;
        height: 120px;
    }
</style>
