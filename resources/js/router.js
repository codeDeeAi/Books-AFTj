import Vue from "vue";
import Router from "vue-router";

// Use Router
Vue.use(Router);

// Import components
// Home
import home from "./components/views/homepage";
// Auth
import login from "./components/views/auth/login";
import signup from "./components/views/auth/signup";
// Books
import books from "./components/views/admin/books";
import book from "./components/views/admin/book";
// 404
import error from "./components/views/404/404";

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
        path: "/signup",
        name: "signup",
        component: signup
    },
    {
        path: "/books",
        name: "books",
        component: books
    },
    {
        path: "/book-:title-:id",
        name: "book",
        component: book
    },
    {
        path: "*",
        name: "404",
        component: error
    }
];

export default new Router({
    mode: "history",
    routes
});