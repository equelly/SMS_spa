<template>
    <div class="container mt-5">
        <br>
     <!-- Navbar -->
     <nav class="navbar navbar-expand-lg bg-gray-300 fixed-top scrolling-navbar">
            <div class="container">
              <a class="navbar-brand ml-3" href="/">
                <strong>SMS</strong>
              </a>
             
                <ul class="navbar-nav ms-auto pr-2">
                    <li class="flex">
                        <a  class="pl-2" v-if="token" @click.prevent = "logout" href="#"> Выход из аккаунта </a>
                        <div class="pl-2">{{ userName }}</div>
                    </li> 
                    <li>
                        <router-link v-if="!token" :to="{name:'user.login'}" class="mr-3"> Login </router-link>   
                    
                        <router-link v-if="!token" :to="{name:'user.registration'}" class="mr-3"> Registration </router-link>
                    </li>    
                </ul>
                <button class="navbar-toggler mr-3" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7" aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
                menu
                </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
                
                <ul  class="flex justify-around m-2 navbar-nav mr-auto ">
                <li class="nav-item ml-3">
                    <router-link v-if="token" :to="{name:'orders.index'}"><div class="p-1 text-white text-lg">К заявкам</div></router-link>
                    </li> 
                <li class="nav-item ml-3">
                    <router-link v-if="token" :to="{name:'user.personal'}"><div class="p-1 text-white text-lg">Personal </div></router-link>
                </li>
                <li class="nav-item ml-3">
                    <router-link v-if="token" :to="{name:'order.create'}"><div class="p-1 text-white text-lg">Сформировать заявку</div></router-link>
                </li>
                <li class="nav-item ml-3">
                    
                    <router-link v-if="token" :to="{name:'order.search'}"><div class="p-1 text-white text-lg">Поиск</div></router-link>
                </li>
                <li class="nav-item item ml-3">      
                    <a href="#" class="nav-link">
                        Admin 
                    </a></li>                
                </ul>
              </div>
            </div>
          </nav>
          <!-- Navbar -->
        
        
        
       
        
        <router-view  :key="$route.fullPath"></router-view>
    </div>
</template>

<script>
import axios from 'axios';


    export default {
        name: "Index",
        data(){
           return {
            token: null,
            user: null,
            userName: null
            }
        },

        mounted(){
            this.getToken(),
            this.getUserName()

        },

        updated(){
            this.getToken()
        },

        methods:{
            getToken(){
                this.token = localStorage.getItem('x_xsrf_token')
            },
            logout(){
                axios.post('/logout')

                .then(res=>{
                    localStorage.removeItem('x_xsrf_token')
                    this.$router.push({name:'user.login'})
                })
            },
            getUserName(){
                axios.get('/api/username')
                .then(res=>{
                    this.userName = res.data.name
                    this.user = res.data  
                    //console.log(res.data);
                })
                .catch(error => console.log(error))
                .finally(()=>{
                  
                });
            }
        },
        components:{
            
           
        }

    }
</script>
<style scoped>

</style>
