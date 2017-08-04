<template>
  <div id="app">
    <router-view></router-view>
    <appinfolist></appinfolist>
    <AddnewApp></AddnewApp>
    <uploadnewapp></uploadnewapp>
  </div>
</template>

<script>
import appinfolist from './components/GetAppList'
import AddnewApp from './components/AddnewApp'
import uploadnewapp from './components/Uploadnewver'
export default {
  name: 'app',
  components: {
    AddnewApp,
    appinfolist,
    uploadnewapp
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

.applist{
  position: relative;
  top: 50px;
}

.historylist{
  position: relative;
  top: 80px;
}
</style>
