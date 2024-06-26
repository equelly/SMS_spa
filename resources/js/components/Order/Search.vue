<template>
 <div class="flex justify-content-center p-2 bg-gray-200 "  style="border-bottom: 2px solid #14B8A6; font-size: 1.2rem">
    <h5  class="flex justify-content-end p-2" style="width: auto">Параметры поиска:</h5>
</div>
    <div class="flex justify-content-center mt-3">
<form action="" method="GET">
    <div class="row g-3 align-items-center">
        <div class="card shadow mt-3 bg-white rounded">
            <p><div class="col-auto">
                <label for="category_id" class="col-form-label">Категория </label>
            </div>
            <div class="col-auto">
            <select class = "form-control w-60" name = "category_id" id="category_id">
                    <option></option>
                    <template v-for="category in categories">
                    <option value="{{category.id}}">{{category.title}}</option>
                    </template>
                </select>
            </div></p>
            <p><div class="col-auto">
                <label for="user_id" class="col-form-label">Автор </label>
            </div>
            <div class="col-auto">
            <select class = "form-control w-60" name = "users" id="user">
                    <option></option>
                    <template v-for="user in users">
                    <option value="{{user.id}}">{{user.name}}</option>
                    </template>
                    
                </select>
            </div></p>
            <p><div class="col-auto">
                <label for="mashine_id" class="col-form-label">Оборудование</label>
            </div>
            <div class="col-auto">
                <select class = "form-control w-60" name = "mashine_id" id="mashine">
                    <option></option>
                    <template v-for="mashine in mashines">
                    <option value="{{mashine.id}}">{{mashine.number}}</option>
                    </template>
                </select>
            </div></p>
            <p><div class="col-auto">
                <label for="date_id" class="col-form-label">Дата </label>
            </div>
            <div class="col-auto">
                <input type="date" id="date_id" class="form-control w-60" name="created_at">
            </div></p>
            <p><div class="col-auto">
                <label for="content_id" class="col-form-label">фрагмент заявки</label>
            </div>
            <div class="col-auto">
                <input type="text" id="content_id" class="form-control" name="content">
            </div></p>
            <input type="hidden" id="content_id" class="form-control" name="action" value="search">
        
                <div class="flex justify-end">
                  <button style="background-color: rgb(59 130 246 / 70%)" type="submit" class=" w-60 inline-block text-sm px-4 py-2 leading-none border rounded text-white border-teal-400 hover:text-teal-500 hover:bg-white callout m-3">найти</button>
                </div>
        </div>
    </div>
</form>
    </div> 
</template>

<script>
import axios from 'axios';

    export default {
        name: "Search",
        
        data(){
            return {
                mashines: null,
                users:null,
                categories:null
            } 
        },
        mounted(){
                 this.search()   
        },
        props:[
            
        ],
      
        methods: {
            search(){
                axios.get('/api/search')
            .then(res=>{this.mashines = res.data.mashines, this.users = res.data.users, this.categories = res.data.categories ;console.log(res)});
            let hide = document.getElementById('navbarSupportedContent-7');
                hide.className == 'navbar-collapse collapse show' ? hide.setAttribute('class', 'navbar-collapse collapse'):hide.setAttribute('class', 'navbar-collapse collapse show')
             
            }
        }


    }
</script>
<style scoped>
div{
    font-size: 1.2rem;
}
</style>
