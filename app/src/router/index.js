import Vue from 'vue'
import Router from 'vue-router'
import Applist from '../components/GetAppList'
import Home from '../components/Home'
import Systemlist from '../components/AppsystemList'
import Feedback from '../components/Feedback'
import Versionlist from '../components/VersionList'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/Applist',
      name: 'Applist',
      component: Applist
    },
    {
      path: '/Applist/:id/Systemlist',
      name: 'Systemlist',
      component: Systemlist
    },
    {
      path: '/Applist/:id/Systemlist/:systemid/Versionlist',
      name: 'Versionlist',
      component: Versionlist
    },
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '/Feedback',
      name: 'Feedback',
      component: Feedback
    }
  ]
})
