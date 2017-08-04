<template>
  <div class="picture">
    <div>
      <img src="../assets/logo.png" height="200" width="200"/>
      <p>这是图片信息</p>
    </div>
  </div>
</template>
<script>
export default {
  name: 'picture'
}
</script>
<style>
  .picture{

    margin: 0 auto;
    margin-top: 100px;
    width: 80%;
    height: 550px;
    border: 2px solid black;

  }
  .picture div{
    float: left;
    margin-left: 5%;
    margin-right: 5%;
  }
  .picture img:hover{
    background-color: black;
    opacity: 0.5;
  }
</style>
