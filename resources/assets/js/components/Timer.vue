<template>
    <span>
        <span class="timer">
            <ul class="list-unstyled list-inline">
                <li>
                    <i class="align-middle fa fa-chevron-circle-down" style="font-size:20px;"></i>
                </li>
                <li><span v-text="timeToISO(seconds_from_start)">00:00</span></li>
                <li>
                    <i @click.prevent="toggleTimer" v-if="!timerStarted" class="fa fa-play-circle-o click"></i>
                    <i @click.prevent="toggleTimer" v-else class="fa fa-pause-circle-o click"></i>
                </li>
            </ul>
        </span>
        <div class="infoWindow">
            <form>
                <div class="form-group">
                    <select class="form-control" v-model="form.project" @change="getTasks">
                        <option selected disabled value="">Select project...</option>
                        <option v-for="project in this.projects" :value="project.id">{{ project.name }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" id="tasks" v-model="form.task" @change="disableButton">
                        <option v-for="task in this.tasks" :value="task.id">{{ task.name }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea v-model="form.description" class="form-control" placeholder="Input task description..."></textarea>
                </div>
                <div class="form-group click" @click.prevent="toggleBillable">
                    <i :class="'fa '+ (form.billable ? 'text-success':'') +' fa-dollar'"></i> Billable
                </div>
                <div class="form-group" v-if="form.billable">
                    <label class="control-label" for="price_per_hour">Price per hour</label>
                    <input type="number" min="0" class="form-control" id="price_per_hour" v-model="form.price_per_hour" />
                </div>
                <div class="form-group text-right">
                    <button @click.prevent="updateTimer" type="button" class="btn btn-success btn-lg">Save</button>
                </div>
            </form>
        </div>
    </span>
</template>

<script>
    import axios from 'axios'
    import EventBus from '../app'
    export default {
        props:['projects','current_timer'],
        data(){
            return {
                timeframe:{},
                timerStarted: false,
                showWindow: false,
                seconds_from_start:0,
                tt: null,
                tasks:{},
                form:{
                    project:"",
                    task:"",
                    description:null,
                    billable:null,
                    price_per_hour:0
                },
                buttonState:false
            }
        },
        methods:{
            disableButton(){
                if(this.form.project != "" && this.form.task == ""){
                    this.buttonState = false
                }else{
                    this.buttonState = true
                }
            },
            toggleInfoWindow(){
              this.showWindow = !this.showWindow
              if(this.showWindow){
                  $('.infoWindow').show()
              }else{
                  $('.infoWindow').hide()
              }
            },
            toggleBillable(){
                this.form.billable = !this.form.billable
            },
            toggleTimer(){
                this.timerStarted = !this.timerStarted
                this.toggleInfoWindow()
                if(!this.timerStarted){
                    this.stopTimer()
                }else{
                    this.startTimer()
                }
            },
            startTimer(){
                axios.post('/napi/startTimer').then((response)=>{
                    if(response.data.id){
                        this.timeframe = response.data
                        this.tickTack()
                    }
                }).catch((errors)=>{
                    console.log(errors.response.data)
                })
            },
            tickTack(){
                this.tt = setInterval(() => {
                    this.seconds_from_start += 1
                }, 1000)
            },
            updateTimer(){
                axios.put('/napi/updateTimer',{"timeframe":this.timeframe,"form":this.form}).then((response)=>{
                    if(response.data.id){
                        this.toggleInfoWindow()
                    }
                }).catch((errors)=>{
                    console.log(errors)
                })
            },
            stopTimer(){
                clearInterval(this.tt)
                axios.put('/napi/stopTimer/'+this.timeframe.id).then((response)=>{
                    if(response.data.timer_finished) {
                        this.timeframe = response.data
                        this.resetTimer()
                    }
                }).catch((errors)=>{
                    console.log(errors.response.data)
                    this.toggleTimer()
                })

            },
            resetTimer(){
                this.seconds_from_start = 0;
            },
            timeToISO(seconds){
                let date = new Date(null);
                date.setSeconds(seconds);
                return date.toISOString().substr(11, 8);
            },
            positionInfoWindow(){
                let currentWidth = $('.infoWindow').width()
                if(window.innerWidth > currentWidth * 4){
                    $('.infoWindow').css('width',currentWidth * 4)
                    let rightSideOfInfoWindow =  -3 * currentWidth + 40
                    $('.infoWindow').css('left', rightSideOfInfoWindow)
                }else{
                    $('.infoWindow').css({width:'100%',left:'0',right:'0',position:"fixed"})
                }
            },
            getTasks(){
                axios.get('/napi/listTasks/'+this.form.project).then((response)=>{
                    this.tasks = response.data
                    if(Object.keys(this.tasks).length && this.tasks[0] && this.tasks[0].id){
                        this.form.task = this.tasks[0].id
                    }
                }).catch((errors)=>{
                    console.log(errors.response.data)
                })
            }
        },
        mounted(){
            if(Object.keys(this.current_timer).length){
                this.timeframe = this.current_timer
                this.timerStarted = true
                let now = Math.floor(new Date().getTime() / 1000)
                this.seconds_from_start = parseInt(now) - parseInt(this.timeframe.timer_started)
                this.tickTack()
            }
            EventBus.$on('project-timer-start', (payload)=>{
                this.startTimer()
                this.timerStarted = true
                this.form.project = payload.id
                this.getTasks()
                this.toggleInfoWindow()
                EventBus.$emit('tzikalo', {"project":this.form.project});
            })
            EventBus.$on('project-timer-stop', (payload)=>{
                this.stopTimer()
                this.timerStarted = false
                this.form = {}
                EventBus.$emit('tzikalo', {"project":null});
            })
            $('#tasks').attr('disabled', true)
            this.disableButton()
            this.positionInfoWindow()
            $('.infoWindow').hide()
        },
        watch:{
            tasks(){
                if(Object.keys(this.tasks).length){
                    $('#tasks').attr('disabled', false)
                }else{
                    $('#tasks').attr('disabled', true)
                }
            }
        }
    }
</script>

<style scoped>
    .timer{
        background: #FF0000;
        color:#FFF;
        font-size:34px;
    }
    .click{
        cursor:pointer;
    }
    .click:hover{
        color: rgba(255,255,255,0.8) !important;
    }
    .infoWindow{
        position:absolute;
        z-index:-10;
        background: #FFFFFF;
        border-radius: 0px 0px 10px 10px;
        box-shadow: 0px 0px 20px #CECECE;
        padding:20px;
    }
</style>