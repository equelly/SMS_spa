<template>
 44444444
</template>

<script>
import axios from 'axios';

    export default {
        name: "Show",
        
        data(){
            return {
                
            } 
        },
        mounted(){
            this.showOrder()
                    
        },
        props:[
            
        ],
      
        methods: {
            showOrder(){
            axios.get('/api/order')
               .then(res=>console.log(res))
                
            
            }
            
            
        }


    }
</script>
<style scoped>
div{
    font-size: 1.2rem;
}
</style>
