require('./bootstrap');
import Vue from 'vue'
import vuetify from './plugin/vuetify';
Vue.use(vuetify)

import VueRouter from 'vue-router';
Vue.use(VueRouter);
require('./global-components');
import routes from './routes'
const router = new VueRouter(routes)
import common from './common';
Vue.mixin(common);
import store from './store/index.js';
axios.defaults.baseURL = '/api/'

function loggedIn() {
    return JSON.parse(localStorage.getItem("authUserData"))
}
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!loggedIn()) {
            next({
                path: '/login',
                // query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else if (to.matched.some(record => record.meta.guest)) {
        if (loggedIn()) {
            next({
                path: '/dashboard',
                // query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
})

import Swal from 'sweetalert2'
window.swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

window.toast = Toast;

import { Form, HasError, AlertError } from 'vform'

window.Form = Form;

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('admin-layout', require('./components/Layouts/AdminLayout.vue').default);

const app = new Vue({
    el: '#app',
    store,
    router,
    vuetify
});