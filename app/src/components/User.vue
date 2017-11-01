<template>
  <div class="user">
    <div class="title">
      <span>{{appname}}</span>
    </div>
    <div class="maincontent">
      <div class="info">
        <div v-if="platform === 'Android'" class="logo">
          <img :src="'/api/image/' + logo_url">
        </div>
        <div v-if="platform === 'IOS'" class="logo">
          <img :src="logo">
        </div>
        <div class="version">
          <p>{{version}}</p>
        </div>
        <div class="size">
          <p>{{size}}MB</p>
        </div>
        <div class="platform">
          <p>{{platform}}</p>
        </div>
      </div>
      <div class="introduction">
        <p>Description</p>
        <div class="description">
          <textarea class="input-default-introduction" name="description" maxlength="3000" rows="15" readonly>{{description}}</textarea>
        </div>
        <br>
        <p>Log</p>
        <div class="log">
          <textarea class="input-default-introduction" name="log" maxlength="3000" rows="15" readonly>{{log}}</textarea>
        </div>
      </div>
    </div>
    <div v-if="platform !== 'IOS'" class="download">
      <form id="download" action="/api/download" method="get">
        <input type="hidden" name="version_id" v-model="version_id"></input>
        <button class="btn-download" @click="Download"><span>Download Now !!!</span></button>
      </form>
    </div>
    <div v-if="platform === 'IOS'" class="download">
        <a class="btn-download" :href="itunes_url"><span>Download Now !!!</span></a>
    </div>
    <div class="switch">
      <button class="btn-comment" @click="CreateNewFeedback">Comment</button>
      <button class="btn-back" type="button" name="back" @click="Back">Back</button>
      <span>下载其他版本：</span>
      <button class="btn-switch" v-if="platform !== 'IOS'" name="IOS" @click="Toios">IOS</button>
      <button class="btn-switch" v-if="platform !== 'Android'" name="Android" @click="Toandroid">Android</button>
    </div>
    <div class="">

    </div>
    <div class="comments">
      <table>
        <thead>
          <tr>
            <th>Comments</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="row in Feedback">
            <td>
              <div class="name">
                <p>{{row.name}}</p>
              </div>
              <div class="fdtitle">
                <p>{{row.title}}</p>
              </div>
              <textarea class="input-default-reply" name="contents" rows="3" cols="60" readonly>{{row.contents}}</textarea>
              <p class="time">{{row.created_at}}</p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="back_ground"  v-show="IsShowNewFeedback">
    </div>
    <div class="container" v-show="IsShowNewFeedback" @click="Inputback">
      <div class="create">
        <p class="close-p"><button class="close" type="button" name="colse" @click="Close"><Icon type="close-round" size="12"></Icon></button></p>
        <div class="upload">
          <form class="uploader">
            <div class="inputer">
              <p><input v-model="Feedbackid" type="hidden" name="feedback_id"></p>
              <p class="input-p">Name</p>
              <p><input class="input-default" v-bind:class="{inputback: IsActive }" v-model="Name" type="text" name="name"></p>
              <p class="input-p">Phone</p>
              <p><input class="input-default" v-bind:class="{inputback: IsActive }" v-model="Phone" type="text" name="phone"></p>
              <p class="input-p">Email</p>
              <p><input class="input-default" v-bind:class="{inputback: IsActive }" v-model="Email" type="text" name="email"></p>
              <p class="input-p">Title</p>
              <p><input class="input-default" v-bind:class="{inputback: IsActive }" v-model="Title" type="text" name="title"></p>
              <p class="input-p">Contents</p>
              <p><textarea class="input-default-feedback" v-model="Contents" name="contents" maxlength="150" placeholder="~限150字~"></textarea></p>
            </div>
            <br>
            <button class="btn-submit" type="submit" @click="UploadForm($event)">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from 'moment'
export default {
  name: 'user',
  data () {
    return {
      content: [],
      Ios: [],
      allversion: [],
      logo_url: '',
      logo: '',
      version_id: '',
      version: '无最新版本',
      itunes_url: '',
      appname: '',
      app_id: '',
      log: '',
      description: '',
      size: '',
      Feedback: [],
      Feedbackid: '',
      Name: '',
      Phone: '',
      Email: '',
      Title: '',
      Contents: '',
      platform: this.$route.params.system,
      IsShowNewFeedback: false,
      IsActive: true
    }
  },
  beforeMount: function () {
    this.Getlatestversion()
  },
  methods: {
    Getlatestversion: function () {
      this.$http.get('version', {params: {app_name: this.$route.params.appname}})
      .then((response) => {
        this.content = response.data
        this.appname = this.content.app_name
        this.app_id = this.content.app_id
        console.log(this.content)
        this.GetFeedbackList()
        if (this.platform === 'Android') {
          this.GetAndroid()
          this.GetAndroidversion()
        } else {
          this.GetIOS()
        }
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    GetAndroid: function () {
      this.$http.get('app/' + this.app_id, {params: {apiToken: this.apiToken, username: this.username, limit: 1}})
      .then((response) => {
        this.logo_url = response.data.android.logo
        console.log(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    GetAndroidversion: function () {
      this.$http.get('app/' + this.app_id + '/version', {params: {apiToken: this.apiToken, username: this.username, limit: 1}})
      .then((response) => {
        this.allversion = response.data[0]
        this.log = this.allversion.log
        this.description = this.allversion.description
        this.version = this.allversion.version
        this.version_id = this.allversion.version_id
        this.size = ((this.allversion.size / 1000000).toFixed(2))
        console.log(this.allversion)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    GetIOS: function () {
      this.$http.get('app/' + this.app_id, {params: {apiToken: this.apiToken, username: this.username}})
      .then((response) => {
        this.Ios = response.data.ios
        this.log = this.Ios.log
        this.description = this.Ios.description
        this.version = this.Ios.version
        this.size = ((this.Ios.size / 1000000).toFixed(2))
        this.itunes_url = this.Ios.itunes_url
        this.logo = this.Ios.logo
        console.log(this.Ios)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    GetFeedbackList: function () {
      this.$http.get('app/' + this.app_id + '/feedback')
      .then((response) => {
        this.Feedback = response.data
        let i = 0
        for (i = 0; i < this.Feedback.length; i++) {
          this.Feedback[i].created_at = moment.unix(this.Feedback[i].created_at).format('YYYY-MM-DD HH:mm:ss')
        }
        console.log(this.Feedback)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    Download: function () {
      this.version_id = this.allversion.version_id
      document.getElementById('download').submit()
    },
    Toios: function () {
      this.version = '无最新版本'
      this.platform = 'IOS'
      this.$router.push({path: '/' + this.$route.params.appname + '/' + this.platform})
      this.$http.get('app/' + this.app_id, {params: {apiToken: this.apiToken, username: this.username}})
      .then((response) => {
        this.Ios = response.data.ios
        this.log = this.Ios.log
        this.description = this.Ios.description
        this.version = this.Ios.version
        this.size = ((this.Ios.size / 1000000).toFixed(2))
        this.itunes_url = this.Ios.itunes_url
        console.log(this.Ios)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    Toandroid: function () {
      this.version = '无最新版本'
      this.platform = 'Android'
      this.$router.push({path: '/' + this.$route.params.appname + '/' + this.platform})
      this.$http.get('version', {params: {app_name: this.$route.params.appname}})
      .then((response) => {
        this.content = response.data
        this.logo_url = this.content.logo_url
        this.appname = this.content.app_name
        this.app_id = this.content.version.app_id
        this.GetVersionList()
        console.log(this.content)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    CreateNewFeedback: function () {
      this.IsShowNewFeedback = true
    },
    Close: function () {
      this.IsShowNewFeedback = false
    },
    UploadForm (event) {
      event.preventDefault()
      let formData = new FormData()
      formData.append('name', this.Name)
      formData.append('phone', this.Phone)
      formData.append('email', this.Email)
      formData.append('title', this.Title)
      formData.append('feedback_id', this.Feedbackid)
      formData.append('contents', this.Contents)
      formData.append('username', this.username)
      formData.append('apiToken', this.apiToken)
      let config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
      this.$http.post('app/' + this.app_id + '/feedback', formData, config)
      .then((response) => {
        this.$http.get('app/' + this.app_id + '/feedback')
        .then((response) => {
          this.Feedback = response.data
          let i = 0
          for (i = 0; i < this.Feedback.length; i++) {
            this.Feedback[i].created_at = moment.unix(this.Feedback[i].created_at).format('YYYY-MM-DD HH:mm:ss')
          }
          console.log(this.Feedback)
        })
        .catch(function (error) {
          console.log(error)
        })
      })
      .catch(function (error) {
        console.log(error)
      })
      this.IsShowNewFeedback = false
    },
    Back: function () {
      this.$router.push({path: '/'})
    },
    Inputback: function () {
      this.IsActive = true
    }
  }
}
</script>

<style scoped>
.user{
  height: 100%;
  width: 100%;
}

.maincontent{
  width: 80%;
  height: auto;
  display: inline-block;
  margin: 0px auto;
}

.info{
  float: left;
  width: 30%;
  height: auto;
  margin: 0px;
}

.introduction{
  float: left;
  width: 70%;
  height: auto;
  margin: 0px;
  text-align: left;
}

.introduction p{
  font-size: 20px;
  color: #2257c9;
  word-wrap: break-all;
}

.input-default-introduction{
  margin-top: 2%;
  width: 100%;
  height: auto;
  font-size: 15px;
  border: 0px;
  color: #A2A3A2;
  vertical-align: middle;
  outline: none;
  resize: none;
  word-wrap: break-all;
}

table tr:nth-child(odd) .input-default-reply{
  width:90%;
  height: 170px;
  font-size: 15px;
  border: 0px;
  color: #73C5FF;
  background-color: #FFF;
  vertical-align: middle;
  outline: none;
  resize: none;
}

table tr:nth-child(even) .input-default-reply{
  width: 90%;
  height: 170px;
  font-size: 15px;
  border: 0px;
  color: #FFF;
  background-color: #73C5FF;
  vertical-align: middle;
  outline: none;
  resize: none;
}

.logo{
  outline: none;
  height: auto;
  width: auto;
  margin: 0px auto;
}

img{
  margin: 0px auto;
  width: 150px;
  height: 150px;
  border-radius: 50%;
  border: 1px solid #66ccff;
  outline:none;
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
  font-size: 12px;
  color: #2257c9;
  font-family: Verdana;
}

.size{
  margin: 0 auto;
  font-size: 12px;
  color: #2257c9;
  font-family: Verdana;
}

.platform{
  margin: 0 auto;
  font-size: 15px;
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
  margin-left: 0;
}

.name{
  width: 100%;
  height: auto;
  margin: 0px;
  font-size: 15px;
  text-align: left;
}

.time{
  width: 100%;
  height: auto;
  margin: 0px;
  font-size: 10px;
  text-align: right;
}

.fdtitle{
  width: 100%;
  height: auto;
  margin-top: 0px;
  font-size: 12px;
  text-align: left;
}

.btn-download{
  display: inline-block;
  border-radius: 5px;
  background-color: #FFF;
  border: none;
  color: #73C5FF;
  text-align: center;
  font-size: 25px;
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
  font-size: 25px;
  padding: 10px;
  width: auto;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  outline: none;
  border: 1px solid;
  border-color: #73C5FF;
}

.btn-switch{
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

.btn-switch:hover{
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

.btn-back{
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

.btn-back:hover{
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

.btn-comment{
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

.btn-comment:hover{
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

.btn-submit{
  display: inline-block;
  border-radius: 4px;
  background-color: #2257c9;
  border: none;
  color: #FFF;
  text-align: center;
  font-size: 15px;
  padding: 10px;
  width: auto;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  border: 1px solid;
  border-color: #2257c9;
}

.btn-submit:hover{
  display: inline-block;
  border-radius: 4px;
  background-color: #FFF;
  border: none;
  color: #2257c9;
  text-align: center;
  font-size: 15px;
  padding: 10px;
  width: auto;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  border: 1px solid;
  border-color: #2257c9;
}

/*-----创建-----*/
.back_ground{
  height: 100%;
  width: 100%;
  position: fixed;
  top: 0;
  left: 0;
  background-color: #000000;
  opacity: 0.5;
}

.container{
  height: 100%;
  width: 100%;
  position: fixed;
  top: 0;
  left: 0;
}

.create{
  position: fixed;
  height: auto;
  width: 30%;
  left:35%;
  top:8%;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  background-color: #ffffff;
}

.create p{
  height: auto;
}

.close{
  margin: 1% 0 1% 92%;
  background: #efeeee;
  padding: 2px 7px;
  color: #333;
  border: 0;
  border-radius: 50%;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  cursor: pointer;
}

.close-p{
  background-color: #2257c9;
}

.close:hover{
  -webkit-animation: close 2s;
  background-color: #5e79e6;
}

@-webkit-keyframes close{
  0% {-webkit-transform:rotate(0deg);transform:rotate(0deg);}
  12.5% {-webkit-transform:rotate(90deg);transform:rotate(90deg);}
  25% {-webkit-transform:rotate(180deg);transform:rotate(180deg);}
  37.5% {-webkit-transform:rotate(270deg);transform:rotate(270deg);}
  50% {-webkit-transform:rotate(360deg);transform:rotate(360deg);}
  62.5% {-webkit-transform:rotate(270deg);transform:rotate(270deg);}
  75% {-webkit-transform:rotate(180deg);transform:rotate(180deg);}
  87.5% {-webkit-transform:rotate(90deg);transform:rotate(90deg);}
  100% {-webkit-transform:rotate(0deg);transform:rotate(0deg);}
}

.upload{
  height: auto;
  width: auto;
  margin-top: 4%;
}

.uploader{
  border: 0px;
  width: 30% auto;
  height: auto;
  text-align: center;
  margin: 0px auto;
}

/*-----输入框-----*/
.inputer{
  height: auto;
  width: 100%;
  margin-bottom: 5%;
}

.input-p{
  font-size: 20px;
  color: #2257c9;
  margin-bottom: 2%;
  margin-top: 2%;
}

input:-webkit-autofill{
-webkit-box-shadow: 0 0 0px 1000px #FFFFFF inset !important;
-webkit-text-fill-color: #000000;
}

.input-default{
  width: 30%;
  font-size: 15px;
  border-left: 0px;
  border-right: 0px;
  border-top: 2px solid;
  border-bottom: 2px solid;
  border-color: #66ccff;
  caret-color: #66ccff;
  color: #A2A3A2;
  text-align: center;
  vertical-align: middle;
}

.input-default-feedback{
  width: 80%;
  height: 170px;
  font-size: 15px;
  border-left: 1px solid;
  border-right: 1px solid;
  border-top: 1px solid;
  border-bottom: 1px solid;
  border-color: #66ccff;
  caret-color: #66ccff;
  color: #A2A3A2;
  vertical-align: middle;
  outline: none;
  resize: none;
}

.input-default:focus{
  width: 30%;
  font-size: 15px;
  border-left: 0px;
  border-right: 0px;
  border-top: 2px solid;
  border-bottom: 2px solid;
  border-color: #66ccff;
  caret-color: #66ccff;
  color: #A2A3A2;
  text-align: center;
  vertical-align: middle;
  outline: none;
  -webkit-animation: actived 0.5s;
  -webkit-animation-fill-mode: forwards;
}

@-webkit-keyframes actived{
  0% {-webkit-transform:scale(1);transform:scale(1);}
  100% {-webkit-transform:scale(1.5);transform:scale(1.5);}
}

.inputback{
  width: 30%;
  font-size: 15px;
  border-left: 0px;
  border-right: 0px;
  border-top: 2px solid;
  border-bottom: 2px solid;
  border-color: #66ccff;
  caret-color: #66ccff;
  color: #A2A3A2;
  text-align: center;
  vertical-align: middle;
  outline: none;
  -webkit-animation: back 1s;
  -webkit-animation-fill-mode: forwards;
  -webkit-animation-delay: -0.5s;
}

@-webkit-keyframes back{
  0% {-webkit-transform:scale(1);transform:scale(1);}
  50% {-webkit-transform:scale(1.5);transform:scale(1.5);}
  100% {-webkit-transform:scale(1);transform:scale(1);}
}

.comments{
  width: 100%;
  margin-bottom: 20px;
  margin-left: auto;
  margin-right: auto;
}

table thead, table tr {
  border-top-width: 2px;
  border-top-style: solid;
  border-top-color: #2257c9;
}

table {
  width: 80%;
  margin: 0px auto;
  border-bottom-width: 2px;
  border-bottom-style: solid;
  border-bottom-color: #2257c9;
  border-collapse: collapse;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
}

table td{
  text-transform: Capitalize;
  padding: 5px 10px;
  font-size: 15px;
  font-family: Verdana;
}

table th{
  text-transform: Capitalize;
  padding: 5px 10px;
  font-size: 20px;
  font-family: Verdana;
}

table tr:nth-child(even){
  background: #73C5FF;
  color: #FFF;
}

table tr:nth-child(even) button{
  display: inline-block;
  border-radius: 4px;
  background-color: #FFF;
  border: none;
  color: #73C5FF;
  text-align: center;
  font-size: 15px;
  padding: 10px;
  width: auto;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

table tr:nth-child(even) button span{
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

table tr:nth-child(even) button span:after{
  content: '»';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

table tr:nth-child(even) button:hover span{
  padding-right: 25px;
}

table tr:nth-child(even) button:hover span:after{
  opacity: 1;
  right: 0;
}

table tr:nth-child(odd){
  background: #FFF;
  color: #2257c9;
}

table tr:nth-child(odd) button{
  display: inline-block;
  border-radius: 4px;
  background-color: #73C5FF;
  border: none;
  color: #FFF;
  text-align: center;
  font-size: 15px;
  padding: 10px;
  width: auto;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

table tr:nth-child(odd) button span{
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

table tr:nth-child(odd) button span:after{
  content: '»';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

table tr:nth-child(odd) button:hover span{
  padding-right: 25px;
}

table tr:nth-child(odd) button:hover span:after{
  opacity: 1;
  right: 0;
}
</style>
