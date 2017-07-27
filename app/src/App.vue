<template>
  <div id="app">
    <router-view></router-view>
    <AddnewApp></AddnewApp>
    <Appdownload></Appdownload>
  </div>
</template>

<script>
import AddnewApp from './components/AddnewApp'
import Appdownload from './components/Appdownload'
export default {
  name: 'app',
  components: {
    AddnewApp,
    Appdownload
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
</style>
