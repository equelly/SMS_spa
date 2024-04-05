<template>
    <div>
     
                    
                        
                    <h4 class="card-title mt-3"><i>комплектация</i></h4><hr>
                    <div class="form-check">
                        
                         <ul v-for="set in sets">    
                               
                                <li style="font-size: 1.2rem;">
                                <input  v-bind:id = 'set.id' class="form-check-input checked:bg-cyan-300 hover:border-cyan-300" type="checkbox" v-model = "checkedSets" v-bind:value = set.id>
                          
                                <label  v-bind:for = 'set.id' class="form-check-label hover:text-cyan-400" >{{ set.name }}</label>
                                
                                </li>
                            
                        </ul>
                        </div>
                    
                     
    </div> 
       
</template>

<script>
import axios from 'axios';

    export default {
        name: "SetComponent",
        props:{
            selectedMashineId: Number,
            MashineNumber: String
        },
        
        data(){
            return {
                sets: null,
                checkedSets:[],
            } 
        },
        mounted(){
            this.getSets()
           
            
        },
      
        methods: {
            getSets(){
               axios.get('/api/sets')
               .then(res=>{
                this.sets = res.data;
                //let hide = document.getElementById('navbarSupportedContent-7');
                 //   hide.className == 'navbar-collapse collapse show' ? hide.setAttribute('class', 'navbar-collapse collapse'):hide.setAttribute('class', 'navbar-collapse collapse show')
                    
            })
                .catch(error => console.log(error))
                .finally(()=>{
  
                });
            },
            getChekedSets(){
                return 'добавить набор';
            },
            
        }


    }
</script>
<style scoped>
div{
    font-size: 0.8rem;
}
</style>
