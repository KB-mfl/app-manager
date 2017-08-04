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
    height: 400px;
    border-bottom: 2px solid black;
  }
  #img{
    width: 200px;
    height: 200px;
    border-radius: 200px;
    background-color: #2ab27b;
    margin-left: 30%;
    float: left;
    margin-top: 20px;
  }
  .title h1{
    
    float: left;
    font-size: 90px;
    margin-left: 5%;
  }
  .title p{
    float: left;
    margin-top: 100px;
    margin-left: 30%;
    font-size: 30px;
  }
  @media only screen and (max-width: 1870px){
    .title p{
      display: none;
    }
  }
</style>
