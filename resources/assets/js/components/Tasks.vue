<template>
    <div>

        <h3>{{ project.name }}</h3>
        <ul class="list-unstyled" v-if="project && project.tasks && project.tasks.length">
            <transition-group name="list" :duration="3000">
            <li v-for="(task,key) in project.tasks" :key="key" @click.prevent="showTimeframes(key)">
                <div class="panel">
                    <div class="panel-body">
                        {{ task.name }}
                        <span class="label label-success pull-right">
                            {{ task.timeframes.length }}
                        </span>
                    </div>
                </div>
            </li>
            </transition-group>
        </ul>
        <div class="text-black-50" v-if="project && project.tasks && !project.tasks.length">
            The zombies are coming...
        </div>

    </div>
</template>

<script>
    import EventBus from '../app'
    export default{
        data(){
            return {
                project:{}
            }
        },
        methods:{
          showTimeframes(id){
              EventBus.$emit('task', this.project.tasks[id])
          }
        },
        mounted(){
            EventBus.$on('project',(payload)=>{
                this.project = payload
            })
        }
    }
</script>