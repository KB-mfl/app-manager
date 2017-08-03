<template>
  <div id="app">
    <router-view></router-view>
    <AddnewApp></AddnewApp>
    <Download></Download>
  </div>
</template>

<script>
import Download from './components/Appdownload'
import AddnewApp from './components/AddnewApp'
export default {
  name: 'app',
  components: {
    AddnewApp,
    Download
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
