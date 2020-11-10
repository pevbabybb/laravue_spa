<template>
    <main>
        <Header style="display:none"/>
        <div id="layoutSidenav" >
          
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-10 pt-3">ADMIN </h1>
                        
 
                        </div>
                    <div class="card mb-3">
                       <div class="card-header">
                       <!-- <span> ?task management</span> -->
                       <button class="btn btn-primary btn-sm ml-auto" v-on:click="showNewTaskModal"><span> create new </span></button>
                       <button class="btn btn-primary btn-sm ml-auto" v-on:click="showSettingModal"><span> setting </span></button>
                       </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>name</td>
                                        <td style="text-align:center">image</td>
                                        <td>birth</td>
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
                                            21/09/98
                                        </td>
                                        <td>
                                           
                                            <button class="btn btn-danger btn-sm" v-on:click="deleteTask(task)">delete</button>
                                            <button class="btn btn-primary btn-sm" v-on:click="editTask(task)">update</button>
                                            <button class="btn btn-info btn-sm" v-on:click="addRelation(task)">Rel</button>
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

            <!-- setting modal -->
             <b-modal ref="SettingModal" hide-footer title="Setting">
                <div class="d-block ">
                    <form v-on:submit.prevent="updateSetting" >
                        <div class="form-group">
                           <div class="switch">
                                        <!-- setting test case -->
                                <div>
                                    <my-switch v-model="switchValue1"/> 
                                        <p style="display: inline-block" title="#">special day</p>
                                </div>
                                <div>
                                    <my-switch v-model="switchValue2"/> 
                                        <p style="display: inline-block" title="#">birht event</p>
                                </div>     
                                <div>
                                    <my-switch v-model="switchValue3"/> 
                                        <p style="display: inline-block" title="#">death day</p>
                                </div>      
                           
                            </div>
                             
                        <button type="button" class="btn btn-default" v-on:click="cancelSetingModal">Cancel</button>
                        <button type="submit" class="btn btn-primary" >save</button>       

                            
                            
                        </div>
                    </form>
                      
                        
               
                </div>
           
            
            </b-modal>
        


            <b-modal ref="editTaskModal" hide-footer title="Update task">
            <div class="d-block ">
              <form v-on:submit.prevent="updateTask"> 
                    <div class="form-group">
                      <div>
                                    <my-switch v-model="switchValue4"/> 
                                        <p style="display: inline-block" title="#">special day</p>
                                </div>
                                <div>
                                    <my-switch v-model="switchValue5"/> 
                                        <p style="display: inline-block" title="#">birht event</p>
                                </div>     
                               
                        
                       
                    </div>
                    
                    <hr>
                    <button type="button" class="btn btn-default" v-on:click="cancleEditTaskModal">Cancel</button>
                     <button type="submit" class="btn btn-primary" >save</button>
                    
                     
              </form>
            </div>
           
            
            </b-modal>

            <b-modal ref="relationModal" hide-footer title="add relation">
                <div class="d-block ">
                <form v-on:submit.prevent="createRelation"> 
                        <div class="form-group">
                          <div style="display: inline-block">
                                <input type="date" v-model="relationData.special_day">
                                <span>special day</span>
                          </div>
                         <table class="table">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>name</td>
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(task,index) in tasks" :key="index">
                                        <td>{{index+1}}</td>
                                        <td>{{task.name}}</td>
                                       
                                    </tr>
                                </tbody>
                            </table>

                        </div> 
                        <button type="button" class="btn btn-default" v-on:click="hideRelationModal">Cancel</button>
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
import * as settingService from './services/setting_service';
import * as relationService from './services/relation_service';

import Header from'./components/Header.vue';
import Sidebar from'./components/Sidebar.vue';
import Footer from'./components/Footer.vue';
import Test from './components/test.vue';
import MySwitch from './components/MySwitch.vue';




export default {
    components:{
        Header,
        Sidebar,
        Footer,
        Test,
        MySwitch,
    },
    name:'task',
    data() {
        return {
            tasks : [],
            taskData:{
                name:'',
                image:'',
                birthDay:'',
            },
            editTaskData:{},
            // property for setting default
            settings:[],
            settingData:{
                enable_specialDay:'',
                enable_birth_event:'',
                enable_death_event:'',
            },
            switchValue1:true, // data for setting default switch
            switchValue2:true, // data for setting default switch
            switchValue3:true, // data for setting default switch

            switchValue4:true,  //data for setting'user switch
            switchValue5:true,  //data for setting'user switch
            
            relations:[], // store the data from server
            relationData:{ 
                special_day:'',
                user1:'',
                user2:'',
            },
            addRelationData:{},
          
           
            errors:{},
            
            
        }
    },
    
    mounted(){
        this.loadTasks();
        this.loadSetting();
    },
    methods:{
        editTask(){
            this.editTaskData = task;
            this.showEditTaskModal();
        },
        loadTasks: async function(){
            try {
                const response = await taskService.loadTasks();
                console.log(response);
                this.tasks = response.data.data;
                console.log(this.tasks);
                
                
                this.flashMessage.success({
                    message:'chao mung den voi trung tam du lieu',
                    time:5000,
                });
            } catch (error) {
                this.flashMessage.error({
                            message: 'event error, refresh',
                            time:5000
                        });
                
            }
        },
        loadSetting:async function(){
            try {
                const response = await settingService.loadSetting();
                console.log(response);
                this.settings = response.data.data;
                if(this.settings[0].enable_specialDay== 0)
                {
                    this.switchValue1 = false;
                }else{
                    this.switchValue1 = true;
                }

                  if(this.settings[0].enable_birth_event== 0)
                {
                    this.switchValue2 = false;
                }else{
                    this.switchValue2 = true;
                }

                  if(this.settings[0].enable_death_event== 0)
                {
                    this.switchValue3 = false;
                }else{
                    this.switchValue3 = true;
                }
                
                console.log(this.settings);
            } catch (error) {
                this.flashMessage.error({
                    message:'event error',
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
        showNewRelationMoDal(){
            this.$refs.newRelationModal.show();
        },
        hideNewRelationModal(){
            this.$refs.newRelationModal.hide();
        },
        hideSettingModal(){
            this.$refs.SettingModal.hide();
        },
        showSettingModal(){
            this.$refs.SettingModal.show();
        },

        addRelation(task){
            this.addRelationData = task;
            this.$refs.relationModal.show();
        },

        hideRelationModal(){
            this.$refs.relationModal.show()
        },

        createRelation:async function(){
            let formData = new FormData();
            formData.append('user1', this.addRelationData.id);
            formData.append('user2',4);
            formData.append('special_day', this.relationData.special_day);

            const response = await relationService.createRelation(formData);
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
        },
        hideEditTaskModal(){
            this.$refs.editTaskModal.hide();
        },
        showEditTaskModal(){
            this.$refs.editTaskModal.show();
        },
       
        
        editTask(task){
            this.editTaskData = task;
           

             if(this.editTaskData.enable_birth_event == 0)
                {
                    this.switchValue4 = false;
                }else{
                    this.switchValue4 = true;
                }

                  if(this.editTaskData.enable_death_event == 0)
                {
                    this.switchValue5 = false;
                }else{
                    this.switchValue5 = true;
                }
            this.showEditTaskModal();
        },
        updateTask: async function(){
           
                const formData = new FormData();
                if(this.switchValue4 == true){
                    this.switchValue4 = 1;
                }else this.switchValue4 =0;

                if(this.switchValue5 == true){
                    this.switchValue5 = 1;
                }else this.switchValue5 =0;

                formData.append('enable_birth_event',this.switchValue4);
                formData.append('enable_death_event',this.switchValue5);
                formData.append('_method', 'put');
                const response = await taskService.updateTask(this.editTaskData.id,formData);
                this.$refs.editTaskModal.hide();
           
        },
                
        updateSetting: async function(){
              const formData = new FormData();
           
            if(this.switchValue1 == true){
                this.switchValue1 = 1;
            }else this.switchValue1 =0;

            if(this.switchValue2 == true){
                this.switchValue2 = 1;
            }else this.switchValue2 =0;

            if(this.switchValue3 == true){
                this.switchValue3 = 1;
            }else this.switchValue3 =0;
             
             

            formData.append('enable_specialDay',this.switchValue1);
            formData.append('enable_birth_event',this.switchValue2);
            formData.append('enable_death_event',this.switchValue3);
            formData.append('_method','put');
            this.flashMessage.success({
                    message: ' setting default updated !',
                    time: 5000

                });
            const response = await settingService.updateSetting(1,formData);
            this.$refs.SettingModal.hide();
            
             
        },
        cancelSetingModal(){
            this.$refs.SettingModal.hide();
            this.loadSetting();

        },
        cancleEditTaskModal(){
            this.$refs.editTaskModal.hide();
            this.loadTasks();
        },      
                
                
               
            
    }
    
    
}
</script>
<style >
    img {
  vertical-align: middle;
  border-style: none;
  max-width: 200px;
  max-height: 200px;
}
</style>