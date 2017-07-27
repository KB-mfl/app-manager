<template>
  <div id="app">
    <router-view></router-view>
    <AddnewApp></AddnewApp>
    <Appdownload></Appdownload>
    <GetAppList class="applist"></GetAppList>
  </div>
</template>

<script>
import AddnewApp from './components/AddnewApp'
import Appdownload from './components/Appdownload'
import GetAppList from './components/GetAppList'
export default {
  name: 'app',
  components: {
    AddnewApp,
    Appdownload,
    GetAppList
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
</style>
