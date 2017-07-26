<template>
  <div id="app">
    <router-view></router-view>
    <Uploader></Uploader>
  </div>
</template>

<script>
import Uploader from './components/upload'
export default {
  name: 'app',
  components: {
    Uploader
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
