import Vue from 'vue'
import Router from 'vue-router'
import Applist from '../components/GetAppList'
import Home from '../components/Home'
import Systemlist from '../components/AppsystemList'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/Applist',
      name: 'Applist',
      component: Applist,
      children: [
        {
          path: '/Applist/:id/Systemlist',
          name: 'Systemlist',
          component: Systemlist
        }
      ]
    },
    {
      path: '/',
      name: 'Home',
      component: Home
    }
  ]
})
