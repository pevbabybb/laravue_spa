<template>
    <div class="switch-component-wrapper" @click="changeSwitchValue">
        <div class="switch-wrapper" :class="{'on':value,'off': !value }">
            <div class="circle"></div>

        </div>
    </div>
</template>
<script>
export default {
    props:["value"],
    methods:{
        changeSwitchValue(){
            this.$emit('input',!this.value);
        }
    }
}
</script>

<style >
 
 .switch-component-wrapper{
     display:inline-block;

     width:50px;
     
 }

 .switch-wrapper{
     width: 44px;
     min-height: 22px;
     display: flex;
     cursor: pointer;
     border-radius: 22px;
     align-items: center;
     padding: 2px;
     transition: all 0.5s;
     background: green;
 }

 .circle{
     background: #fff;
     width: 18px;
     height: 18px;
     border-radius: 18px;
 }

 .on{
     background: green;
     justify-content: flex-end;
 }

 .off{
     background:gray;
     justify-content: flex-start;
 }

</style>