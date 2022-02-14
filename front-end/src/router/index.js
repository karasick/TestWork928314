import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home'
import Post from '../views/Post'
import Login from '../views/Auth/Login'
import Registration from '../views/Auth/Registration'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path: '/login',
    name: 'login',
    component: Login
  },
  {
    path: '/register',
    name: 'registration',
    component: Registration
  },
  {
    path: '/posts',
    name: 'posts',
    component: Home
  },
  {
    path: '/posts/:id',
    name: 'post',
    component: Post,
    props: true
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
