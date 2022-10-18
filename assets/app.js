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
import { createStore } from 'vuex';
import App from './js/App.vue';
import * as VueRouter from 'vue-router';
import Show from './js/Show.vue';
import List from './js/List.vue';


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

const store = createStore({
    state: {
        id: 0
    },
    mutations: {
        CHANGE_ID(state, newId) {
            state.id = Number(newId)
        },
       
    },
    actions: {
        updateId({ commit }, id) {
          
            commit('CHANGE_ID', id)
           
        }
    }
})
    
    const app = createApp(App)
    app.use(store)
    app.use(router).mount('#vue')
    
    app.mount('vue')
    app
    .component('Show', Show)
    .component('List', List)
    
// new Vue({
//     el: '#app', // where <div id="app"> in your DOM contains the Vue template
// });