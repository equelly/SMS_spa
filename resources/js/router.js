
import { createRouter, createWebHistory} from 'vue-router';

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),

    routes: [
        // {
        //     path: "/",
        //     name: "home", // or any name you want
        //     component: ()=>import('./components/Order/Index.vue'), //You need to crate and import this component
        // },
        {
        path: '/api/orders', component: ()=>import('./components/Order/Index.vue'),
        name:'orders.index'
        },
        {
        path: '/api/order', component: ()=>import('./components/Order/Show.vue'),
        name:'order.show'
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
        path: '/api/orders/personal', component: ()=>import('./components/Order/Personal.vue'),
        name:'orders.personal'
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
