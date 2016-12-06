/**
 * Created by lianginet on 2016/11/21.
 */

import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import Element from 'element-ui'
import 'element/lib/theme-default/index.css'

Vue.use(VueRouter)
Vue.use(Element)
Vue.use(VueResource)
Vue.http.options.emulateJSON = true

import Auth from './components/Auth'
import Console from './components/Console'
import Index from './components/dashboard/Index'

import CreateArticle from './components/articles/Create'
import Articles from './components/articles/List'

const router = new VueRouter({
    // mode: 'history',
    base: __dirname,
    routes: [
        {
            path: '/auth',
            component: Auth,
        },
        {
            path: '/',
            component: Console,
            children: [
                {
                    path: '',
                    component: Index
                },
                {
                    path: 'articles',
                    component: Articles,
                },
                {
                    path: 'articles/create',
                    component: CreateArticle,
                }
            ]
        }
    ]
})

router.beforeEach((to, from, next) => {
    // 判断是否登录
    let storage = window.localStorage
    if (storage.user && to.path == '/auth') {
        console.log('Already logined')
        return;
    }
    if (!storage.user && to.path != '/auth') {
        console.log('Not logined')
        router.push('/auth')
    } else {
        next()
    }
})

const app = new Vue({
    router
}).$mount('#app')