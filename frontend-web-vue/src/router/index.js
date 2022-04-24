import Vue from 'vue'
import VueRouter from 'vue-router'
// import Home from '../views/Home.vue'
import DonasiViews from '../views/donasisaya/DonasiViews.vue'
import DonasiDetailViews from '../views/donasisaya/DetailDonasiViews.vue'
import store from '../store'

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
    component: () => import('../views/beranda/campaign/CampaignDetailResumeViews.vue'),
    meta: {
      auth: true
    }
  },
  {
    path: '/campaign/:invoice/confirm',
    name: 'Campaign Confirm',
    component: () => import('../views/beranda/campaign/CampaignDetailConfirmViews.vue'),
    meta: {
      auth: true
    }
  },

  // funding
  {
    path: '/myfunding',
    name: 'Funding History',
    component: DonasiViews,
    meta: {
      auth: true
    }
  },
  {
    path: '/myfunding/:id_funding',
    name: 'Funding Detail History',
    component: DonasiDetailViews,
    meta: {
      auth: true
    }
  },

  // akun
  {
    path: '/account',
    name: 'Account',
    component: () => import('../views/akun/AkunComponentViews.vue'),
    meta: {
      auth: true
    }
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

router.beforeEach((to, from, next) => {
  // cek the page ada meta nya apa engga
  if (to.matched.some(record => record.meta.auth)) {
    store.commit('validateUser');
    // cek di local storage,
    if (!localStorage.getItem("token")) {
      next({
        path: "/auth/login",
        params: {
          loginSugested: "Anda harus Login untuk mengakses fitur ini!"
        }
      });
    } else {
      next();
    }
  } else {
    next();
  }

  if (to.path == "/auth/login") {
    if (localStorage.getItem("token")) {
      next("/");
    } else {
      next();
    }
  }

  // this.$store.dispatch("refreshToken");

});




export default router
