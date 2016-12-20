/**
 * Created by lianginet on 2016/11/21.
 */

import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import Element from 'element-ui'
import 'element/lib/theme-default/index.css'
import 'highlight.js/styles/github-gist.css'

Vue.use(VueRouter)
Vue.use(Element)
Vue.use(VueResource)
Vue.http.options.emulateJSON = true

import Auth from './components/Auth'
import Console from './components/Console'

import EditArticle from './components/articles/Edit'
import Articles from './components/articles/List'
import ShowArticle from './components/articles/Show'

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
                    redirect: 'articles'
                },
                {
                    path: 'articles',
                    component: Articles,
                },
                {
                    path: 'articles/create',
                    name: 'createArticle',
                    component: EditArticle,
                },
                {
                    path: '/articles/:aid/edit',
                    name: 'editArticle',
                    component: EditArticle,
                }
            ]
        },
        {
            path: '/articles/:aid',
            name: 'showArticle',
            component: ShowArticle,
        }
    ]
})

router.beforeEach((to, from, next) => {
    // 判断是否登录
    let storage = window.localStorage
    // if (storage.token && to.path == '/auth') {
    //     console.log('Already logined')
    //     return;
    // }
    // if (!storage.token && to.path != '/auth') {
    //     console.log('Not logined!')
    //     router.push('/auth')
    // } else {
        next()
    // }
})

const app = new Vue({
    router
}).$mount('#app')