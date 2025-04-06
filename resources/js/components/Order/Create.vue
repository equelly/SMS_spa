<template>
    <div class="container mt-1">
        
    <div class="flex justify-content-center mt-5">
    <span class="error" aria-live="polite"></span>
        <div class="card shadow mt-10 p-2 bg-white rounded">
        <div class="row g-0">
          <div class="col-md-6 mr-3">
             
                <div class="flex justify-end mb-2">
                  <label class="pt-2" for="mashine_id">ЭКГ№:</label>
                    <div class="form-group ml-4">
                        <select  v-focus  v-model="selectedMashineId"  class = "form-control w-100" name = "mashine" id="mashine_id" required>
                         <option disabled>выбрать</option>
                          
                            <option  v-for="mashine in mashines"
                                     v-bind:value='mashine.id'
                                     
                                     >{{ mashine.number }}</option>
                          
                        </select>
                    </div>
                </div> 
                <hr>  
                <label for="content_id"> заявка на выполнение работ,<br>доставку ТМЦ:</label><br>
                  <textarea class="w-100 focus:outline-none focus:ring focus:border-blue-500 border" rows="7" v-model="content" id="content_id" style="border-bottom: 2px solid #14B8A6; border-right: 2px solid #14B8A6;font-size: 1rem" placeholder=""></textarea><br>
                  <div class="mb-3"> 
                  <label for="foto" class="pt-3">фото</label><br>
                  <input class="" type="file" id="foto">
                  </div>
          </div>
          <div class="col-md-5 complect bg-gray-200">
            <set-component ref="setS" 
            v-bind:selected-mashine-id="selectedMashineId" 
            @toggle-favorite="receiveEmit"
            
            />
          </div>
                <div class="flex justify-end">
                  <button :disabled="!isDisabled" @click.prevent="addOrder" style="background-color: rgb(59 130 246 / 0.7);" id = "button_id" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-teal-400 bg-teal-500 hover:text-teal-500 hover:bg-white mt-4 lg:mt-0 callout mb-1 w-90">отправить</button>
                </div>
            </div>
            <div class="text-red-400 flex justify-content-center"></div>
          </div>
          
            
        </div>
        
    </div> 


</template>

<script>
import axios from 'axios';
import SetComponent from './SetComponent.vue';
//импортируем объект класса VueRouter для использования его метода .push при перенаправлении
import router from '../../router';

    export default {
        name: "Create",

        data(){
            return {
                mashines: null,
                selectedMashineId: null,
                userId: null,
                content: null,
                image: null,
                selectSets: [],
                
            } 
        },
   
        directives: {
        focus: {
            // определение директивы
            mounted(el) {
            el.focus()
            }
        }
        },


        mounted(){
            this.SelectMashine(),
            this.getUserId()
           
        },
      
        methods: {
            SelectMashine(){
                axios.get('/api/create')
                .then(res=>{
                this.mashines = res.data;
                let hide = document.getElementById('navbarSupportedContent-7');
                hide.className == 'navbar-collapse collapse show' ? hide.setAttribute('class', 'navbar-collapse collapse'):hide.setAttribute('class', 'navbar-collapse collapse show')
              
                })
            },
            getUserId(){
                axios.get('/api/username')
                    .then(res=>{
                        
                        this.userId = res.data.id     
                         })
                    .catch(error => console.log('there is mistake'))
                    .finally(()=>{
                                
                    });
                            
            },
            
            addOrder(){
                
                let selectedMashineId = this.selectedMashineId
                //console.log(selectedMashineId);
                 let checkedSets = this.$refs.setS.checkedSets;
                 this.selectSets.push(checkedSets)
                 //console.log(this.selectSets);
                
                axios.post('/api/store', {mashine_id : this.selectedMashineId, 
                                          content : this.content, 
                                          image : this.image, 
                                          category_id: 1, 
                                          user_id_req: this.userId,
                                          sets: this.selectSets})
                .then(res => {
                    //console.log(res);
                    
                    
                    router.push({name:'orders.index'})
                })
                .catch(error => console.log('there is mistake'))
                
                
            }, 
          

          
        },
              //вычисляемое динамическое свойство проверяем если content==null(false)
              computed:{
            isDisabled(){
            return this.content && this.selectedMashineId
            }
        },
        components:{
            SetComponent,
           
        }


    }
</script>
<style scoped>

</style>
