<template>
  <div class="title">
    <img id="img" src="../assets/Logo-1.png" alt="logo">
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
  height: 320px;
  border-bottom: 2px solid black;
}

#img{
  width: 200px;
  height: 200px;
  display: inline-block;
}

.title h1{
  font-size: 90px;
  margin-left: 5%;
  display: inline-block;
}

.title p{
  margin-top: 60px;
  font-size: 30px;
}
</style>
