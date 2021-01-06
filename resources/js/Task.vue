<template>

  <div class="">
   <transition-group  class="content__list" :name="transition">
      
        <div v-for="i in [currentIndex]" :key='i'>
            <img class="img1" :src="`${$store.state.serverPath}/storage/${currentImg}`"  
            :style=" `border-image: url(${$store.state.serverPath}/storage/worship_image/${frame}.jpg)  100 round `"
            />
          
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
            times:[],
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
           image:[],
          
            color:[
              1,
            ],

            today:'',
            time:'1998-12-12',
            test1:3000,
            sliceDuration:'',
            transition:'',
           
            
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
           
            this.transition = this.settings[0].transition;
           
            console.log(this.settings);
        },
        startSlide: async function() {
            const time = await settingService.loadSetting();
             this.sliceDuration = this.settings[0].duration * 1000; 
              this.times = time.data.data;
            this.timer = setInterval(this.next, this.sliceDuration);
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
        
//  this.image.push(this.tasks[i].image);
    computed: {
         currentImg: function() {
           if(this.special_day1 == false || this.relations.length == 0) 
        {
          return this.tasks[Math.abs(this.currentIndex) % this.tasks.length].image;
        }else{
          for( var i=0; i <this.tasks.length;i++ )
              {
                for(var j =0; j < this.relations.length;j++)
                {
                  if(this.tasks[i].id == this.relations[j].user1 
                  ||this.tasks[i].id == this.relations[j].user2 )
                  {
                    this.image.push(this.tasks[i].image)
                  }
                }
              }
          return  this.image[Math.abs(this.currentIndex) % this.image.length];
        }
      },
        special_day1: function(){
          if(this.settings[0].enable_specialDay ==1 )
          {
            for( var i = 0; i<this.relations.length; i ++)
            {
              if(this.relations[i].special_day.slice(5,10) == this.today)
              {
              
                return true;
              }
            }return false;
          }return false;
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
        checkSpecialDay: function(){
         for( var i = 0; i<this.relations.length; i ++)
         {
           if(this.relations[i].special_day.slice(5,10) == this.today)
           {
             if(this.relations[i].user1 == this.tasks[Math.abs(this.currentIndex) % this.tasks.length].id
             ||this.relations[i].user2 == this.tasks[Math.abs(this.currentIndex) % this.tasks.length].id  )
             {
               return true;
             }
           }
         }return false;
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
          }
          return 0;
        },
        duration: function(){
          // 
         return this.settings[0].duration*1000;
        },
        test:function(){
         
          return this.settings[0].duration*1000;
       
        },

     


       
  }


};

</script>
<style>
  
   .img1{
       min-height:100vh;
    min-width:100vw;
   border: 5vh solid transparent ;
     
    
   }
   

 body {
   display: inline-block;
   text-align: center;
 }
  




.company {
  backface-visibility: hidden;
  z-index: 1;
}

/* moving */
.company-move {
  transition: all 600ms ease-in-out 50ms;
}

/* appearing */
.company-enter-active {
  transition: all 400ms ease-out;
}

/* disappearing */
.company-leave-active {
  transition: all 200ms ease-in;
  position: absolute;
  z-index: 0;
}

/* appear at / disappear to */
.company-enter,
.company-leave-to {
  opacity: 0;
}


.slide-fade-enter-active {
  transition: all 4s ease;
}
.slide-fade-leave-active {
  transition: all 4s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}

.rotate-enter { transform: perspective(500px) rotate3d(0, 1, 0, 90deg); }
.rotate-enter-active,
.rotate-leave-active { transition: 1s; }
.rotate-leave-to { transform: perspective(500px) rotate3d(0, 1, 0, -90deg); }


.slide1-enter {
  opacity: 0;
  transform: scale3d(2, 0.5, 1) translate3d(400px, 0, 0);
}

.slide1-enter-to { transform: scale3d(1, 1, 1); }
.slide1-enter-active,
.slide1-leave-active { transition: 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55); }
.slide1-leave { transform: scale3d(1, 1, 1); }

.slide1-leave-to {
  opacity: 0;
  transform: scale3d(2, 0.5, 1) translate3d(-400px, 0, 0);
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



  
  </style>