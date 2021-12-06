import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import store from '../store'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
    meta:{
      requiresAuth:true
    }
  },
  {
    path: '/about',
    name: 'About',   
    component: () => import('../views/About.vue'),
    meta:{
      requiresAuth:true
    }
  },
  {
    path: '/login',
    name: 'Login',   
    component: () => import('../views/Login.vue'),
    meta:{
      visitor:true
    }
  },
  {
    path: '/register',
    name: 'Register',   
    component: () => import('../views/Register.vue'),
    meta:{
      requiresAuth:true
    }
  },
  {
    path: '/logOut',
    name: 'LogOut',   
    component: () => import('../views/LogOut.vue'),
    meta:{
      requiresAuth:true
    }
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})
router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {   
    if (!store.getters.loggedIn) {
      next({
        path: '/login',
      })
    } else {
      next()
    }
  } else if (to.matched.some(record => record.meta.visitor)) {   
    if (store.getters.loggedIn) {
      next({
        path: '/',
      })
    } else {
      next()
    }
  } 
  else {
    next()
  }
})
export default router
