<template>
  <div class="upload">{{message}}</div>
</template>
<script>
  export default {
    name: 'upload',
    data () {
      return {
        message: '这是上传界面'
      }
    }
  }
</script>
<style>
  .upload{
    width: 80%;
    height: 500px;
    margin-left: 10%;
    background-color: #2ab27b;
    margin-top: 100px;
    font-size: 100px;
    /*display: none;*/
  }
</style>
