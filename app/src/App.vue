<template>
  <div id="app">
    <iTitle></iTitle>
    <ul>
      <li v-on:click="show1()">App列表</li>
      <li v-on:click="show2()">上传</li>
      <li v-on:click="show3()">历史版本</li>
      <li v-on:click="show4()">下载</li>
    </ul>
    <hr>
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
    <Applist v-if="isshow1"></Applist>
    <Historylist v-if="isshow3"></Historylist>
    <download v-if="isshow4"></download>
  </div>
</template>

<script>
import Applist from './components/GetAppList'
import iTitle from './components/Title'
import download from './components/download'
import Historylist from './components/AppHistoryList'
export default {
  name: 'app',
  components: {
    iTitle,
    download,
    Applist,
    Historylist
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
  }
}
</script>

<style scoped>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 20px;
  height: auto;
}

#app ul{
  list-style: none;
  width: 100%;
}

#app li{
  width: 300px;
  font-size: 40px;
  display: inline-block;
}

#app li:hover{
  color: #ffffff;
  background-color: #2ab27b;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  cursor: pointer;
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
  margin-top: 20px;
}
</style>
