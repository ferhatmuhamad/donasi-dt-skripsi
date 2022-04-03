import Vue from 'vue'
import VueRouter from 'vue-router'
// import Home from '../views/Home.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import('../views/beranda/BerandaViews.vue'),
  },


  // auth
  {
    path: '/auth/login',
    name: 'Login',
    component: () => import('../views/auth/LoginViews.vue')
  },
  {
    path: '/auth/register',
    name: 'Register',
    component: () => import('../views/auth/RegisterViews.vue')
  },
  {
    path: '/auth/forgotpassword',
    name: 'Forgot Password',
    component: () => import('../views/auth/ForgetPasswordViews.vue')
  },
  {
    path: '/auth/forgotpassword/confirmation/:token',
    name: 'Forgot Password Confirmation',
    component: () => import('../views/auth/ForgetPasswordConfirmationViews.vue')
  },


  // campaign detail
  {
    path: '/campaign/:slug',
    name: 'Campaign Detail',
    component: () => import('../views/beranda/campaign/CampaignDetailViews.vue')
  },
  {
    path: '/campaign/:slug/fund',
    name: 'Campaign Resume',
    component: () => import('../views/beranda/campaign/CampaignDetailResumeViews.vue')
  },
  {
    path: '/campaign/:invoice/confirm',
    name: 'Campaign Confirm',
    component: () => import('../views/beranda/campaign/CampaignDetailConfirmViews.vue')
  },

  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
