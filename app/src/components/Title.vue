<template>
  <div class="iTitle">
    <div v-bind:class="{title: isActive}"></div>
    <div class="content">
      <img id="img" src="../assets/Logo-1.png" alt="logo">
      <h1>{{system}}<p>{{version}}</p></h1>
    </div>
  </div>
</template>

<script>
export default {
  name: 'title',
  data () {
    return {
      system: '后台管理系统',
      version: 'v1.0.0.1',
      isActive: true
    }
  }
}
</script>

<style>
.title{
  width: 100%;
  height: 300px;
  background: url(../assets/sky-1.jpg) 100% 100%;
  -webkit-animation: showbackground 4s;
  -webkit-animation-delay: -1s;
}

@-webkit-keyframes showbackground{
  0% {opacity: 0;}
  12.5% {opacity: 0;}
  25% {opacity: 0;}
  37.5% {opacity: 0.17;}
  50% {opacity: 0.34;}
  62.5% {opacity: 0.51;}
  75% {opacity: 0.68;}
  87.5% {opacity: 0.85;}
  100% {opacity: 1;}
}

#img{
  margin-top: 20px;
  width: 200px;
  height: 200px;
  display: inline-block;
  -webkit-animation: logo 3s;
}

@-webkit-keyframes logo{
  0% {-webkit-transform:rotate(-360deg);}
  100% {-webkit-transform:rotate(0deg);}
}

.content{
  position: absolute;
  top: 10px;
  width: 100%;
  height: auto;
  color: #2257c9;
}

.content h1{
  font-size: 90px;
  margin-left: 3%;
  display: inline-block;
}

.content p{
  margin-top: 5%;
  margin-bottom: 20px;
  font-size: 30px;
}
</style>
