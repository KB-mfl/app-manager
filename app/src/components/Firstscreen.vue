<template>
  <div class="firstscreen">
    <Navbar></Navbar>
    <div class="list">
      <table>
        <thead>
          <tr>
            <th v-for="col in Columns">
              {{col}}
            </th>
            <th v-if="IsShowDel">Delete</th>
            <th v-if="IsShowActive">Active</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="row in Firstscreen">
            <td v-for="col in Columns">
              {{row[col]}}
            </td>
            <td v-if="IsShowDel">
              <button @click="DeleteFSPush(row)">Delete</button>
            </td>
            <td v-if="IsShowActive">
              <button @click="ActiveFSPush(row)">Active</button>
            </td>
            <td>
              <button @click="ShowDetails(row)">Details</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <p>
      <button v-if="admin === 'true'" class="btn-create" @click="CreateNewFSPush">Create</button>
      <button v-if="admin === 'true'" class="btn-active" @click="ShowActive">Active / Delete</button>
      <button class="btn-back" @click="Back">Back</button>
    </p>
    <div class="back_ground" v-show="IsShowNewFSPush">
    </div>
    <div class="container" v-show="IsShowNewFSPush">
      <div class="create">
        <p class="close-p"><button class="close" type="button" name="colse" @click="Close"><Icon type="close-round" size="12"></Icon></button></p>
        <div class="upload">
          <form class="uploader">
            <div class="inputer">
              <p><input v-model="Appid" type="hidden" name="app_id"></p>
              <p class="input-p">Content</p>
              <p><textarea maxlength="150" v-model="Content" class="input-default-fs" name="content" placeholder="~限150字~"></textarea></p>
              <p><input id="uploadnewfile" type="file" name="uploadnewapp" @change="GetNewLogo($event)"></p>
              <p>{{this.new_logo.name}}</p>
            </div>
            <br>
            <button class="btn-save" type="submit" @click="UploadNewLogo($event)">Save</button>
         </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from './Navbar'
export default {
  name: 'firstscreen',
  components: {
    Navbar
  },
  data () {
    return {
      Firstscreen: [],
      Columns: ['id', 'created_at', 'updated_at', 'actived'],
      FirstscreenContent: ['content'],
      Imageurl: ['image_url'],
      Appid: '',
      Content: '',
      new_logo: '',
      IsShowDel: true,
      IsShowActive: false,
      IsShowNewFSPush: false
    }
  },
  beforeMount: function () {
    console.log(sessionStorage)
    this.state = sessionStorage.state
    this.apiToken = sessionStorage.apiToken
    this.username = sessionStorage.username
    this.admin = sessionStorage.admin
    if (this.state !== 'true') {
      this.$router.push({path: '/Login'})
      this.$Loading.error()
    }
    if (this.admin === 'false') {
      this.IsShowDel = false
    }
    this.GetFirstscreen()
  },
  methods: {
    GetFirstscreen: function () {
      this.$http.get('/' + this.$route.params.id + '/first_screen', {params: {apiToken: this.apiToken, username: this.username}})
      .then((response) => {
        this.Firstscreen = response.data
        console.log(this.Firstscreen)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    ShowActive: function () {
      if (this.IsShowActive === true) {
        this.IsShowActive = false
        this.IsShowDel = true
      } else {
        this.IsShowActive = true
        this.IsShowDel = false
      }
    },
    DeleteFSPush: function (row) {
      this.$http.delete('/' + this.$route.params.id + '/first_screen', {params: {first_screen_id: row.id, apiToken: this.apiToken, username: this.username}})
      .then((response) => {
        this.$http.get('/' + this.$route.params.id + '/first_screen', {params: {apiToken: this.apiToken, username: this.username}})
        .then((response) => {
          this.Firstscreen = response.data
          console.log(this.Firstscreen)
        })
        .catch(function (error) {
          console.log(error)
        })
        console.log('success')
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    ActiveFSPush: function (row) {
      this.$http.put('/' + this.$route.params.id + '/first_screen', {first_screen_id: row.id, apiToken: this.apiToken, username: this.username})
      .then((response) => {
        this.$http.get('/' + this.$route.params.id + '/first_screen', {params: {apiToken: this.apiToken, username: this.username}})
        .then((response) => {
          this.Firstscreen = response.data
          console.log(this.Firstscreen)
        })
        .catch(function (error) {
          console.log(error)
        })
        console.log('success')
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    CreateNewFSPush: function () {
      this.IsShowNewFSPush = true
    },
    Close: function () {
      this.IsShowNewFSPush = false
    },
    GetNewLogo: function () {
      this.new_logo = event.target.files[0]
      console.log(this.new_logo)
    },
    UploadNewLogo (event) {
      event.preventDefault()
      let formData = new FormData()
      formData.append('file', this.new_logo)
      formData.append('app_id', this.Appid)
      formData.append('content', this.Content)
      formData.append('username', this.username)
      formData.append('apiToken', this.apiToken)
      let config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
      this.$http.post('/' + this.$route.params.id + '/first_screen', formData, config)
      .then((response) => {
        this.$http.get('/' + this.$route.params.id + '/first_screen', {params: {apiToken: this.apiToken, username: this.username}})
        .then((response) => {
          this.Firstscreen = response.data
          console.log(this.Firstscreen)
        })
        .catch(function (error) {
          console.log(error)
        })
        console.log('success')
      })
      .catch(function (error) {
        console.log(error)
      })
      this.IsShowNewFSPush = false
    },
    Back: function () {
      this.$router.push({path: '/Applist'})
    },
    ShowDetails: function (row) {
      this.$router.push({path: '/Applist/' + this.$route.params.id + '/Firstscreen/' + row.id})
    }
  }
}
</script>

<style scoped>
img{
  width: 100px;
  height: 100px;
}

img:hover{
  position: relative;
  z-index: 998;
  box-shadow: 2px 2px 16px 0px #66ccff;
  -webkit-animation: Logo 0.5s;
  -webkit-animation-fill-mode: forwards;
}

@-webkit-keyframes Logo{
  0% {-webkit-transform:scale(1);transform:scale(1);}
  100% {-webkit-transform:scale(2);transform:scale(2);}
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

.btn-create{
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

.btn-active{
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

.btn-save{
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

.btn-create:hover{
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


.btn-active:hover{
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

.btn-save:hover{
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
  left: 35%;
  top: 25%;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  background-color: #ffffff;
}

.create p{
  height: auto;
}

.close{
  margin: 1% 0 1% 92%;
  background: #efeeee;
  padding: 0px 7px;
  color: #333;
  border: 0;
  border-radius: 20px;
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

#uploadnewfile{
  font-size: 0px;
  margin: 20px auto 0px auto;
}

#uploadnewfile::-webkit-file-upload-button{
  background: #66ccff;
  color: #FFF;
  border: 1px solid #66ccff;
  padding: 10px 50px;
  border-radius: 5px;
  font-size: 15px;
  cursor: pointer;
  outline: none;
}

#uploadnewfile::-webkit-file-upload-button:hover{
  background-color: #FFF;
  color: #66ccff;
  outline: none;
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

.input-default-fs{
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
