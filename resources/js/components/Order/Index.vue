<template>
    <CountIndex></CountIndex>
    <div v-for="mashine in mashines">
        <div v-if="mashine.orders.length" >
            
        
            <div class="flex justify-content-center mt-1" @click="go">
            <div class="card w-100 shadow p-2 bg-white rounded">
                    <div class="row g-0">
                        <div class="">
                            <div class="card-body">
                                <div class="flex justify-content-between">    
                                    <h4 class="card-title"><strong>ЭКГ№{{ mashine.number }}</strong></h4>
                                </div> <hr>  
                                    <div v-for="order in mashine.orders">
                                        
                                            <!-- Модальный -->
                                            <div id="myModal" class="modal">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <span class="close" @click="closeModal()">&times;</span>
                                                        <h3>Заявка для ЭКГ№{{ mashine_number }}</h3>индивидуальный номер: {{ order_id }}<hr>
                                                        <p><span class="text-muted">дата подачи: </span>{{order.carbonCreated}} <span class="text-muted">пользовтелем: </span>{{order.user.name}}</p>
                                                        <span class="text-muted">внесены изменения: </span>{{ order.carbonUpdated }}
                                                        
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{{ order.content }}</p>
                                                    
                                                    </div>
                                                    <div class="modal-footer">
                                                        <p>{{ category }}</p>
                                                    </div>
                                                    </div>
                                    </div>
                                        <template v-if="order.category_id == 1 && order.content != ''">
                                            <div class="flex justify-content-between">
                                            <small class="text-muted">{{order.user.name}} добавил: <time>{{order.carbonCreated}} </time></small>
                                            <small class="text-muted">{{!order.userExec ? '': `обновлено ${order.userExec.name}: ${order.carbonUpdated}`}}</small>
                                        </div> 
                                            <p class="card-text">{{order.content}}</p>
                                            {{ order.category.title == 'текущие'? 'еще ожидает выполнения':'уже выполнена' }}  
                                            
                                            <a href="#" class="flex justify-content-end"><div class="text-muted"><small @click.prevent="getOrder(order.id)">подробнее ></small></div>
                                            </a><hr>
                                        </template>
                                    </div>
                            </div>
                        </div>
                        <div class="bg-gray-200">
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
    </div>


</template>

<script>
import axios from 'axios';
import CountIndex from './CountIndex.vue';

    export default {
        name: "Index",
        
        data(){
            return {
                mashines: null,
                order: null,
                order_id: null,
                mashine_number: null,
                category: null
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
                //console.log(this.mashines);
                
                let hide = document.getElementById('navbarSupportedContent-7');
                    hide.className == 'navbar-collapse collapse show' ? hide.setAttribute('class', 'navbar-collapse collapse'):hide.setAttribute('class', 'navbar-collapse collapse show')

                })
            },
            getOrder(id){
                this.rollMenu()
                let modal = document.getElementById("myModal"); 
                axios.get(`/api/order/${id}`)
                
                .then(res=>{
                    this.order_id = res.data.order.id,
                    this.mashine_number = res.data.order.number,
                    this.category = res.data.order.category
                    
                    }
                )
                
                modal.style.display = "block";
            },
            
            closeModal(){
                document.getElementById("myModal").style.display = "none"; 

            }, 
            
            go(event){
                let modal = document.getElementById("myModal");
                if (event.target == modal) {
                modal.style.display = "none";
                }
            },
            rollMenu(){
                let hide = document.getElementById('navbarSupportedContent-7');
                hide.className == 'navbar-collapse collapse collaps' 
              
            },
      
            
        },
        components:{
            CountIndex,
           
        }


    }
</script>
<style scoped>
/* Модальный заголовок */
.modal-header {
  display: block;
  padding: 2px 16px;
  background-color: #ced4da;
 
}

/* Модальное тело */
.modal-body {padding: 2px 16px;}

/* Модальный нижний колонтитул */
.modal-footer {
  padding: 2px 16px;
  background-color: #ced4da;
  color: white;
}
/* Модальный (фон) */
.modal {

  background-color: rgb(0,0,0); /* Цвет запасной вариант */
  background-color: rgba(0,0,0,0.4); /* Черный с непрозрачностью */
}

/* Модальное содержание */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 5px;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  animation-name: animatetop;
  animation-duration: 0.6s
}

/* Добавить анимация */
@keyframes animatetop {
  from {top: -300px; opacity: 0}
  to {top: 0; opacity: 1}
}
h3{
    font-size: 1.6rem;
}
div{
    font-size: 1rem;
}
</style>
