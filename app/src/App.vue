<template>
  <div id="app">
    <Title></Title>
    <ul>
      <li v-on:click="show1()">下载</li>
      <li v-on:click="show2()">上传</li>
      <li v-on:click="show3()">版本/历史</li>
      <li v-on:click="show4()">图片</li>
    </ul>
    <h1 id="welcome" v-if="show">欢迎来到后台管理系统</h1>
    <download v-if="isshow1"></download>
    <upload v-if="isshow2"></upload>
    <version v-if="isshow3"></version>
    <appPicture v-if="isshow4"></appPicture>
  </div>
</template>

<script>
import Title from './components/Title'

import download from './components/download'
import upload from './components/upload'
import version from './components/version'
import appPicture from './components/appPicture'
export default {
  name: 'app',
  components: {
    Title,
    download,
    upload,
    version,
    appPicture
  },
  data () {
    return {
      show: true,
      isshow1: false,
      isshow2: false,
      isshow3: false,
      isshow4: false
    }
  },
  methods: {
    hide: function () {
      this.isshow1 = false
      this.isshow2 = false
      this.isshow3 = false
      this.isshow4 = false
      this.show = false
    },
    show1: function () {
      this.hide()
      this.isshow1 = true
    },
    show2: function () {
      this.hide()
      this.isshow2 = true
    },
    show3: function () {
      this.hide()
      this.isshow3 = true
    },
    show4: function () {
      this.hide()
      this.isshow4 = true
    }
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
#app ul{
  list-style: none;
  width: 80%;
  margin-left: 20%;
}
#app li{
  font-size: 40px;
  float: left;
  margin-right: 18%;
}
#welcome{
  margin-left: 10%;
  margin-top: 200px;
  font-size: 100px;
  width: 80%;
}
</style>
