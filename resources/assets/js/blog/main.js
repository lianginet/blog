/**
 * Created by lianginet on 2016/11/21.
 */

import Vue from 'vue'
import App from './App'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import Element from 'element-ui'
import 'element/lib/theme-default/index.css'

Vue.use(VueRouter)
Vue.use(Element)
Vue.use(VueResource)
Vue.http.options.emulateJSON = true

/**
 * 首页
 */
import Index from './components/Index'
import Categories from './components/Categories'
import Tags from './components/Tags'
import Wiki from './components/Wiki'
import About from './components/About'

const router = new VueRouter({
    mode: 'history',
    base: __dirname,
    routes: [
        {
            path: '/',
            name: 'index',
            component: Index
        },
        {
            path: '/categories',
            name: 'categories',
            component: Categories
        },
        {
            path: '/tags',
            name: 'tags',
            component: Tags
        },
        {
            path: '/wiki',
            name: 'wiki',
            component: Wiki
        },
        {
            path: '/about',
            name: 'about',
            component: About
        }
    ]
})

const app = new Vue(
    Vue.util.extend({ router }, App)
).$mount('#app')