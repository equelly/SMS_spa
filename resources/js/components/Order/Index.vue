<template>
    <CountIndex></CountIndex>
    <div v-for="mashine in mashines">
        <div class="flex justify-content-center mt-1">
        <div class="card w-100 shadow p-2 bg-white rounded">
                <div class="row g-0">
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="flex justify-content-between">    
                                <h4 class="card-title"><strong>ЭКГ№{{ mashine.number }}</strong></h4>
                            </div> <hr>  
                                <div v-for="order in mashine.orders">
                                    
                                    <div class="flex justify-content-between">
                                    <small class="text-muted">{{order.user.name}} добавил: <time>{{order.carbonCreated}} </time></small>
                                    <small class="text-muted">{{!order.userExec ? '': `обновлено ${order.userExec.name}: ${order.carbonUpdated}`}}</small>
                                </div> 
                                    <p class="card-text">{{order.content}}</p>
                                      {{ order.category.title }}  
                                    <a href="#" class="flex justify-content-end"><div class="text-muted"><small>подробнее ></small></div></a><hr>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-5 bg-gray-200">
                        <h4 class="card-title mt-3"><i>ЭКГ№{{ mashine.number }}<br>укомплектовать:</i></h4><hr>
                            <div v-for="set in mashine.sets">    
                                <ul>    
                                    <li>-{{ set.name }}</li>
                                </ul>
                            </div>
                    </div>
                    
                </div>
        </div>
    </div> 
    </div>

</template>

<script>
import axios from 'axios';
import CountIndex from './CountIndex.vue';

    export default {
        name: "Index",
        
        data(){
            return {
                mashines: null
            } 
        },
        mounted(){
            this.getMashines()            
        },
        props:[
            
        ],
      
        methods: {
            getMashines(){
               axios.get('/api/orders')
               .then(res=>{
                this.mashines = res.data;
                //console.log(res.data);
                let hide = document.getElementById('navbarSupportedContent-7');
                hide.className == 'navbar-collapse collapse show' ? hide.setAttribute('class', 'navbar-collapse collapse'):hide.setAttribute('class', 'navbar-collapse collapse show')
               })
            }
            
        },
        components:{
            CountIndex,
           
        }


    }
</script>
<style scoped>
div{
    font-size: 1rem;
}
</style>
