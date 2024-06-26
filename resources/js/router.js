
import { createRouter, createWebHistory} from 'vue-router';

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),

    routes: [
        {
        path: '/api/orders', component: ()=>import('./components/Order/Index.vue'),
        name:'orders.index'
        },
        {
        path: '/user/login', component: ()=>import('./components/Login.vue'),
        name:'user.login'
        },
        {
        path: '/user/registration', component: ()=>import('./components/Registration.vue'),
        name:'user.registration'
        },
        {
        path: '/api/personal', component: ()=>import('./components/Personal.vue'),
        name:'user.personal'
        },
        {
        path: '/api/create', component: ()=>import('./components/Order/Create.vue'),
        name:'order.create'
        },
        {
        path: '/api/search', component: ()=>import('./components/Order/Search.vue'),
        name:'order.search'
        },
    ]


})
//произведем настройку router на наличие токена
router.beforeEach((to, from, next)=>{
    const token = localStorage.getItem('x_xsrf_token');
    if(!token){
        if(to.name === 'user.login' || to.name === 'user.registration'){
            return next();
        }else{
            return next({
                name: 'user.login'
            })
        }
    }
    if(to.name === 'user.login' || to.name === 'user.registration' && token){
        return next({
            name: 'user.personal'
        })
    }

    next();

})

export default router;
