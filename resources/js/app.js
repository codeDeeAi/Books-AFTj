// const { default: Vue } = require('vue');

require('./bootstrap');

// Load Vue JS
window.Vue = require('vue');



// Import router JS for vue routes
import router from './router'

// Import common JS for Apis like notification,callApi etc
import common from './common'


// Import store JS for vuex
import store from './store'

// Load Vue Toasts
import VueToast from 'vue-toast-notification';
// Import one of available themes
import 'vue-toast-notification/dist/theme-default.css';
//import 'vue-toast-notification/dist/theme-sugar.css';


Vue.use(VueToast, {
    // One of the options
    position: 'top-right',
    duration: 5000,
    pauseOnHover: true,
})

// Import vue components
Vue.component('mainapp', require('./components/mainapp.vue').default);

// Use Common Js
Vue.mixin(common)



const app = new Vue({
    el: '#app',
    router,
    store
});