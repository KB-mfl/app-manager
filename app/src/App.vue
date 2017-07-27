<template>
  <div id="app">
    <Title></Title>
    <mycontent></mycontent>
  </div>
</template>

<script>
import Title from './components/Title'
import mycontent from './components/mycontent'
export default {
  name: 'app',
  components: {
    Title,
    mycontent
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
