<template>
    <div class="container mt-1">
 <div class=" p-2 bg-gray-200 "  style="border-bottom: 2px solid #14B8A6; font-size: 1.2rem">
    <h5  class="flex justify-content p-2" style="width: auto">Параметры поиска:  <br>
        категория__________ "{{ category }}" <br>
        автор______________ "{{ user }}" <br>
        номер оборудования_ "{{ mashine }}" <br>
        создана____________ "{{ dates }}" <br>
        фрагмент___________ "..{{ content }}.."</h5>
</div>

    <div class="flex justify-content-center mt-3">
<form action="" method="GET">
    <div class="row g-3 align-items-center">
        <div class="card shadow mt-3 bg-white rounded">
            <p><div class="col-auto">
                <label for="category_id" class="col-form-label">Категория </label>
            </div>
            <div class="col-auto">
            <select  multiple v-model="category" class = "form-control w-60" id="category_id">
                <option disabled value="">выбор категории</option>
                    <template v-for="category in categories">
                    <option :value="category.id">{{category.title}}</option>
                    </template>
            </select>
            </div></p>
            <p><div class="col-auto">
                <label for="user_id" class="col-form-label">Автор </label>
            </div>
            <div class="col-auto">
            <select multiple v-model="user" class = "form-control w-60" name = "users" id="user_id">
                    <option></option>
                    <template v-for="user in users">
                    <option :value="user.id">{{user.name}}</option>
                    </template>
                    
                </select>
            </div></p>
            <p><div class="col-auto">
                <label for="mashine_id" class="col-form-label">Оборудование</label>
            </div>
            <div class="col-auto">
                <select multiple v-model="mashine" class = "form-control w-60" name = "mashine_id" id="mashine_id">
                    <option></option>
                    <template v-for="mashine in mashines">
                    <option :value="mashine.id">{{mashine.number}}</option>
                    </template>
                </select>
            </div></p>
            <p><div class="col-auto">
                <div class="col-form-label">Дата </div>
            </div>
            <div class="col-auto">
                <label for="from" class="col-form-label">от</label> <input  v-model="from" type="date" id="from" class="form-control w-60" name="created_at">
            </div>
            <div class="col-auto">
                <label for="to" class="col-form-label">до</label><input v-model="to" type="date" id="to" class="form-control w-60" name="created_at">
            </div>
        </p>
            <p><div class="col-auto">
                <label for="content_id" class="col-form-label">фрагмент заявки</label>
            </div>
            <div class="col-auto">
                <input type="text" id="content_id" class="form-control" name="content"v-model="content">
            </div></p>
           
        
                <div class="flex justify-end">
                  <button @click.prevent="getOrderList()" style="background-color: rgb(59 130 246 / 70%)" type="submit" class=" w-60 inline-block text-sm px-4 py-2 leading-none border rounded text-white border-teal-400 hover:text-teal-500 hover:bg-white callout m-3">найти</button>
                </div>
        </div>
    </div>
</form>



    </div> 
</div>
</template>

<script>
import axios from 'axios';



    export default {
        name: "Search",
        
        data(){
            return {
                //переменные для хранения полученных значений с бэкэнда (возвращает FilterListController)
                mashines: null,
                users: null,
                categories: null,
                orders: null,
                //создадим переменные для хранения выбранных параметров фильтра
                user:[],
                mashine:[],
                category: [],
                dates: [],
                from: '',
                to: '',

                content: ''
            } 
        },
        mounted(){
                 this.rollMenu()
                 this.getFilterList()
                    
        },
        props:[
            
        ],
      
        methods: {
            rollMenu(){
                let hide = document.getElementById('navbarSupportedContent-7');
                hide.className == 'navbar-collapse collapse show' ? hide.setAttribute('class', 'navbar-collapse collapse'):hide.setAttribute('class', 'navbar-collapse collapse show')
            },
            //функция добавления выбранных параметров  для фильтрации
           
            getOrderList(){
                //очистим массив диапазона дат от предудущих запросов
                this.dates.length = 0
                //в массив dates добабим диапазон дат из инпутов
                if(this.from != ''){
                    this.dates.push(this.from) 
                }
                if(this.to != ''){
                    this.dates.push(this.to)
                }
                
                //console.log(this.category, this.user, this.mashine, this.dates);
                axios.post('/api/search', {
                    'category': this.category,
                    'mashine': this.mashine,
                    'user': this.user,
                    'dates': this.dates,
                    'content': this.content
                })
                .then(res => {
                    this.orders = res.data
                    console.log(res);
                    
                })

            },

            search(){
                axios.post('/api/search')
            .then(res=>{this.mashines = res.data.mashines, this.users = res.data.users, this.categories = res.data.categories;},
               
                
            );
            let hide = document.getElementById('navbarSupportedContent-7');
                hide.className == 'navbar-collapse collapse show' ? hide.setAttribute('class', 'navbar-collapse collapse'):hide.setAttribute('class', 'navbar-collapse collapse show')
             
            },
//функция для вывода всех элементов массивов по которым будет проводится фильтрация
            getFilterList(){
                axios.get('/api/filters')
                .then(res=> {
                    this.mashines = res.data.mashines, this.users = res.data.users, this.categories = res.data.categories;
                    //console.log(res)
                }
                    
                    
                    
                
                )

            }
        },
        components:{
           
           
        },
        computed: {
            searched(){
                //в массивах найдем объекты по запрошенным параметрам поиска
                let for_mashine = [this.mashine];
                
               
                return (for_mashine)
            }
   
    },

    }
</script>
<style scoped>
div{
    font-size: 1.2rem;
}
</style>
