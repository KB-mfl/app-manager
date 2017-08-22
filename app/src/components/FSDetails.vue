<template>
  <div class="fsdetails">
    <Navbar></Navbar>
    <table>
      <thead>
        <tr>
          <th v-for="col in Imageurl">
            {{col}}
          </th>
          <th v-for="col in FirstscreenContent">
            {{col}}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr class="info" v-for="row in Firstscreen" v-if="row.id == Fsid">
          <td v-for="col in Imageurl">
            <img :src="'/api/image/' + row.image_url">
          </td>
          <td v-for="col in FirstscreenContent">
            <textarea class="input-default-fs" name="content" rows="16" cols="10" readonly="readonly">{{row[col]}}</textarea>
          </td>
        </tr>
      </tbody>
    </table>
    <p>
      <button class="btn-back" @click="Back">Back</button>
    </p>
  </div>
</template>

<script>
import Navbar from './Navbar'
export default {
  name: 'fsdetails',
  components: {
    Navbar
  },
  data () {
    return {
      Firstscreen: [],
      Columns: ['id', 'app_id', 'created_at', 'updated_at', 'actived'],
      FirstscreenContent: ['content'],
      Imageurl: ['image'],
      Fsid: this.$route.params.firstscreenid
    }
  },
  beforeMount: function () {
    console.log(sessionStorage)
    this.state = sessionStorage.state
    this.apiToken = sessionStorage.apiToken
    this.username = sessionStorage.username
    if (this.state !== 'true') {
      this.$router.push({path: '/Login'})
      this.$Loading.error()
    }
    this.GetFirstscreen()
  },
  methods: {
    GetFirstscreen: function () {
      this.$http.get('/' + this.$route.params.id + '/first_screen', {params: {apiToken: this.apiToken, username: this.username}})
      .then((response) => {
        this.Firstscreen = response.data
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    Back: function () {
      this.$router.push({path: '/Applist/' + this.$route.params.id + '/Firstscreen'})
    }
  }
}
</script>

<style scoped>
img{
  max-height: 200px;
}

img:hover{
  position: relative;
  z-index: 998;
  box-shadow: 2px 2px 16px 0px #66ccff;
  -webkit-animation: Logo 0.5s;
  -webkit-animation-fill-mode: forwards;
}

button{
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

.btn-back{
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

.btn-back:hover{
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

.input-default-fs{
  width: 100%;
  height: auto;
  font-size: 15px;
  border-left: 1px solid;
  border-top: 0px solid;
  border-bottom: 0px solid;
  border-color: #66ccff;
  caret-color: #66ccff;
  color: #2A8FBD;
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
/*-----表格-----*/
.list{
  width: 100%;
  margin-top:  20px;
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
  padding: 0px;
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
