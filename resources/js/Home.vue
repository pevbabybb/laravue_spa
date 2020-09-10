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
                                        <td>id</td>
                                        <td>name</td>
                                        <td>action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>taile</td>
                                        <td>image</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm">upload</button>
                                            <button class="btn btn-danger btn-sm">delete</button>
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
              <form v-on:summit.prevent="createTask"> 
                    <div class="form-group">
                        <label for="name">enter name</label>
                        <input type="email"  v-model= "taskData.name" class="form-control" id="name" placeholder="dien zo" >
                    </div>
                     <div class="form-group">
                        <label for="image">choose image</label>
            
                        <div v-if="taskData.image.name">
                            <img src="" ref="newTaskImageDisplay">

                        </div>
                        <input type="file" v-on:change="attachImage" ref="newTaskImage" class="form-control w-150px" id="image" >
                    </div>
                    <hr>
                    <button type="button" class="btn btn-default" v-on:click="hideNewTaskModal">Cancel</button>
                     <button type="submit" class="btn btn-primary">save</button>
              </form>
            </div>
            
            </b-modal>
             <Footer/>
    </main>
  
</template>

<script>
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
            taskData:{
                name:'',
                image:'',
            }
        }
    },
    methods:{
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
        hideNewTaskModal(){
            console.log('form submitted')
        }
    }
    
    
}
</script>
