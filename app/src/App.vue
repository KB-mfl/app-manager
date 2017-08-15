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
  margin: 0px;
  height: auto;
}

.ilink{
  color: #2c3e50;
  width: 64%;
  font-size: 40px;
  display: inline-block;
}

.ilink:hover{
  color: #ffffff;
  background-color: #5e79e6;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
}

.main{
  width: 100%;
  height: auto;
}
</style>
