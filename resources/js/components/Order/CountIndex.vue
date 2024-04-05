<template>
    <div class="container">
        <div class="mt-4 flex justify-content-center p-2 bg-gray-200 "  style="border-bottom: 2px solid #14B8A6; font-size: 1.2rem">
            <h4  class="flex justify-content-end p-2" style="width: 40rem">Всего текущих заявок:  {{val }}</h4>
        </div>
            
        
        
    </div>
</template>

<script>
import axios from 'axios';

    export default {
        name: "CountIndex",
        data(){
            return {
                orders: null,
                val: null
            } 
        },
        mounted(){
            this.getOrders();
            //console.log(this.$refs.index);
        },
        methods: {
            getOrders(){
                axios.get('/api/get')
                .then (res=>{
                    this.orders = res.data;
                    this.val =  Object.keys(this.orders).length;
                })
            },
           
        },
        components:{
            
           
        }


    }
</script>
<style scoped>

</style>
