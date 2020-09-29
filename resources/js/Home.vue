<template>
    <main>
        <Header/>
        <div id="layoutSidenav">
          
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-10 pt-3">Dashboard</h1>
                        
 
                        </div>
                    <div class="card mb-3">
                       <div class="card-header">
                       <span> task management</span>
                       <button class="btn btn-primary btn-sm ml-auto" v-on:click="showNewTaskModal"><span> create new </span></button>
                       </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>name</td>
                                        <td>action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(task,index) in tasks" :key="index">
                                        <td>{{index+1}}</td>
                                        <td>{{task.name}}</td>
                                        <td>
                                          <img :src="`${$store.state.serverPath}/storage/${task.image}`" :alt="task.name"
                                          class="table-image"/>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm">upload</button>
                                            <button class="btn btn-danger btn-sm" v-on:click="deleteTask(task)">delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            

                        </div>

                    </div>
                    
                </main>
             
            </div>
        </div>
     
                <b-modal ref="newTaskModal" hide-footer title="Add new task">
            <div class="d-block ">
              <form v-on:submit.prevent="createTask"> 
                    <div class="form-group">
                        <label for="name">enter name</label>
                        <input type="text"  v-model= "taskData.name" class="form-control" id="name" placeholder="dien zo" >
                        <div class="invalid-feedback" style="display:inline-block !important" v-if="errors.name">{{errors.name[0]}}</div>
                    </div>
                     <div class="form-group">
                        <label for="image">choose image</label>
            
                        <div v-if="taskData.image.name">
                            <img src="" ref="newTaskImageDisplay" class="w-150px">

                        </div>
                        <input type="file" v-on:change="attachImage" ref="newTaskImage" class="form-control " id="image" >
                        <div class="invalid-feedback" v-if="errors.image">{{errors.image[0]}}</div>
                    </div>
                    <hr>
                    <button type="button" class="btn btn-default" v-on:click="hideNewTaskModal">Cancel</button>
                     <button type="submit" class="btn btn-primary" >save</button>
                     
              </form>
            </div>
           
            
            </b-modal>
             <Footer/>
              <FlashMessage position="right bottom"></FlashMessage>
    </main>
  
</template>

<script>
import * as taskService from './services/task_service';
import Header from'./components/Header.vue';
import Sidebar from'./components/Sidebar.vue';
import Footer from'./components/Footer.vue';




export default {
    components:{
        Header,
        Sidebar,
        Footer,
    },
    name:'task',
    data() {
        return {
            tasks : [],
            taskData:{
                name:'',
                image:'',
            },
            errors:{},
        }
    },
    mounted(){
        this.loadTasks();
    },
    methods:{
        loadTasks: async function(){
            try {
                const response = await taskService.loadTasks();
                console.log(response);
                this.tasks = response.data.data;
                console.log(this.tasks);
            } catch (error) {
                this.flashMessage.error({
                            message: 'event error, refresh',
                            time:5000
                        });
                
            }
        },

        

        attachImage(){
            this.taskData.image = this.$refs.newTaskImage.files[0];
            let reader = new FileReader();
            reader.addEventListener('load',function(){
                this.$refs.newTaskImageDisplay.src = reader.result;
            }.bind(this),false);

            reader.readAsDataURL(this.taskData.image);

        },
        hideNewTaskModal(){
            this.$refs.newTaskModal.hide();

        },
        showNewTaskModal(){
            this.$refs.newTaskModal.show();

        },
       
        createTask: async function(){
            let formData =  new FormData();
            formData.append('name',this.taskData.name);
            formData.append('image',this.taskData.image);
            
            try{
                const response = await taskService.createTask(formData);
                this.tasks.unshift(response.data);
                this.hideNewTaskModal();
                this.flashMessage.success({
                    message: 'Success store image!',
                    time: 5000

                });
                this.taskData = {
                    name:'',
                    image:''
                };

            } catch(error){
                console.log(error.response.status);
                switch (error.response.status) {
                    case 422:
                        this.errors = error.response.data.errors;
                        
                        break;
                
                    default:
                        this.flashMessage.error({
                            message: 'event error',
                            time:5000
                        });
                }

            }
        },
        deleteTask: async function(task){
           
            if(!window.confirm(`delete ${task.name}`)){
                return;
            }
            try {
                await taskService.deleteTask(task.id);
                this.tasks = this.tasks.filter(obj =>{
                    return obj.id != task.id;
                });
            } catch (error) {
                
            }
        }


    }
    
    
}
</script>
