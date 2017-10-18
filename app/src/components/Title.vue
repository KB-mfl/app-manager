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
      system: 'App Manager',
      version: 'v1.0.1'
    }
  }
}
</script>

<style scoped>
@media screen and (min-width: 900px)
{
  .title{
    width: 100%;
    height: 300px;
    background: url(../assets/sky-1.jpg);
    background-size: cover;
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
    width: 150px;
    height: 150px;
    display: inline-block;
    -webkit-animation: logo 3s;
  }

  @-webkit-keyframes logo{
    0% {-webkit-transform:rotate(-180deg);transform:rotate(-180deg);}
    100% {-webkit-transform:rotate(0deg);transform:rotate(0deg);}
  }

  .content{
    position: absolute;
    top: 10%;
    width: 100%;
    height: auto;
    color: #2257c9;
  }

  .content h1{
    font-size: 600%;
    margin-left: 3%;
    line-height: 80px;
    display: inline-block;
    -webkit-animation: words 3s;
  }

  @-webkit-keyframes words{
    0% {-webkit-transform:scale(0);transform:scale(0);}
    100% {-webkit-transform:scale(1);transform:scale(1);}
  }

  .content p{
    margin-top: 5%;
    margin-bottom: 5%;
    font-size: 40%;
  }
}

@media screen and (min-width: 600px) and (max-width: 900px)
{
  .title{
    width: 100%;
    height: 225px;
    background: url(../assets/sky-1.jpg);
    background-size: cover;
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
    width: 120px;
    height: 120px;
    display: inline-block;
    -webkit-animation: logo 3s;
  }

  @-webkit-keyframes logo{
    0% {-webkit-transform:rotate(-180deg);transform:rotate(-180deg);}
    100% {-webkit-transform:rotate(0deg);transform:rotate(0deg);}
  }

  .content{
    position: absolute;
    top: 8%;
    width: 100%;
    height: auto;
    color: #2257c9;
  }

  .content h1{
    font-size: 400%;
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
    margin-bottom: 5%;
    font-size: 30%;
  }
}

@media screen and (max-width: 600px)
{
  .title{
    width: 100%;
    height: 150px;
    background: url(../assets/sky-1.jpg);
    background-size: cover;
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
    width: 90px;
    height: 90px;
    display: inline-block;
    -webkit-animation: logo 3s;
  }

  @-webkit-keyframes logo{
    0% {-webkit-transform:rotate(-180deg);transform:rotate(-180deg);}
    100% {-webkit-transform:rotate(0deg);transform:rotate(0deg);}
  }

  .content{
    position: absolute;
    top: 3%;
    width: 100%;
    height: auto;
    color: #2257c9;
  }

  .content h1{
    font-size: 225%;
    margin-left: 3%;
    line-height: 50px;
    display: inline-block;
    -webkit-animation: words 3s;
  }

  @-webkit-keyframes words{
    0% {-webkit-transform:scale(0);transform:scale(0);}
    100% {-webkit-transform:scale(1);transform:scale(1);}
  }

  .content p{
    margin-top: 2%;
    margin-bottom: 5%;
    font-size: 20%;
  }
}
</style>
