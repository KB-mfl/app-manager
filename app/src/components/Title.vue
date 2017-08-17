<template>
  <div class="iTitle">
    <div class="title"></div>
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
      version: 'v1.0.1'
    }
  }
}
</script>

<style scoped>
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
  0% {-webkit-transform:rotate(-180deg);transform:rotate(-180deg);}
  100% {-webkit-transform:rotate(0deg);transform:rotate(0deg);}
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
  -webkit-animation: words 3s;
}

@-webkit-keyframes words{
  0% {-webkit-transform:scale(0);transform:scale(0);}
  100% {-webkit-transform:scale(1);transform:scale(1);}
}

.content p{
  margin-top: 5%;
  margin-bottom: 20px;
  font-size: 30px;
}
</style>
