<template>
  <div class="title">
    <div id="img"></div>
    <h1>{{system}}</h1>
    <p>{{version}}</p>
  </div>
</template>
<script>
export default {
  name: 'title',
  data () {
    return {
      system: '后台管理系统',
      version: 'v1.0.0.1'
    }
  }
}
</script>
<style>
  #title{
    width: 100%;
    height: 400px;
  }
  #img{
    width: 200px;
    height: 200px;
    border-radius: 200px;
  }
</style>
