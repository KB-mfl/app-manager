<template>
  <div id="app">
    <iTitle></iTitle>
    <div class="main">
      <router-view></router-view>
    </div>
    <iFooter></iFooter>
  </div>
</template>

<script>
import iTitle from './components/Title'
import iFooter from './components/Footer'
export default {
  name: 'app',
  components: {
    iFooter,
    iTitle
  },
  data () {
    return {
    }
  },
  methods: {
  }
}
</script>

<style scoped>
#app{
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin: 0;
  height: auto;
}

.main{
  width: 100%;
  height: auto;
}
</style>
