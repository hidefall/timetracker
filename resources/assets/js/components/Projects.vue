<template>
    <div>
        <div v-if="isLoading" class="text-center">
            <i class="fa fa-spinner fa-pulse fa-4x"></i>
        </div>
        <table v-if="!isLoading" class="table table-bordered">
            <tbody>
                <tr v-for="(project, key) in projects.data" :key="key">
                    <td>
                        <i v-if="!tickingProject" class="fa fa-play-circle-o click" @click.prevent="startTimer(key)"></i>
                        <i v-if="tickingProject && tickingProject == project.id" class="fa fa-pause-circle-o click" @click.prevent="stopTimer(key)"></i>
                        <i v-if="tickingProject && tickingProject != project.id" class="fa text-muted fa-circle-o"></i>
                        &nbsp;&nbsp;
                        <a href="#" @click.prevent="showProject(key)">
                            {{ project.name }}
                            <span :class="'label label-' + (project.tasks.length ? 'success' : 'danger') + ' pull-right'">
                                {{ project.tasks.length }}
                            </span>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="text-center" v-if="projects.last_page != 1">
            <ul class="pagination">
                <li v-if="projects.current_page != 1">
                    <a @click.prevent="getProjects(parseInt(projects.current_page) - 1)" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li v-for="page in projects.last_page">
                    <a v-if="projects.current_page != page" href="#" @click.prevent="getProjects(page)">{{ page }}</a>
                    <span v-if="projects.current_page == page">{{ page }}</span>
                </li>
                <li v-if="projects.current_page != projects.last_page">
                    <a @click.prevent="getProjects(parseInt(projects.current_page) + 1)" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import EventBus from '../app'
    export default{
        props:['current_project'],
        data(){
            return {
                isLoading: true,
                projects: {},
                tickingProject:null
            }
        },
        methods:{
            getProjects(page = null){
                let url = ""
                if(page == null){
                    url = '/napi/listProjects';
                }else{
                    url = '/napi/listProjects?page='+page;
                }
                axios.get(url).then((response)=>{
                    this.projects = response.data
                    this.isLoading = false
                }).catch((errors)=>{
                    console.log(errors.response.data)
                })
            },
            showProject(id){
                EventBus.$emit('project', this.projects.data[id])
            },
            startTimer(id){
                EventBus.$emit('project-timer-start',this.projects.data[id])
            },
            stopTimer(id){
                EventBus.$emit('project-timer-stop',this.projects.data[id])
            }
        },
        mounted(){
            this.getProjects()
            if(
                Object.keys(this.current_project).length &&
                this.current_project.task_id &&
                Object.keys(this.current_project.task).length &&
                this.current_project.task &&
                Object.keys(this.current_project.task.project).length &&
                this.current_project.task.project.id
                ){
                this.tickingProject = this.current_project.task.project.id
            }
            EventBus.$on('tzikalo', (payload)=>{
                if(payload.project){
                    this.tickingProject = payload.project
                }else{
                    this.tickingProject = null
                }
            })
        }
    }
</script>

<style scoped>
    .click{
        cursor:pointer;
    }
</style>