<template>
  <div class="home" @click="Inputback">
    <div class="welcome">
      <p class="p1">Find your</p>
      <p class="p2">favourite <span>App</span> here</p>
    </div>
    <div class="title">
      <span>Appname</span>
    </div>
    <form class="search">
      <input type="text" v-model="appname" class="input-default" v-bind:class="{inputback: IsActive }">
      <p><button name="search" @click="Searchapp">Search</button></p>
    </form>
  </div>
</template>

<script>
export default {
  name: 'home',
  data () {
    return {
      appname: '',
      IsActive: true
    }
  },
  methods: {
    Inputback: function () {
      this.IsActive = true
    },
    Searchapp: function () {
      this.$router.push({path: '/' + this.appname})
    }
  }
}
</script>

<style scoped>
@media screen and (min-width: 900px)
{
  .welcome{
    margin: 5% auto;
    height: auto;
    width: 100%;
    font-family: Consolas;
    font-size: 600%;
  }

  .p1{
    color: #7B55D4;
    width: auto;
    height: auto;
    margin: 0px 50% 0px auto;
  }

  .p2{
    color: #7B55D4;
    width: auto;
    height: auto;
    margin: 0px auto 0px 10%;
  }

  .p2 span{
    color: #1E90FF;
    font-size: 150%;
  }

  .title{
    width: 90%;
    height: 0px;
    margin: 10% auto;
    border: 1px solid #66ccff;
    background-color: #66ccff;
  }

  .title span{
    font-size: 425%;
    color: #2257c9;
    display: block;
    width: 30%;
    height: auto;
    margin: 0px auto;
    position:relative;
    top: -40px;
    text-align: center;
    background: #FFF;
  }

  input:-webkit-autofill{
  -webkit-box-shadow: 0 0 0px 1000px #FFFFFF inset !important;
  -webkit-text-fill-color: #000000;
  }

  .input-default{
    width: 30%;
    height: 50px;
    font-size: 40px;
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
    width: 30%;
    height: 50px;
    font-size: 40px;
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
    height: 50px;
    font-size: 40px;
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

  button{
    display: inline-block;
    border-radius: 4px;
    background-color: #73C5FF;
    border: none;
    color: #FFF;
    text-align: center;
    font-size: 20px;
    padding: 10px;
    width: auto;
    transition: all 0.5s;
    cursor: pointer;
    margin: 5%;
    border: 1px solid #73C5FF;
  }

  button:hover{
    display: inline-block;
    border-radius: 4px;
    background-color: #FFF;
    border: none;
    color: #73C5FF;
    text-align: center;
    font-size: 20px;
    padding: 10px;
    width: auto;
    transition: all 0.5s;
    cursor: pointer;
    margin: 5%;
    border: 1px solid #73C5FF;
  }
}

@media screen and (min-width: 600px) and (max-width: 900px)
{
  .welcome{
    margin: 5% auto;
    height: auto;
    width: 100%;
    font-family: Consolas;
    font-size: 400%;
  }

  .p1{
    color: #7B55D4;
    width: auto;
    height: auto;
    margin: 0px 50% 0px auto;
  }

  .p2{
    color: #7B55D4;
    width: auto;
    height: auto;
    margin: 0px auto 0px 10%;
  }

  .p2 span{
    color: #1E90FF;
    font-size: 150%;
  }

  .title{
    width: 90%;
    height: 0px;
    margin: 10% auto;
    border: 1px solid #66ccff;
    background-color: #66ccff;
  }

  .title span{
    font-size: 280%;
    color: #2257c9;
    display: block;
    width: 30%;
    height: auto;
    margin: 0px auto;
    position:relative;
    top: -30px;
    text-align: center;
    background: #FFF;
  }

  input:-webkit-autofill{
  -webkit-box-shadow: 0 0 0px 1000px #FFFFFF inset !important;
  -webkit-text-fill-color: #000000;
  }

  .input-default{
    width: 30%;
    height: 30px;
    font-size: 20px;
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
    width: 30%;
    height: 30px;
    font-size: 20px;
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
    height: 30px;
    font-size: 20px;
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

  button{
    display: inline-block;
    border-radius: 4px;
    background-color: #73C5FF;
    border: none;
    color: #FFF;
    text-align: center;
    font-size: 15px;
    padding: 7.5px;
    width: auto;
    transition: all 0.5s;
    cursor: pointer;
    margin: 5%;
    border: 1px solid #73C5FF;
  }

  button:hover{
    display: inline-block;
    border-radius: 4px;
    background-color: #FFF;
    border: none;
    color: #73C5FF;
    text-align: center;
    font-size: 15px;
    padding: 7.5px;
    width: auto;
    transition: all 0.5s;
    cursor: pointer;
    margin: 5%;
    border: 1px solid #73C5FF;
  }
}

@media screen and (max-width: 600px)
{
  .welcome{
    margin: 5% auto;
    height: auto;
    width: 100%;
    font-family: Consolas;
    font-size: 200%;
  }

  .p1{
    color: #7B55D4;
    width: auto;
    height: auto;
    margin: 0px 50% 0px auto;
  }

  .p2{
    color: #7B55D4;
    width: auto;
    height: auto;
    margin: 0px auto 0px 10%;
  }

  .p2 span{
    color: #1E90FF;
    font-size: 150%;
  }

  .title{
    width: 90%;
    height: 0px;
    margin: 10% auto;
    border: 1px solid #66ccff;
    background-color: #66ccff;
  }

  .title span{
    font-size: 150%;
    color: #2257c9;
    display: block;
    width: 30%;
    height: auto;
    margin: 0px auto;
    position:relative;
    top: -15px;
    text-align: center;
    background: #FFF;
  }

  input:-webkit-autofill{
  -webkit-box-shadow: 0 0 0px 1000px #FFFFFF inset !important;
  -webkit-text-fill-color: #000000;
  }

  .input-default{
    width: 30%;
    height: 20px;
    font-size: 10px;
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
    width: 30%;
    height: 20px;
    font-size: 10px;
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
    height: 20px;
    font-size: 10px;
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

  button{
    display: inline-block;
    border-radius: 4px;
    background-color: #73C5FF;
    border: none;
    color: #FFF;
    text-align: center;
    font-size: 10px;
    padding: 5px;
    width: auto;
    transition: all 0.5s;
    cursor: pointer;
    margin: 5%;
    border: 1px solid #73C5FF;
  }

  button:hover{
    display: inline-block;
    border-radius: 4px;
    background-color: #FFF;
    border: none;
    color: #73C5FF;
    text-align: center;
    font-size: 10px;
    padding: 5px;
    width: auto;
    transition: all 0.5s;
    cursor: pointer;
    margin: 5%;
    border: 1px solid #73C5FF;
  }
}
</style>
