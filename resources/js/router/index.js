import {createRouter, createWebHistory} from "vue-router";

const routes= [
    {
        path:'/',
        name:'customers',
        component: () => import("../views/CustomerDashboard.vue"),
    },
    {
        path: '/new-customer',
        name:'new-customer',
        component: () => import("../views/NewCustomer.vue")
    },
    {
        path: '/edit-customer',
        name:'edit-customer',
        component: () => import("../views/EditCustomer.vue")
    },
    {
        path:'/contacts',
        name:'contacts',
        component: () => import("../views/ContactDashboard.vue"),
    },
    {
        path: '/new-contact',
        name:'new-contact',
        component: () => import("../views/NewContact.vue")
    },
    {
        path: '/edit-contact',
        name:'edit-contact',
        component: () => import("../views/EditContact.vue")
    },
    {
        path:'/:pathMatch(.*)*',
        name:'notFound',
        component: () => import("../components/NotFound.vue"),
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default  router
