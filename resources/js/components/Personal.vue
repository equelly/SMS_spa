<template>
    <div class="container mt-1">
        <div class="mt-1 p-2 bg-gray-200 "  style="border-bottom: 2px solid #14B8A6; font-size: 1.2rem">
            <div class="flex justify-content-between">
                <div  class="pl-3 ">мои заявки</div>
                <div class="pr-3">всего :  {{val }}</div>
            </div>
        </div>
        <template v-for="order in myorders">
            <div class="flex justify-content-center mt-3">
                <div class="card w-100 shadow p-2 bg-white rounded">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="flex justify-content-between">    
                                    <h4 class="card-title flex"><span class="p-2">ЭКГ№</span>
                                        <div :class="isEdit(order.id) ? 'd-none': 'card-title flex p-2'">{{  order.mashine['number']  }}</div>
                                        <select  v-focus  v-model="mashine_id"  class = "form-control w-100" required :class="isEdit(order.id) ? 'form-control w-25': 'd-none'">
                                 
                                            <option v-for="mashine in mashines" 
                                            v-bind:value = "mashine.id"
                                            :selected="order.mashine['id'] == mashine.id ? true : false" 
                                                    >          
                                                    {{ mashine.number }}</option>
                                        
                                        </select>
                                        
                                    </h4>
                                    <div class="form-group ml-4"> 
                                        <div :class="isEdit(order.id) ? 'd-none': 'card-title flex p-2'">{{  order.category['title']  }}</div>
                                        <select  v-focus  v-model="selectedCategoryId"  class = "form-control w-100" required :class="isEdit(order.id) ? 'form-control w-25': 'd-none'">
                                 
                                            <option v-for="category in categories" 
                                            v-bind:value = "category.id"
                                            :selected="order.category['id'] == category.id ? true : false" 
                                                    >          
                                                    {{ category.title }}</option>
                                        
                                        </select>
                                    </div>
                                    <br>
                                    
                                </div> <hr>  
                                <div class="flex justify-content-between">
                                    <small class="text-muted">{{order.user.name}} добавил: <time>{{order.carbonCreated}} </time></small>
                                    <small class="text-muted">{{!order.userExec ? '': `обновлено ${order.userExec.name}: ${order.carbonUpdated}`}}</small>
                                </div>
                                        <p :class="isEdit(order.id) ? 'd-none': 'card-text'">{{order.content}}</p>
                                        <textarea :class="isEdit(order.id) ? 'form-control': 'd-none'" v-model="content"></textarea>

                                        <a href="#" class="flex justify-content-end"><div class="text-muted"><small>подробнее ></small></div></a><hr>
                                <div class="flex justify-content-between"> 
                                    <div>
                                    <a href="#" @click.prevent="changeEditOrderId(order.id, order.mashine['id'], order.content, order.category['id'])"
                                        :class="isEdit(order.id) ? 'd-none': 'btn btn-success m-2'">изменить</a>     
                                    <button @click.prevent="updateOrder(order.id)" 
                                        :class="isEdit(order.id) ? 'btn btn-success m-2': 'd-none'" 
                                        
                                        :disabled="!isDisabled">обновить</button>  <!--  атрибут disabled = true если вычисляемое свойство не false (null)--> 
                                    </div>
                                    <div>
                                        <a href="#" @click.prevent="deleteOrder(order.id)"
                                        :class="isEdit(order.id) ? 'd-none': 'text-red-400 btn btn-danger m-2'">удалить</a>  
                                    </div>
                                </div>  
                            </div>
                        </div>

                        <div class="col-md-4 complect bg-gray-200">
                            <set-component  
                           
                            
                            />
                        </div>

                    </div>
                </div>
            </div> 
        </template>
    </div>
</template>

<script>
import axios from 'axios';
import SetComponent from './Order/SetComponent.vue';

    export default {
        name: "Personal",
        data(){
            return {
                mashines: null,
                myorders: null,
                val: null,
                editOrderId: null,
                mashine_id: null,
                selectedCategoryId: null,
                selected: null,
                
                content: null,
                user_exec: null,
                categories: [
                    {id: 1, title:'текущие'},
                    {id: 2, title:'выполнено'},
                    {id: 3, title:'отклонено'},
                ],
                deleteMessage: null
            } 
        },

        mounted(){
            this.getMyOrders(),
            this.SelectMashine(),
            this.getUserId()
           
        },
      
        methods: {
            getMyOrders(){
                axios.get('/api/personal')
                .then(res=>{
                    console.log(res.data.mashine_id);
                    //получаем объект res.data и перебираем его для доступа к значениям+++++++
                    for (const key in res.data) {
                        if (Object.hasOwnProperty.call(res.data, key)) {
                            const element = res.data[key];

                            if (!element.user.name) {
                                console.log('yes!!!');
                                //this.user_exec = element.userExec.name
                            }
                            
                            
                        }
                    }
                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    let hide = document.getElementById('navbarSupportedContent-7');
                    hide.className == 'navbar-collapse collapse show' ? hide.setAttribute('class', 'navbar-collapse collapse'):hide.setAttribute('class', 'navbar-collapse collapse show')

                    this.myorders = res.data;
                    this.category = res.data.category
                    //console.log(this.myorders[15].category.title);
                    this.val =  Object.keys(this.myorders).length;
                    
                })
                .catch(error => console.log(error))
                .finally(()=>{
                   // let hide = document.getElementById('navbarSupportedContent-7');
                    //hide.className == 'navbar-collapse collapse show' ? hide.setAttribute('class', 'navbar-collapse collapse'):hide.setAttribute('class', 'navbar-collapse collapse show')

                });
            },
            SelectMashine(){
                axios.get('/api/create')
                .then(res=>{
                this.mashines = res.data;
               
                })
            },
            getUserId(){
                axios.get('/api/username')
                    .then(res=>{
                        
                        this.user_exec = res.data.id     
                         })
                    .catch(error => console.log(error))
                    .finally(()=>{
                                
                    });
                            
            },
            //функция присваивает id заявки, содержание content и номер оборудования number  из формы в data компонента vue
            //а затем с помощью дерективы v-model выводим в input-поля их содержимое
            changeEditOrderId(id, mashine_id, content, category_id){
             
                this.editOrderId = id,
                this.mashine_id = mashine_id,
                this.content = content,
                this.selectedCategoryId= category_id
            },
            //функция для отображения полей редактирования при условии выбранной заявки по id
            isEdit(id){
                return this.editOrderId === id

            },

            //обновление данных, для начала присвоим editOrderId = null что динамично изменит класс 
            //который скроет поля ввода при нажатии "обновить"
            updateOrder(id){
                this.editOrderId = null
                axios.patch(`/api/personal/${id}`, {mashine_id: this.mashine_id, content: this.content, category_id: this.selectedCategoryId, user_exec: this.user_exec})
                    .then(res=>{
                        //после добавления обновим список заявок с обновленными данными с помощью функции getMyOrders()
                        this.getMyOrders()
                        
                    })

            },
            deleteOrder(id){
                this.editOrderId = null
                
                if(window.confirm('Вы хотите удалить заявку?')){
                  
                axios.delete(`/api/personal/${id}`)
                    .then(res=>{

                        //после удаления обновим список заявок с обновленными данными с помощью функции getMyOrders()
                        this.getMyOrders()
                        
                    })
                }

            }
        },
        //вычисляемое динамическое свойство проверяем если content==null(false)
        computed:{
            isDisabled(){
            return this.content && this.selectedCategoryId
            }
        },
        components:{
            SetComponent,
           
        }


    }
</script>
<style scoped>

</style>
