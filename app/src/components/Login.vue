<template>
  <div class="login">
    <iTitle></iTitle>
    <Navbar></Navbar>
    <div class="title">
      <span>登陆</span>
    </div>
    <div class="container" @click="Inputback">
      <form class="uploader">
        <div class="inputer">
          <div class="input-1">
            <p class="input-p">Username</p>
            <p><input class="input-default" v-bind:class="{inputback: IsActive }" type="text" name="username" v-model="Username"></input></p>
          </div>
          <div class="input-2">
            <p class="input-p">Password</p>
            <p><input class="input-default" v-bind:class="{inputback: IsActive }" type="password" name="password" v-model="Password"></input></p>
          </div>
        </div>
        <p><button class="btn-login" type="submit" name="login" @click="Login($event)">登陆</button></p>
        <p><button class="btn-login-to-register" type="submit" name="to-register" @click="Toregister">注册</button></p>
      </form>
    </div>
  </div>
</template>

<script>
import iTitle from './Title'
import Navbar from './Navbar'
export default {
  name: 'login',
  components: {
    iTitle,
    Navbar
  },
  data () {
    return {
      Username: '',
      Password: '',
      State: [],
      IsActive: true
    }
  },
  beforeMount: function () {
    console.log(sessionStorage)
  },
  methods: {
    Login (event) {
      event.preventDefault()
      let formData = new FormData()
      formData.append('username', this.Username)
      formData.append('password', this.Password)
      let config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
      this.$http.post('/login', formData, config)
      .then((response) => {
        this.State = response.data
        sessionStorage.state = this.State.status
        this.state = sessionStorage.state
        sessionStorage.apiToken = this.State.apiToken
        this.apiToken = sessionStorage.apiToken
        sessionStorage.username = this.State.username
        this.username = sessionStorage.username
        sessionStorage.admin = this.State.admin
        this.admin = sessionStorage.admin
        console.log(sessionStorage)
        if (this.state === 'false') {
          alert('密码与用户名不符，请重新输入')
          this.$Loading.error()
        }
        if (this.state === 'true') {
          this.$router.push({path: '/Applist'})
          this.$Loading.finish()
        }
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    Inputback: function () {
      this.IsActive = true
    },
    Toregister: function () {
      this.$router.push({path: '/Register'})
    }
  }
}
</script>

<style scoped>
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

.register{
  width: 100%;
  height: auto;
}

.container{
  width: 50%;
  margin: 100px auto 150px auto;
  height: auto;
  border-right: 2px solid #66ccff;
  border-left: 2px solid #66ccff;
}

.uploader{
  width: 30%;
  height: auto;
  margin: 0px auto;
}

.btn-login{
  display: inline-block;
  border-radius: 4px;
  background-color: #2257c9;
  border: none;
  color: #FFF;
  text-align: center;
  border: 1px solid;
  border-color: #2257c9;
  font-size: 15px;
  padding: 10px;
  width: 90%;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.btn-login:hover{
  display: inline-block;
  border-radius: 4px;
  background-color: #FFF;
  border: none;
  color: #2257c9;
  text-align: center;
  border: 1px solid;
  border-color: #2257c9;
  font-size: 15px;
  padding: 10px;
  width: 90%;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.btn-login-to-register{
  display: inline-block;
  border-radius: 4px;
  background-color: #FFF;
  border: none;
  color: #2257c9;
  text-align: center;
  border: 1px solid;
  border-color: #2257c9;
  font-size: 15px;
  padding: 10px;
  width: 90%;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.btn-login-to-register:hover{
  display: inline-block;
  border-radius: 4px;
  background-color: #2257c9;
  border: none;
  color: #FFF;
  text-align: center;
  border: 1px solid;
  border-color: #2257c9;
  font-size: 15px;
  padding: 10px;
  width: 90%;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.inputer{
  height: auto;
  width: 100%;
  margin-bottom: 5%;
}

input:-webkit-autofill{
-webkit-box-shadow: 0 0 0px 1000px #FFFFFF inset !important;
-webkit-text-fill-color: #000000;
}

.input-1{
  margin-bottom: 30px;
}

.input-2{
  margin-bottom: 30px;
}

.input-p{
  font-size: 30px;
  color: #2257c9;
  margin-bottom: 2%;
}

.input-default{
  width: 80%;
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

.input-default:focus{
  width: 80%;
  font-size: 15px;
  border-left: 0px;
  border-right: 0px;
  border-top: 2px solid;
  border-bottom: 2px solid;
  border-color: #66ccff;
  caret-color: #66ccff;
  color: #A2A3A2;
  outline: none;
  text-align: center;
  vertical-align: middle;
  -webkit-animation: actived 0.5s;
  -webkit-animation-fill-mode: forwards;
}

@-webkit-keyframes actived{
  0% {-webkit-transform:scale(1);transform:scale(1);}
  100% {-webkit-transform:scale(1.5);transform:scale(1.5);}
}

.inputback{
  width: 80%;
  font-size: 15px;
  border-left: 0px;
  border-right: 0px;
  border-top: 2px solid;
  border-bottom: 2px solid;
  border-color: #66ccff;
  caret-color: #66ccff;
  color: #A2A3A2;
  outline: none;
  text-align: center;
  vertical-align: middle;
  -webkit-animation: back 1s;
  -webkit-animation-fill-mode: forwards;
  -webkit-animation-delay: -0.5s;
}

@-webkit-keyframes back{
  0% {-webkit-transform:scale(1);transform:scale(1);}
  50% {-webkit-transform:scale(1.5);transform:scale(1.5);}
  100% {-webkit-transform:scale(1);transform:scale(1);}
}
</style>
