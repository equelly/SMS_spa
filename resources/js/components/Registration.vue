<template>
    <br><br><br><br>
    <div class="card mt-5">
        <div class="card-body" style="background-color: rgb(59 130 246 / 0.5)">
            <div class="text-center">
                <h2 class="text" id="demo"> Регистрация </h2>
                <hr style="background: rgb(172, 213, 255);">
            </div>
            <div class="md-form">
            <i class="fas fa-user prefix text-light active"></i>
                <input v-model="name" type="text" placeholder="name" class="form-control m-2" required>
            <label for="email" class="active">Имя</label>
        </div>
        <div class="md-form">
            <i class="fas fa-envelope prefix text-light active"></i>
                <input v-model="email" type="email" placeholder="email" class="form-control m-2" required>
            <label for="email" class="active">Ваш email</label>
        </div>
        <div class="md-form">
        <select  v-focus  v-model="selectedUserCategories"  class="form-control m-2" id="category-user" required>
            <option  disabled>категория персонала</option>
            <option  v-for="UserCategory in UserCategories"
                v-bind:value='UserCategory.title'>{{ UserCategory.title }} </option>                  
        </select>
        <label for="category_user" class="active">Категория персонала</label>
        </div>
        <div class="md-form">
            <i class="fas fa-lock prefix text-light active"></i>
                <input v-model="password" type="password" placeholder="password" class="form-control m-2">
                <label for="password">Пароль</label>
        </div>
        <div class="md-form">
            <i class="fas fa-lock prefix text-light active"></i>
            <input v-model="password_confirmation" type="password" placeholder="подтвердите пароль" class="form-control m-2" required>
                <label for="password">Пароль</label>
        </div>
        <input disabled @click.prevent="register" type="submit" value="зарегистрироваться" class="btn btn-primary">
        <div id="error" style="color: crimson;font-size: 1.1rem;"></div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

    export default {
        name: "Registration",
        data(){
            return {
                name:null,
                email:null,
                selectedUserCategories:null,
                password:null,
                password_confirmation:null,
                UserCategories: [
                    {id: 1, title:'эксплуатационный'},
                    {id: 2, title:'обслуживающий'},
                    ],
            }
        },
        methods:{
            register(){
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/register', {
                        name:this.name, 
                        email:this.email, 
                        role:this.selectedUserCategories, 
                        password:this.password, 
                        password_confirmation:this.password_confirmation })
                        
                        .then(document.getElementById('error').innerHTML = this.name+'.Регистрация завершена. Выполняется переход в приложение')
                        .then(res=>{
                        localStorage.setItem ('x_xsrf_token', res.config.headers['X-XSRF-TOKEN']);
                        setTimeout(this.$router.push({name:'user.personal'}), 1000) 
                        })
                        .catch(err=>{
                        let message =  err.response.data.message;
                        let errBox = document.getElementById('error');
                        errBox.innerHTML = message;
                    })
                })
            }
        }

    }
</script>
<style scoped>

</style>
