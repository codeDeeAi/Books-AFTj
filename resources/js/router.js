import Vue from "vue";
import Router from "vue-router";

// Use Router
Vue.use(Router);

// Import components
// Home
import home from './components/views/homepage'
// Login
import login from './components/views/login'
// Dashboard
import dashboard from './components/views/dashboard'
// Users
import users from './components/views/users/users'


const routes = [{
        path: "/",
        name: "home",
        component: home
    },
    {
        path: "/login",
        name: "login",
        component: login
    },
    {
        path: "/dashboard",
        name: "dashboard",
        component: dashboard,
        children: [{
                path: "/users",
                name: "users",
                component: users,
            },

        ]
    },

];

export default new Router({
    mode: "history",
    routes
});