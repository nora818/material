import Vue from "vue"
import VueRouter from "vue-router"

import Home from "@/views/home"
import Material from "@/views/material/List"
import Score from "@/views/score"
import Comment from "@/views/comment"
import Login from "@/views/user/Login"
import Register from "@/views/user/Register"
import Profile from "@/views/user/Profile"
import About from "@/views/About"

// 安装路由
Vue.use(VueRouter)

// 配置路由
const router = new VueRouter({
    routes: [
        {
            path: "/",
            redirect: "/home",
        },
        {
            path: "/home",
            name: "Home",
            component: Home
        },
        {
            path: "/material",
            name: "Material",
            component: Material
        },
        {
            path: "/score",
            name: "Score",
            meta: { auth: true },
            component: Score
        },
        {
            path: "/shequ",
            name: "Comment",
            component: Comment
        },
        {
            path: "/login",
            name: "Login",
            component: Login
        },
        {
            path: "/register",
            name: "Register",
            component: Register
        },
        {
            path: "/profile",
            name: "Profile",
            meta: { auth: true },
            component: Profile
        },
        {
            path: "/about",
            name: "About",
            component: About
        },
        {
            path: "/contact",
            name: "Contact",
            component: () => import('@/views/Contact')
        },
        {
            path: "/help",
            name: "Help",
            component: () => import('@/views/Help')
        },
        {
            path: "/link",
            name: "Link",
            component: () => import('@/views/Link')
        },
        {
            path: '/404',
            name: 'NotFound',
            meta: {
              title: 'Page not found',
            },
            component: () => import('@/views/NotFound')
          },
        // 所有未定义路由，全部重定向到404页
        {
            path: '*',
            redirect: '/404'
        }
    ]
})

// 导航守卫 全局
// 会在路由跳转前执行
router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token')

    if ((to.matched.some(record => record.meta.auth) && !token)) {
        next({ name: 'Login' })
    } else if (to.name == 'Login' && token) {
        next("/")
    } else {
        next()
    }
})

export default router