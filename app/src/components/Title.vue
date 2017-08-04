<template>
  <div class="title">
    <div id="img"></div>
    <h1>{{system}}<p>{{version}}</p></h1>
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
.title{
  width: 100%;
  height: 360px;
  border-bottom: 2px solid black;
}

#img{
  width: 200px;
  height: 200px;
  border-radius: 200px;
  background-color: #2ab27b;
  display: inline-block;
  margin-bottom: 2%;
}

.title h1{
  font-size: 90px;
  margin-left: 5%;
  display: inline-block;
}

.title p{
  margin-top: 100px;
  font-size: 30px;
}
</style>
