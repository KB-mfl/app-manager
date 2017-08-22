<template>
  <div class="user">
    <div class="title">
      <span>{{appname}}</span>
    </div>
    <div class="logo">
      <img :src="'/api/image/' + logo_url">
    </div>
    <div class="version">
      <p>{{version}}</p>
    </div>
    <div class="platform">
      <p>{{platform}}</p>
    </div>
    <div v-if="platform !== 'IOS'" class="download">
      <form id="download" action="/api/download" method="get">
        <input type="hidden" name="version_id" v-model="version_id"></input>
        <button class="btn-download" @click="Download"><span>Download Now !!!</span></button>
      </form>
    </div>
    <div v-if="platform === 'IOS'" class="download">
        <a class="btn-download" :href="file_url"><span>Download Now !!!</span></a>
    </div>
    <div class="switch">
      <button type="button" name="back" @click="Back">Back</button>
      <span>下载其他版本：</span>
      <button v-if="platform !== 'IOS' && has_IOS === true" name="IOS" @click="Toios">IOS</button>
      <button v-if="platform !== 'Android' && has_Android === true" name="Android" @click="Toandroid">Android</button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'user',
  data () {
    return {
      content: [],
      logo_url: '',
      version_id: '',
      version: '',
      file_url: '',
      has_Android: '',
      has_IOS: '',
      appname: '',
      platform: this.$route.params.system
    }
  },
  beforeMount: function () {
    this.Getlatestversion()
  },
  methods: {
    Getlatestversion: function () {
      this.$http.get('version', {params: {app_name: this.$route.params.appname, system_name: this.$route.params.system}})
      .then((response) => {
        this.content = response.data
        this.logo_url = this.content.logo_url
        this.version = this.content.version.version
        this.file_url = this.content.version.file_url
        this.appname = this.content.app_name
        this.has_IOS = this.content.has_IOS
        this.has_Android = this.content.has_Android
        console.log(this.content)
      })
      .catch(function (error) {
        console.log(error)
        alert('······该应用内容为空······')
      })
    },
    Download: function () {
      this.version_id = this.content.version.id
      document.getElementById('download').submit()
    },
    Towindows: function () {
      this.version = '无最新版本'
      this.platform = 'Windows'
      this.$router.push({path: '/' + this.$route.params.appname + '/' + this.platform})
      this.$http.get('version', {params: {app_name: this.$route.params.appname, system_name: this.$route.params.system}})
      .then((response) => {
        this.content = response.data
        this.logo_url = this.content.logo_url
        this.version = this.content.version.version
        console.log(this.content)
      })
      .catch(function (error) {
        console.log(error)
        alert('······该应用内容为空······')
      })
    },
    Tomac: function () {
      this.version = '无最新版本'
      this.platform = 'Mac'
      this.$router.push({path: '/' + this.$route.params.appname + '/' + this.platform})
      this.$http.get('version', {params: {app_name: this.$route.params.appname, system_name: this.$route.params.system}})
      .then((response) => {
        this.content = response.data
        this.logo_url = this.content.logo_url
        this.version = this.content.version.version
        console.log(this.content)
      })
      .catch(function (error) {
        console.log(error)
        alert('······该应用内容为空······')
      })
    },
    Toios: function () {
      this.version = '无最新版本'
      this.platform = 'IOS'
      this.$router.push({path: '/' + this.$route.params.appname + '/' + this.platform})
      this.$http.get('version', {params: {app_name: this.$route.params.appname, system_name: this.$route.params.system}})
      .then((response) => {
        this.content = response.data
        this.logo_url = this.content.logo_url
        this.version = this.content.version.version
        console.log(this.content)
      })
      .catch(function (error) {
        console.log(error)
        alert('······该应用内容为空······')
      })
    },
    Toandroid: function () {
      this.version = '无最新版本'
      this.platform = 'Android'
      this.$router.push({path: '/' + this.$route.params.appname + '/' + this.platform})
      this.$http.get('version', {params: {app_name: this.$route.params.appname, system_name: this.$route.params.system}})
      .then((response) => {
        this.content = response.data
        this.logo_url = this.content.logo_url
        this.version = this.content.version.version
        console.log(this.content)
      })
      .catch(function (error) {
        console.log(error)
        alert('······该应用内容为空······')
      })
    },
    Back: function () {
      this.$router.push({path: '/'})
    }
  }
}
</script>

<style scoped>
.user{
  height: 100%;
  width: 100%;
}

img{
  margin: 5% auto 5% auto;
  width: 300px;
  height: 300px;
  border-radius: 50%;
  border: 1px solid #66ccff;
}

img:hover{
  position: relative;
  z-index: 998;
  box-shadow: 2px 2px 16px 0px #66ccff;
  -webkit-animation: Logo 0.5s;
  -webkit-animation-fill-mode: forwards;
}

@-webkit-keyframes Logo{
  0% {-webkit-transform:scale(1);transform:scale(1);}
  100% {-webkit-transform:scale(2);transform:scale(2);}
}

.title{
  width: 90%;
  height: 0px;
  margin: 50px auto;
  border: 1px solid #66ccff;
  background-color: #66ccff;
}

.title span{
  font-size: 30px;
  color: #2257c9;
  display: block;
  width: 10%;
  height: auto;
  margin: 0px auto;
  position:relative;
  top: -23px;
  text-align: center;
  background: #FFF;
}

.version{
  margin: 0 auto;
  font-size: 50px;
  color: #2257c9;
  font-family: Verdana;
}

.platform{
  margin: 3% auto 3% auto;
  font-size: 50px;
  color: #2257c9;
  font-family: Verdana;
}

.switch{
  display: inline-block;
  margin: 2% auto;
  width: 100%;
}

.switch span{
  font-size: 10px;
  margin-left: 5%;
}

.btn-download{
  display: inline-block;
  border-radius: 5px;
  background-color: #FFF;
  border: none;
  color: #73C5FF;
  text-align: center;
  font-size: 80px;
  padding: 10px;
  width: auto;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  outline: none;
  border: 1px solid;
  border-color: #73C5FF;
}

.btn-download:hover{
  display: inline-block;
  border-radius: 5px;
  background-color: #73C5FF;
  border: none;
  color: #FFF;
  text-align: center;
  font-size: 80px;
  padding: 10px;
  width: auto;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  outline: none;
  border: 1px solid;
  border-color: #73C5FF;
}

button{
  display: inline-block;
  border-radius: 4px;
  background-color: #73C5FF;
  border: none;
  color: #FFF;
  text-align: center;
  font-size: 12px;
  padding: 10px;
  width: auto;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  border: 1px solid #73C5FF;
}

button:hover{
  display: inline-block;
  border-radius: 4px;
  background-color: #FFF;
  border: none;
  color: #73C5FF;
  text-align: center;
  font-size: 12px;
  padding: 10px;
  width: auto;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  border: 1px solid #73C5FF;
}
</style>
