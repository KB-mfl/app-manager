<template>
  <div class="navbar">
    <div class="buttons">
      <div class="home">
        <button name="home" @click="Home"><span>Home</span></button>
      </div>
      <div class="applist" v-if="this.state ==='true'">
        <button name="applist" @click="Applist"><span>我的应用</span></button>
      </div>
      <div class="appname" v-if="this.appname !== ''">
        <button name="appname" v-bind:appname="appname"><span>{{appname}}</span></button>
      </div>
      <div class="system" v-if="this.system !== ''">
        <button name="system" v-bind:system="system">{{system}}</button>
      </div>
      <div v-if="this.state === 'true'" class="logout">
        <button name="logout" @click="Logout"><span>退出</span></button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'navbar',
  data () {
    return {
      appname: this.appname,
      system: this.system
    }
  },
  beforeMount: function () {
    this.state = sessionStorage.state
    this.appname = sessionStorage.appname
    this.system = sessionStorage.system
  },
  methods: {
    Home: function () {
      sessionStorage.appname = ''
      sessionStorage.system = ''
      this.$router.push({path: '/'})
    },
    Applist: function () {
      sessionStorage.appname = ''
      sessionStorage.system = ''
      this.$router.push({path: '/Applist'})
    },
    Logout: function () {
      sessionStorage.state = ''
      sessionStorage.username = ''
      sessionStorage.apiToken = ''
      sessionStorage.appname = ''
      sessionStorage.system = ''
      console.log(sessionStorage)
      this.$router.push({path: '/Login'})
    }
  }
}
</script>

<style scoped>
.navbar{
  height: 55px;
  width: 100%;
  background-color: #F4F4F4;
  -webkit-animation: shownav 4s;
  -webkit-animation-delay: -1s;
}

@-webkit-keyframes shownav{
  0% {opacity: 0;}
  12.5% {opacity: 0;}
  25% {opacity: 0;}
  100% {opacity: 1;}
}

.home{
  display: inline-block;
  height: auto;
  width: auto;
  float: left;
  margin-left: 10%;
}

.applist{
  display: inline-block;
  height: auto;
  width: auto;
  float: left;
}

.appname{
  display: inline-block;
  height: auto;
  width: auto;
  float: left;
}

.system{
  display: inline-block;
  height: auto;
  width: auto;
  float: left;
}

.logout{
  display: inline-block;
  height: auto;
  width: auto;
  float: right;
  margin-right: 10%;
}

.buttons{
  width: 100%;
  height: auto;
}

button{
  display: inline-block;
  border-radius: 4px;
  background-color: #F4F4F4;
  border: none;
  color: #2257c9;
  text-align: center;
  font-size: 20px;
  padding: 10px;
  width: auto;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  outline: none;
  text-transform: Capitalize;
}

button span{
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

button span:after{
  content: '»';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

button:hover span{
  padding-right: 25px;
}

button:hover span:after{
  opacity: 1;
  right: 0;
}

button:focus span{
  padding-right: 25px;
}

button:focus span:after{
  opacity: 1;
  right: 0;
}
</style>
