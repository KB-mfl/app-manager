<template>
  <div id="app">
<<<<<<< HEAD
    <Title></Title>
    <ul>
      <li v-on:click="show1()">下载</li>
      <li v-on:click="show2()">上传</li>
      <li v-on:click="show3()">版本/历史</li>
      <li v-on:click="show4()">图片</li>
    </ul>
    <Carousel autoplay v-model="value2" id="welcome" v-if="show">
      <Carousel-item>
        <div class="demo-carousel">1</div>
      </Carousel-item>
      <Carousel-item>
        <div class="demo-carousel">2</div>
      </Carousel-item>
      <Carousel-item>
        <div class="demo-carousel">3</div>
      </Carousel-item>
      <Carousel-item>
        <div class="demo-carousel">4</div>
      </Carousel-item>
    </Carousel>
    <download v-if="isshow1"></download>
    <upload v-if="isshow2"></upload>
    <version v-if="isshow3"></version>
    <appPicture v-if="isshow4"></appPicture>
=======
    <router-view></router-view>
    <appinfolist></appinfolist>
    <AddnewApp></AddnewApp>
    <uploadnewapp></uploadnewapp>
>>>>>>> 888f5d30fbd3dda76054d7a541e46c206bbf3d95
  </div>
</template>

<script>
<<<<<<< HEAD
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
      value2: 0,
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
=======
import appinfolist from './components/GetAppList'
import AddnewApp from './components/AddnewApp'
import uploadnewapp from './components/Uploadnewver'
export default {
  name: 'app',
  components: {
    AddnewApp,
    appinfolist,
    uploadnewapp
>>>>>>> 888f5d30fbd3dda76054d7a541e46c206bbf3d95
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
<<<<<<< HEAD
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
.demo-carousel{
  margin: 0 auto;
  height: 500px;
  width: 80%;
  background-color: #2ab27b;
  font-size: 200px;
}
#welcome{
  margin-left: 10%;
  width: 80%;
  margin-top: 200px;


=======

.applist{
  position: relative;
  top: 50px;
}

.historylist{
  position: relative;
  top: 80px;
>>>>>>> 888f5d30fbd3dda76054d7a541e46c206bbf3d95
}
</style>
