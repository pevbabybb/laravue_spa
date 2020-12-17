<template>
    <main>
        <Header style="display:none"/>
        <div id="layoutSidenav" >
          
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-10 pt-3" style ="color: #212529">UIT </h1>
                        
 
                        </div>
                    <div class="card mb-3">
                       <div class="card-header">
                       <!-- <span> ?task management</span> -->
                       <button class="btn btn-primary btn-sm ml-auto" v-on:click="showNewTaskModal" title="Create"><i class="fas fa-plus-circle fa-2x"></i> </button>
                       <button class="btn btn-primary btn-sm ml-auto" v-on:click="showSettingModal" title="Setting"><i class="fas fa-cog fa-2x"></i></button>
                       <button class="btn btn-primary btn-sm ml-auto" v-on:click="showRelationDataModal" title="Relation Setting"><i class="fas fa-users-cog fa-2x"></i></button>
                       </div>
                       <div class="limiter">
                       <div class="container-table100">
                       <div class="wrap-table100">
                        <div div class="table100">
                            <table>
                                <thead>
                                    <tr>
                                        <th ><b>No.</b></th>
                                        <th><b>Name</b></th>
                                        <th  style="text-align:center"><b>Image</b></th>
                                        <th><b>Birthday/Deathday</b></th>
                                        <th ><b>Options</b></th>
                                        
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
                                           <span> {{task.date_of_birth}} </span>
                                           <hr>
                                           <span>{{task.date_of_death}}</span>
                                           
                                        </td>
                                        <td>
                                           
                                            <button class="btn btn-danger btn-sm" v-on:click="deleteTask(task)" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                            <button class="btn btn-primary btn-sm" v-on:click="editTask(task)" title="Update"><i class="fas fa-cog"></i></i></button>
                                            <button class="btn btn-info btn-sm" v-on:click="addRelation(task)" title="Relation Setting"><i class="fas fa-users-cog"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            

                        </div>
                       </div>
                       </div>
                       </div>
                    </div>
                    
                </main>
             
            </div>
        </div>
              
             <b-modal ref="newTaskModal" hide-footer title="Create new">
            <div class="d-block ">
              <form v-on:submit.prevent="createTask"> 
                    <div class="form-group">
                          
                        <label for="name">Enter name</label>
                        <input type="text"  v-model= "taskData.name" class="form-control" id="name" placeholder="Type here..." >
                        <div class="invalid-feedback" style="display:inline-block !important" v-if="errors.name">{{errors.name[0]}}</div>
                        <div>
                            <span>Birth day</span>
                            <input    type="date" v-model=" taskData.birthDay" >
                        <div class="invalid-feedback" style="display:inline-block !important" v-if="errors.date_of_birth">{{errors.date_of_birth[0]}}</div>
                        </div>
                        <br>
                        <span >Death day</span>
                        <input  type="date" v-model=" taskData.deathDay" >
                        <div class="invalid-feedback" style="display:inline-block !important" v-if="errors.date_of_death">{{errors.date_of_death[0]}}</div>
                    </div>
                    
                     <div class="form-group">
                        <label for="image">Choose image</label>
            
                        <div v-if="taskData.image.name">
                            <img src="" ref="newTaskImageDisplay" class="w-150px">

                        </div>
                        <input type="file" v-on:change="attachImage" ref="newTaskImage" class="form-control " id="image" >
                        <div class="invalid-feedback" style="display:inline-block !important" v-if="errors.image">{{errors.image[0]}}</div>
                    </div>
                    <hr>
                    <button type="button" class="btn btn-default" v-on:click="hideNewTaskModal">Cancel</button>
                     <button type="submit" class="btn btn-primary" >Save</button>
                    
                     
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
                                        <p style="display: inline-block" title="Anniversary of special day">Anniversary of special day</p>
                                </div>
                                <div>
                                    <my-switch v-model="switchValue2"/> 
                                        <p style="display: inline-block" title="Anniversary of birth day">Anniversary of birth day</p>
                                </div>     
                                <div>
                                    <my-switch v-model="switchValue3"/> 
                                        <p style="display: inline-block" title="Anniversary of death day">Anniversary of death day</p>
                                </div>      
                           
                            </div>
                             
                        <button type="button" class="btn btn-default" v-on:click="cancelSetingModal">Cancel</button>
                        <button type="submit" class="btn btn-primary" >Save</button>       

                            
                            
                        </div>
                    </form>
                      
                        
               
                </div>
           
            
            </b-modal>
        


            <b-modal ref="editTaskModal" hide-footer title="Update task">
            <div class="d-block ">
              <form v-on:submit.prevent="updateTask"> 
                   
                        <div>
                            <my-switch v-model="switchValue4"/> 
                            <p style="display: inline-block" title="#">Anniversary of birthday</p>
                        </div>
                        <div>
                            <my-switch v-model="switchValue5"/> 
                            <p style="display: inline-block" title="#">Anniversary of deathday</p>
                            </div>     
                                     
                        
                       
                   
                    
                    <hr>
                    <button type="button" class="btn btn-default" v-on:click="cancleEditTaskModal">Cancel</button>
                     <button type="submit" class="btn btn-primary" >Save</button>
                    
                     
              </form>
            </div>
           
            
            </b-modal>

            <b-modal ref="relationDataModal" hide-footer title="relation">
                <div class="d-block ">
                <form > 
                        <div class="form-group">
                          
                         <table class="table">
                                <thead>
                                    <tr>
                                        <td>No.</td>
                                        <td>Name .1</td>
                                        <td>Name .2</td>
                                        <td>Special day</td>
                                        <td>Option</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(relation,index) in relations" :key="index">
                                        <td>{{index+1}}</td>
                                        <td>{{relation.name1}}</td>
                                        <td>{{relation.name2}}</td>
                                        <td>{{relation.special_day}}</td>
                                        <button class="btn btn-danger btn-sm" v-on:click="deleteRelation(relation)" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                   
                                    </tr>
                                </tbody>
                            </table>

                        </div> 
                       
                        
                           
                    
                </form>
                </div>
           
            
            </b-modal>           
            <b-modal ref="relationModal" hide-footer title="add relation">
                <div class="d-block ">
                <form v-on:submit.prevent="createRelation"> 
                        <div class="form-group">
                            <div class="inline-block">
                                <input type="date" v-model="relationData.special_day ">
                                <span> special day</span>
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
                                        <td>
                                            <input type="checkbox" :value="task" v-model="selected" @click="check_one" >
                                            
                                        </td>
                                        
                                   
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
                deathDay:'',
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
            selected:[],
           
            errors:{},
            relExist:false,

            
            
        }
        

    },
    
    mounted(){
        this.loadTasks();
        this.loadSetting();
        this.loadRelation();
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
       check_one: function(){
            this.selected = [];
        },       

        loadRelation: async function(){
            const response = await relationService.loadRelation();
            console.log(response);
            this.relations = response.data.data;
            console.log(this.relations);
            
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
        hideRelationModal(){
            this.$refs.relationModal.hide();
        },
        

        addRelation(task){
            this.addRelationData = task;
            this.$refs.relationModal.show();
        },

        
        showRelationDataModal(){
            this.$refs.relationDataModal.show();
        },
        hideRelationDataModal(){
            this.$refs.relationDataModal.hide();
        },

        createRelation:async function(){
            let formData = new FormData();
            formData.append('user1', this.addRelationData.id);
            formData.append('user2',this.selected[0].id);
            formData.append('name1', this.addRelationData.name);
            formData.append('name2', this.selected[0].name);
            formData.append('special_day', this.relationData.special_day);
            
                for(let i = 0;i<this.relations.length;i++)
                {
                    let relation = this.relations[i];
                   
                    if((this.selected[0].id == relation.user1 && addRelationData.id == relation.user2 )||(this.selected[0].id == relation.user2 && this.addRelationData.id == relation.user1))
                        {
                            this.relExist = true;
                        }
                    
                }

                if(this.relExist == false)
                {
                    const response = await relationService.createRelation(formData);
                    this.$refs.relationModal.hide();
                    this.flashMessage.success({message:'success create relation'})
                    this.loadRelation();
                }else{
                  
                    this.$refs.relationModal.hide();
                    this.flashMessage.error({
                        message: 'relation exist',
                    }
                        
                    );
                     
                }
                
           
            
        },
        
       
        createTask: async function(){
            let formData =  new FormData();
            formData.append('name',this.taskData.name);
            formData.append('image',this.taskData.image);
            formData.append('date_of_birth', this.taskData.birthDay);
            formData.append('date_of_death', this.taskData.birthDay);
            
            
            try{
                const response = await taskService.createTask(formData);
                this.tasks.unshift(response.data);
                this.hideNewTaskModal();
                this.flashMessage.success({
                    message: 'Success store image!',
                    time: 3000

                });
                

            } catch(error){
                console.log(error.response.status);
                switch (error.response.status) {
                    case 422:
                        this.errors = error.response.data.errors;
                        
                        break;
                
                    default:
                        this.flashMessage.error({
                            message: 'load data error,check server',
                            time:3000
                        });
                }

            }
        },
        deleteRelation: async function(relation){
            if(!window.confirm('want to delete this relation ?')){
                return;
            }
            try {
                await relationService.deleteRelation(relation.id);
                
                this.relations = this.relations.filter(obj =>{
                    return obj.id != relation.id;
                });
            } catch (error) {
                
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
.img{
    max-width:600px;
    max-height: 600px;
}

@import url('https://use.fontawesome.com/releases/v5.13.0/css/all.css');

.limiter {
  width: 100%;
  margin: 0 auto;
}

.container-table100 {
  width: 100%;
  min-height: 100vh;
  background: #c850c0;
  background: -webkit-linear-gradient(45deg, #4158d0, #c850c0);
  background: -o-linear-gradient(45deg, #4158d0, #c850c0);
  background: -moz-linear-gradient(45deg, #4158d0, #c850c0);
  background: linear-gradient(45deg, #4158d0, #c850c0);

  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
  padding: 33px 30px;
}

.wrap-table100 {
  width: 1170px;
}

table {
  border-spacing: 1;
  border-collapse: collapse;
  background: white;
  border-radius: 10px;
  overflow: hidden;
  width: 100%;
  margin: 0 auto;
  position: relative;
  text-align: center;
}
table * {
  position: relative;
}
table td, table th {
  text-align: center;
    padding-left: 50px;
}
table thead tr {
  height: 60px;
  background: #36304a;

}
table tbody tr {
  height: 50px;
}
table tbody tr:last-child {
  border: 0;
}
table td, table th {
  text-align: left;
}
table td.l, table th.l {
  text-align: right;
}
table td.c, table th.c {
  text-align: center;
}
table td.r, table th.r {
  text-align: center;
}


.table100-head th{
  font-family:  -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  font-size: 18px;
  color: #fff;
  line-height: 1.2;
  font-weight: unset;
}

tbody tr:nth-child(even) {
  background-color: #f5f5f5;
}

tbody tr {
  font-family:  -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";;
  font-size: 15px;
  color: #808080;
  line-height: 1.2;
  font-weight: unset;
}

tbody tr:hover {
  color: #555555;
  background-color: #f5f5f5;
  cursor: pointer;
}

.column1 {
  width: 260px;
  padding-left: 40px;
}

.column2 {
  width: 160px;
}

.column3 {
  width: 245px;
}

.column4 {
  width: 110px;
  text-align: right;
}

.column5 {
  width: 170px;
  text-align: right;
}

.column6 {
  width: 222px;
  text-align: right;
  padding-right: 62px;
}


    img {
  vertical-align: middle;
  border-style: none;
  max-width: 200px;
  max-height: 200px;
}

modal-backdrop {
    
    background-color: rgba(0,0,0,0.5);
}
</style>