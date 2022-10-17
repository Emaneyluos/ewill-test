/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */



// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';


import { createApp } from 'vue';
import App from './js/App.vue';
import * as VueRouter from 'vue-router';
import Show from './js/Show.vue';

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes: [
        {
        path: '/home',
        name: 'Home',
        component: App
        },
        {
            path: '/show/:id',
        name: 'Show',
        component: Show
        }
      ]
    })
    
    const app = createApp(App)
    app.use(router).mount('#vue')
    app.mount('vue')

// new Vue({
//     el: '#app', // where <div id="app"> in your DOM contains the Vue template
// });