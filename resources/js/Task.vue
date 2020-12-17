<template>
    <div >    
        <transition-group name='fade' tag='div'>
              
              <div v-for="i in [currentIndex]" :key='i'>
               <div :class="`frame${frame}`">
           
                  <img class="display " :src="`${$store.state.serverPath}/storage/${currentImg} `" />
               </div>
            </div>
           
        </transition-group>
    </div>
   
</template>
<script>
import * as taskService from './services/task_service';
import * as settingService from './services/setting_service';
import * as relationService from './services/relation_service';

export default {
    name:'display',
    components:{},
    data() {
        return{
            tasks:[],
            settings:[],
            relations:[], // store the data from server
            timer:null,
            currentIndex:0,
          display1:[],
           displays:{
             images:[
               {link: '', frame: 0   },{},{}
             ],
             frames:[
               1,
             ],
           },
          
            color:[
              1,
            ],

            today:'',
            time:'1998-12-12',
            test1:1,
            
        };

        
    },
    created() {
      setInterval(this.getNow, 1000);
    },

    mounted: function (){
       
        this.loadTasks();
        this.loadSetting();
        this.loadRelation();
        this.startSlide();
        this.setFrame();
        this.loadImage();
       
    },

    methods:{
        loadImage: async function(){
          const response = await taskService.getImage();
          console.log(response);
          this.display1 = response.data.data;
          console.log(this.display1);
        },
        loadTasks: async function(){
          const response = await taskService.loadTasks();
                console.log(response);
                this.tasks = response.data.data;
                for(var t =0; t <this.tasks.length;t++)
                {
                   this.displays.images.push(this.tasks[t].image) ;
                  //  this.displays.frame.push(this.task.[t].ena)
                }
            
                
                console.log(this.tasks);
        },
    
        loadRelation: async function(){
            const response = await relationService.loadRelation();
            console.log(response);
            this.relations = response.data.data;
            console.log(this.relations);
            
        },

        loadSetting: async function(){
            const response = await settingService.loadSetting();
            console.log(response);
            this.settings = response.data.data;
            console.log(this.settings);
        },
        startSlide: function() {
            this.timer = setInterval(this.next,4000);
        },

        next: function(){
            this.currentIndex += 1;
        },
        prev: function() {
            this.currentIndex -= 1;
        },
        setFrame: function(){
        return 0;
        },
        getNow: function() {
            const today = new Date();
            const date = (today.getMonth()+1)+'-'+today.getDate();
            this.today = date;
        },
        
       
  },
        

    computed: {
         currentImg: function() {
        return this.tasks[Math.abs(this.currentIndex) % this.tasks.length].image;
      },
      getTime: function(){
          return this.tasks[Math.abs(this.currentIndex) % this.tasks.length].date_of_birth.slice(5,10); 
        },
        checkBirth: function(){
          if(this.tasks[Math.abs(this.currentIndex) % this.tasks.length].date_of_birth.slice(5,10) == this.today)
          return true;
          return false;
        },
        checkDeath: function(){
          if(this.tasks[Math.abs(this.currentIndex) % this.tasks.length].date_of_death.slice(5,10) == this.today)
          return true;
          return false;
        },
        death_active: function(){
          if((this.tasks[Math.abs(this.currentIndex) % this.tasks.length].enable_death_event == 1) 
          || (this.settings[0].enable_death_event == 1))
          return true;
          return false; 
        },
        birth_active: function(){
          if(this.tasks[Math.abs(this.currentIndex) % this.tasks.length].enable_birth_event == 1 
          || this.settings[0].enable_birth_event == 1)
          return true;
          return false; 
        },
        frame: function(){
          if((this.death_active == true) && (this.checkDeath == true))
          {
            return 1;
          }else if((this.birth_active == true) && (this.checkBirth == true ))
          {
            return 2;
          }return 0;
          
          

        },
        test:function(){
         
          return 0;
       
        },

     


       
  }


};

</script>
<style>
    img {
      min-width: 700px;
      min-height:950px;
    }

 body {
   display: inline-block;
   text-align: center;
 }
  







.fade-enter-active,
.fade-leave-active {
  transition: all 0.01ms ease;
  overflow: hidden;
  visibility: visible;
  position: absolute;
  width:100%;
  opacity: 1;
}
.fade-enter,
.fade-leave-to {
  visibility: hidden;
  width:100%;
  opacity: 0;
}

.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.7s ease;
  border-radius: 0 4px 4px 0;
  text-decoration: none;
  user-select: none;
}
/* Position the "next button" to the right */
.next {
  right: 0;
}
.prev {
  left: 0;
}
/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.9);
}



.frame0 {
  background-color:#ddc;
  border:solid 5vmin pink;
  border-bottom-color: blue;
  border-left-color:blue;
  border-radius:2px;
  border-right-color:blue;
  border-top-color:blue;
  box-shadow:0 0 5px 0 rgba(0,0,0,.25) inset, 0 5px 10px 5px rgba(0,0,0,.25);
  box-sizing:border-box;
  display:inline-block;
 
  height:1024px;
  width: 768px;
 
  position:relative;
  text-align:center;
}
  
  .frame::before {
    border-radius:2px;
    bottom:-2vmin;
    box-shadow:0 2px 5px 0 rgba(0,0,0,.25) inset;
    content:"";
    left:-2vmin;
    position:absolute;
    right:-2vmin;
    top:-2vmin;
  }

  .frame::after {
    border-radius:2px;
    bottom:-2.5vmin;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,.25);
    content:"";
    left:-2.5vmin;
    position:absolute;
    right:-2.5vmin;
    top:-2.5vmin;
  }


 /* frame 1 */
  .frame1{
  background-color:#ddc;
  border:solid 5vmin #eee;
  border-bottom-color:#fff;
  border-left-color:#eee;
  border-radius:2px;
  border-right-color:#eee;
  border-top-color:#ddd;
  box-shadow:0 0 5px 0 rgba(0,0,0,.25) inset, 0 5px 10px 5px rgba(0,0,0,.25);
  box-sizing:border-box;
  display:inline-block;
 
  height:80vh;
  width: 400px;
 
  position:relative;
  text-align:center;
}
  
  .frame1::before {
    border-radius:2px;
    bottom:-2vmin;
    box-shadow:0 2px 5px 0 rgba(0,0,0,.25) inset;
    content:"";
    left:-2vmin;
    position:absolute;
    right:-2vmin;
    top:-2vmin;
  }

  .frame1::after {
    border-radius:2px;
    bottom:-2.5vmin;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,.25);
    content:"";
    left:-2.5vmin;
    position:absolute;
    right:-2.5vmin;
    top:-2.5vmin;
  }

</style>