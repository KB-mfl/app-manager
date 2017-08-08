<template>
  <div id="app">
    <router-link class="home" to="/"><iTitle></iTitle></router-link>
    <p>
      <router-link class="ilink" to="/Applist">App列表</router-link>
    </p>
    <hr>
    <router-view></router-view>
    <iFooter></iFooter>
  </div>
</template>

<script>
import iTitle from './components/Title'
import iFooter from './components/Footer'
export default {
  name: 'app',
  components: {
    iTitle,
    iFooter
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
  margin-top: 20px;
  margin-bottom: 0px;
  height: auto;
}

.ilink{
  color: #2c3e50;
  width: 300px;
  font-size: 40px;
  display: inline-block;
}

.ilink:hover{
  color: #ffffff;
  background-color: #2ab27b;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
}

.home{
  color: #2c3e50;
}

.home:hover{
  color: #2ab27b;
}
</style>
