<template>
  <div class="register">
    <Navbar></Navbar>
    <div class="title">
      <span>注册</span>
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
        <p><button class="btn-register" type="submit" name="register" @click="Register($event)">注册</button></p>
        <p><button class="btn-register-to-login" type="submit" name="to-login" @click="Tologin">已有账号，登陆</button></p>
      </form>
    </div>
  </div>
</template>

<script>
import Navbar from './Navbar'
export default {
  name: 'register',
  components: {
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
  methods: {
    Register (event) {
      event.preventDefault()
      let formData = new FormData()
      formData.append('username', this.Username)
      formData.append('password', this.Password)
      let config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
      this.$http.post('/register', formData, config)
      .then((response) => {
        this.State = response.data
        console.log(this.State)
      })
      .catch(function (error) {
        console.log(error)
        alert('用户名已被注册,请跟换用户名后重试')
      })
    },
    Inputback: function () {
      this.IsActive = true
    },
    Tologin: function () {
      this.$router.push({path: '/Login'})
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

.btn-register{
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

.btn-register:hover{
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

.btn-register-to-login{
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

.btn-register-to-login:hover{
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
  text-align: center;
  vertical-align: middle;
  caret-color: #66ccff;
  color: #A2A3A2;
}

.input-default:focus{
  width: 80%;
  font-size: 15px;
  border-left: 0px;
  border-right: 0px;
  border-top: 2px solid;
  border-bottom: 2px solid;
  border-color: #66ccff;
  outline: none;
  text-align: center;
  vertical-align: middle;
  caret-color: #66ccff;
  color: #A2A3A2;
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
  outline: none;
  text-align: center;
  vertical-align: middle;
  caret-color: #66ccff;
  color: #A2A3A2;
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
