<template>
    <br><br>
    <div class="card mt-5">
        <div class="card-body bg-blue-400">
            <div class="text-center">
                <h2 class="text" id="demo"> Панель входа </h2>
                <hr style="background: rgb(172, 213, 255);">
            </div>
        <div class="md-form">
            <i class="fas fa-envelope prefix text-light active"></i>
                <input v-model="email" type="email" placeholder="email" class="form-control m-2" id="email" autocomplete="on">
            <label for="email" class="active">Ваш email</label>
        </div>
        <div class="md-form">
            <i class="fas fa-lock prefix text-light active"></i>
                <input v-model="password" type="password" placeholder="password" class="form-control m-2" id="password">
                <label for="password">Пароль</label>
        </div>
        
        <input @click.prevent="login" type="submit" value="войти" class="btn btn-primary m-2">
        <div id="error" style="color: crimson;font-size: 1.1rem;"></div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

    export default {
        name: "Login",
        data(){
            return {
                email:null,
                password:null,
            }
        },


        methods:{
            login(){
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/login', { email:this.email, password:this.password })
                    .then(res=>{
                        
                        localStorage.setItem ('x_xsrf_token', res.config.headers['X-XSRF-TOKEN']);
                        
                        this.$router.push({name:'orders.personal'})
                        
                    })
                    //.then(this.$router.push({name:'get.index'}))
                    .catch(err=>{
                       
                       
                        let errBox = document.getElementById('error');
                       
                        errBox.innerHTML = 'Ошибка!Не верный email и/или пароль!';
                        
                    })
                   
                    
                 })
            }
        }

    }
</script>
<style scoped>

</style>
