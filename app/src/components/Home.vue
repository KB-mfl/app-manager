<template>
  <div id="home">
    <div class="container" id="container">
      <div class="content">
          <p class="p1">管理，</p>
          <p class="p2">就是那么简单</p>
      </div>
      <div class="btns">
        <button id="btn" @click="Tologin">进入管理界面</button>
        <button id="btn2" @click="Tologin">登陆</button>
        <button id="btn3" @click="Toregister">注册</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'home',
  data () {
    return {
    }
  },
  methods: {
    Tologin: function () {
      this.$router.push({path: '/Login'})
    },
    Toregister: function () {
      sessionStorage.username = ''
      sessionStorage.state = ''
      sessionStorage.apiToken = ''
      this.$router.push({path: '/Register'})
    }
  }
}
</script>

<style scoped>
.container{
    width: 100%;
    height: 100%;
    background: url("../assets/home.jpg") fixed center no-repeat;
    background-size: cover;
    position: absolute;
    top: 0px;
    z-index: 999;
}
.content{
    color: #ffffff;
    font-size: 100px;
    margin-top: 10%;
    margin-left: auto;
    margin-right: auto;
}

.p1{
  margin-right: 64%;
}

.p2{
  margin-right: 30%;
}

.btns{
  width: 100%;
  height:auto;
  margin-top: 2%;
}

#btn{
    width: auto;
    height: auto;
    padding: 5px 10px;
    border-radius: 25px;
    margin-top: 2%;
    display: inline-block;
    color: #FFF;
    background-color: transparent;
    border: 0px;
    font-size: 30px;
    cursor: pointer;
}

#btn:hover{
    background-color: darkgrey;
}

#btn2{
    width: auto;
    height: auto;
    padding: 5px 10px;
    border-radius: 25px;
    border: 0 0 2 0px solid #;
    margin-top: 2%;
    display: inline-block;
    color: #FFF;
    background-color: transparent;
    border: 0px;
    font-size: 30px;
    margin-left: 10%;
    cursor: pointer;
}

#btn2:hover{
    background-color: darkgrey;
}

#btn3{
    width: auto;
    height: auto;
    padding: 5px 10px;
    border-radius: 25px;
    border: 0 0 2 0px solid #;
    margin-top: 2%;
    display: inline-block;
    color: #FFF;
    background-color: transparent;
    border: 0px;
    font-size: 30px;
    margin-right: 30%;
    margin-left: 5%;
    cursor: pointer;
}

#btn3:hover{
    background-color: darkgrey;
}
</style>
