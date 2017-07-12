// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import FastClick from 'fastclick'
import VueRouter from 'vue-router'
import App from './App'
import HomeIndex from './views/home/index'
import HomeMap from './views/home/map'
import CustomerIndex from './views/customer/index'
import CustomerEdit from './views/customer/edit'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: HomeMap
    },
    {
        path: '/home/index',
        component: HomeIndex
    },
    {
        path: '/customer/index',
        component: CustomerIndex
    },
    {
        path: '/customer/edit',
        component: CustomerEdit
    }
]

global.http_url = 'http://7t-web.com';


const router = new VueRouter({
  routes
})

FastClick.attach(document.body)

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  router,
  render: h => h(App)
}).$mount('#app-box')
