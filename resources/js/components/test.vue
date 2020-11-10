<template>
    <main>
        <div class="row">
            {{date}}
        </div>
        <div class="row" >
            <input type="date" class="form-control" v-bind:value="date.toJSON().substring(0,10)" v-on:change="date =new Date($event.target.value)">
        </div>
    </main>
    
</template>
<script>
export default {
    
    data(){
        return {
            date: new Date(),
        }
    }
}
</script>