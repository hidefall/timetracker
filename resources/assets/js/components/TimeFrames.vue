<template>
    <div>

        <h3>{{ task.name }}</h3>
        <ul class="list-unstyled" v-if="task && task.timeframes && task.timeframes.length">
            <transition-group name="list" :duration="3000">
            <li v-for="(timeframe,key) in task.timeframes" :key="key">
                <div class="panel">
                    <div class="panel-body">
                        <div class="pull-right"><strong>{{ toTimeframe(timeframe.timer_finished - timeframe.timer_started) }}</strong></div>
                        <div class="clearfix"></div>
                        {{ timeframe.description }}
                    </div>
                </div>
            </li>
            </transition-group>
        </ul>
        <div class="text-black-50" v-if="task && task.timeframes && !task.timeframes.length">
            The zombies are coming...
        </div>

    </div>
</template>

<script>
    import EventBus from '../app'
    export default{
        data(){
            return {
                task:{}
            }
        },
        methods:{
            toTimeframe(seconds){
                var date = new Date(null);
                date.setSeconds(seconds);
                return date.toISOString().substr(11, 8);
            }
        },
        mounted(){
            EventBus.$on('task',(payload)=>{
                this.task = payload
            })
        }
    }
</script>