import Vue from 'vue'
import Router from 'vue-router'
import Applist from '../components/GetAppList'
import Home from '../components/Home'
import Systemlist from '../components/AppsystemList'
import Feedback from '../components/Feedback'
import Versionlist from '../components/VersionList'
import Data from '../components/Data'
import Firstscreen from '../components/Firstscreen'

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
      path: '/Applist/:id/Feedback',
      name: 'Feedback',
      component: Feedback
    },
    {
      path: '/Applist/:id/Data',
      name: 'Data',
      component: Data
    },
    {
      path: '/Applist/:id/Firstscreen',
      name: 'Firstscreen',
      component: Firstscreen
    }
  ]
})
