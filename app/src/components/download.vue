<template>
  <div class="download">
    <h1>{{system}}</h1>
    <div id="button">Download now!</div>
  </div>
</template>

<script>
export default {
  name: 'download',
  data () {
    return {
      system: '您当前的操作系统是：' + navigator.platform
    }
  }
}
</script>

<style scoped>
.download{
  margin-top: 150px;
  width: 80%;
  height: 500px;
  margin-left: 10%;
}
#button{
  margin: 0 auto;
  margin-top: 50px;
  width: 500px;
  height: 80px;
  font-size: 60px;
  line-height: 80px;
  border: solid 2px black;
  border-radius: 40px;
}
#button:hover{
  background-color: #2ab27b;
  opacity: 1;
  color: #ffffff;
}
</style>
