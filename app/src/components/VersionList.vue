<template>
  <div class="versionlist">
    <Navbar></Navbar>
    <div class="list">
      <table>
        <thead>
          <tr>
            <th v-for="col in Columns">
              {{col}}
            </th>
            <th v-if="IsShowDele">Delete</th>
            <th v-if="IsShowDeletedVersion">Revive</th>
            <th>Download</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="row in Version">
            <td v-for="col in Columns">
              {{row[col]}}
            </td>
            <td v-if="IsShowDele">
              <button @click="DeleteVersion(row)">Delete</button>
            </td>
            <td v-if="IsShowDeletedVersion">
              <button @click="ReviveVersion(row)">Revive</button>
            </td>
            <td v-if="system !== 'IOS'">
              <form id="download" action="/api/download" method="get">
                <input type="hidden" name="version_id" v-model="version_id"></input>
                <input type="hidden" name="apiToken" v-model="apiToken"></input>
                <input type="hidden" name="username" v-model="username"></input>
                <button @click="Download(row)"><span>Download</span></button>
              </form>
            </td>
            <td v-if="system === 'IOS'">
              <a :href="row.file_url"><button><span>Download</span></button></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <p>
      <button class="btn-create" @click="CreateNewVersion">Create</button>
      <button class="btn-revive" @click="ShowDeletedVersion">Revive / Delete</button>
      <button class="btn-back" @click="Back">Back</button>
    </p>
    <div class="back_ground" v-show="IsShowNewVersion">
    </div>
    <div class="container" v-show="IsShowNewVersion" @click="Inputback">
      <div class="create">
        <p class="close-p"><button class="close" type="button" name="colse" @click="Close"><Icon type="close-round" size="12"></Icon></button></p>
        <div class="upload">
          <form class="uploader">
            <div class="inputer">
              <p class="input-p">Version</p>
              <p><input v-model="version" class="input-default" v-bind:class="{inputback: IsActive }" type="text" name="version"></p>
              <p class="input-p">Description</p>
              <p><textarea class="input-default-feedback" v-model="description" name="description" maxlength="150" placeholder="~限150字~"></textarea></p>
              <p class="input-p">Log</p>
              <p><textarea class="input-default-feedback" v-model="log" name="log" maxlength="50" placeholder="~限50字~"></textarea></p>
              <p><input id="uploadnewfile" type="file" name="uploadnewfile" @change="GetNewFile($event)"></p>
              <p>{{this.new_app.name}}</p>
              <p>
                <Progress :percent="percent" :stroke-width="3">
                  <Icon v-if="this.percent === 100" type="checkmark-circled"></Icon>
                </Progress>
              </p>
            </div>
            <button class="btn-upload" type="submit" @click="UploadForm($event)">Upload</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from './Navbar'
export default {
  name: 'versionlist',
  components: {
    Navbar
  },
  data () {
    return {
      Version: [],
      Columns: ['id', 'version', 'build', 'deleted_at', 'created_at'],
      Downloadurl: ['file_url'],
      version: '',
      new_app: '',
      IsShowNewVersion: false,
      IsShowDeletedVersion: false,
      IsShowDele: true,
      IsActive: true,
      version_id: '',
      log: '',
      description: '',
      percent: 0
    }
  },
  beforeMount: function () {
    console.log(sessionStorage)
    this.state = sessionStorage.state
    this.apiToken = sessionStorage.apiToken
    this.username = sessionStorage.username
    this.system = sessionStorage.system
    this.admin = sessionStorage.admin
    if (this.state !== 'true') {
      this.$router.push({path: '/Login'})
      this.$Loading.error()
    }
    if (this.admin === 'false') {
      this.IsShowDele = false
    }
    this.GetVersionList()
  },
  methods: {
    GetVersionList: function () {
      this.$http.get('app/' + this.$route.params.id + '/version', {params: {apiToken: this.apiToken, username: this.username}})
      .then((response) => {
        this.Version = response.data
        console.log(this.Version)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    CreateNewVersion: function () {
      this.IsShowNewVersion = true
    },
    Close: function () {
      this.IsShowNewVersion = false
      this.percent = 0
      this.new_app = ''
      this.version = ''
    },
    GetNewFile (event) {
      this.new_app = event.target.files[0]
      console.log(this.new_app)
    },
    UploadForm (event) {
      event.preventDefault()
      let formData = new FormData()
      formData.append('version', this.version)
      formData.append('file', this.new_app)
      formData.append('description', this.description)
      formData.append('log', this.log)
      formData.append('username', this.username)
      formData.append('apiToken', this.apiToken)
      let config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
      this.$http.post('app/' + this.$route.params.id + '/version', formData, config)
      .then((response) => {
        this.$http.get('app/' + this.$route.params.id + '/version', {params: {apiToken: this.apiToken, username: this.username}})
        .then((response) => {
          this.Version = response.data
          console.log(this.Version)
          this.percent = 100
        })
        .catch(function (error) {
          console.log(error)
        })
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    DeleteVersion: function (row) {
      this.$http.delete('app/' + this.$route.params.id + '/version', {params: {version_id: row.id, apiToken: this.apiToken, username: this.username}})
      .then((response) => {
        this.$http.get('app/' + this.$route.params.id + '/version', {params: {apiToken: this.apiToken, username: this.username}})
        .then((response) => {
          this.Version = response.data
          console.log(this.Version)
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
    ReviveVersion: function (row) {
      this.$http.put('app/' + this.$route.params.id + '/version', {version_id: row.id, apiToken: this.apiToken, username: this.username})
      .then((response) => {
        this.$http.get('app/' + this.$route.params.id + '/version', {params: {want_deleted: true, apiToken: this.apiToken, username: this.username}})
        .then((response) => {
          this.Version = response.data
          console.log(this.Version)
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
    ShowDeletedVersion: function () {
      if (this.IsShowDeletedVersion === true) {
        this.$http.get('app/' + this.$route.params.id + '/version', {params: {want_deleted: false, apiToken: this.apiToken, username: this.username}})
        .then((response) => {
          this.Version = response.data
          console.log(this.Versionm)
        })
        .catch(function (error) {
          console.log(error)
        })
        this.IsShowDeletedVersion = false
        this.IsShowDele = true
      } else {
        this.$http.get('app/' + this.$route.params.id + '/version', {params: {want_deleted: true, apiToken: this.apiToken, username: this.username}})
        .then((response) => {
          this.Version = response.data
          console.log(this.Versionm)
        })
        .catch(function (error) {
          console.log(error)
        })
        this.IsShowDeletedVersion = true
        this.IsShowDele = false
      }
    },
    Download: function (row) {
      console.log(row.id)
      this.version_id = row.id
      document.getElementById('download').submit()
    },
    Back: function () {
      sessionStorage.system = ''
      this.$router.push({path: '/Applist/' + this.$route.params.id + '/Systemlist'})
      this.$Loading.finish()
    },
    Inputback: function () {
      this.IsActive = true
    }
  }
}
</script>

<style scoped>
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

.btn-revive{
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

.btn-upload{
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


.btn-revive:hover{
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

.btn-upload:hover{
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
  left:35%;
  top:30%;
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
  outline: none;
}

table tr:nth-child(even) button span{
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

table tr:nth-child(even) button span:after{
  content: '▼';
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
  outline: none;
}

table tr:nth-child(odd) button span{
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

table tr:nth-child(odd) button span:after{
  content: '▼';
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

/*-----下拉菜单-----*/
table tr:nth-child(even) .dropdown{
  position: relative;
  display: inline-block;
}

table tr:nth-child(even) .dropdownlist{
  display: none;
  position: absolute;
  background-color: #FFF;
  width: auto;
  height: auto;
  box-shadow: 0px 8px 16px 0px #66ccff;
  z-index: 999;
}

table tr:nth-child(even) .dropdownlist button{
  display: block;
}

table tr:nth-child(even) .dropdown:hover .dropdownlist{
  display: block;
}

table tr:nth-child(odd) .dropdown{
  position: relative;
  display: inline-block;
}

table tr:nth-child(odd) .dropdownlist{
  display: none;
  position: absolute;
  background-color: #73C5FF;
  width: auto;
  height: auto;
  box-shadow: 0px 8px 16px 0px #66ccff;
  z-index: 999;
}

table tr:nth-child(odd) .dropdownlist button{
  display: block;
}

table tr:nth-child(odd) .dropdown:hover .dropdownlist{
  display: block;
}
</style>
