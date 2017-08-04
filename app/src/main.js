// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router/index'
import store from './store'
import iView from 'iview'
import 'iview/dist/styles/iview.css'
import Router from 'vue-router'

Vue.use(iView)
Vue.use(Router)

Vue.config.productionTip = false

import axios from 'axios'
axios.defaults.baseURL = '/api/'
Vue.$http = Vue.prototype.$http = axios

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  components: { App }
})
