
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import router from './routes';

window.Vue = require('vue');

import VueRouter from 'vue-router';

window.Vue.use(VueRouter);

import Vuex from 'vuex';

Vue.use(Vuex);

Vue.use(require('vue-moment'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('app', require('./App.vue'));
Vue.component('navbar', require('./components/Basics/NavBar.vue'));
Vue.component('notifications', require('./components/Basics/NotificationArea.vue'));
Vue.component('account-card', require('./components/PeopleComponents/Account.vue'));
Vue.component('friend-card', require('./components/ChatComponents/FriendCard.vue'));
Vue.component('message-card', require('./components/ChatComponents/MessageCard.vue'));
Vue.component('request-card', require('./components/ChatComponents/RequestCard.vue'));
Vue.component('notification-card', require('./components/ChatComponents/NotificationCard.vue'));


const store = new Vuex.Store({
    state: {
        newConv: "",
    },
    mutations: {
        setNewConv(state, _newConv){
          state.notification = _newConv;
        }
    },
    actions : {

    },
    getters: {
        newConv(state){
          return state.newConv;
        }
    }
});

const app = new Vue({
    el: '#app',
    router: router,
    store: store
});
