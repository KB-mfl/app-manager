<template>
  <div class="appsystemlist">
    <Navbar></Navbar>
    <div class="switch">
      <div class="systems">
        <div class="android" v-bind:class="{androidactive: IsActiveAndroid }" @click="Switchsystem">
          <p>Android</p>
        </div>
        <div class="ios" v-bind:class="{iosactive: IsActiveIos }" @click="Switchsystem">
          <p>IOS</p>
        </div>
      </div>
    </div>
    <div class="list" v-if="systemname === 'Android'">
      <table>
        <thead>
          <tr>
            <th v-for="col in ColumnsAndroid">
              {{col}}
            </th>
            <th v-for="col in Imageurl">
              {{col}}
            </th>
            <th v-if="IsShowDele">Delete</th>
            <th v-if="IsShowDeletedSystem">Revive</th>
            <th>More</th>
          </tr>
        </thead>
        <tbody v-if="Android != null">
          <tr>
            <td v-for="col in ColumnsAndroid">
              {{Android[col]}}
            </td>
            <td v-for="col in Imageurl">
              <img :src="'/api/image/' + Android.logo">
            </td>
            <td v-if="IsShowDele">
              <button @click="DeleteSystemAndroid">Delete</button>
            </td>
            <td v-if="IsShowDeletedSystem">
              <button @click="ReviveSystemAndroid">Revive</button>
            </td>
            <td>
              <div class="dropdown">
                <button class="showdropdownlist">More</button>
                <div class="dropdownlist">
                    <button @click="ShowVersionList(Android)"><span>Versionlist</span></button>
                    <button @click="AddLogo(Android)"><span>+Logo</span></button>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="list" v-if="systemname === 'IOS' && Ios != null">
      <table>
        <thead>
          <tr>
            <th v-for="col in ColumnsIOS">
              {{col}}
            </th>
            <th v-for="col in Imageurl">
              {{col}}
            </th>
            <th v-if="IsShowDele">Delete</th>
            <th v-if="IsShowDeletedSystem">Revive</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td v-for="col in ColumnsIOS">
              {{Ios[col]}}
            </td>
            <td v-for="col in Imageurl">
              <img :src="Ios.logo">
            </td>
            <td v-if="IsShowDele">
              <button @click="DeleteSystemIOS">Delete</button>
            </td>
            <td v-if="IsShowDeletedSystem">
              <button @click="ReviveSystemIOS">Revive</button>
            </td>
          </tr>
        </tbody>
      </table>
      <br>
      <table>
        <thead>
          <tr>
            <th v-for="col in Description">
              {{col}}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td v-for="col in Description">
              {{Ios[col]}}
            </td>
          </tr>
        </tbody>
      </table>
      <br>
      <table>
        <thead>
          <tr>
            <th v-for="col in Log">
              {{col}}
            </th>
          </tr>
        </thead>
        <tbody v-if="Ios.log != null">
          <tr>
            <td v-for="col in Log">
              {{Ios[col]}}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <p>
      <button class="btn-create" @click="CreateNewSystem">Create</button>
      <button class="btn-revive" @click="ShowDeletedSystem">Revive / Delete</button>
      <button class="btn-back" @click="Back">Back</button>
    </p>
    <div class="back_ground" v-show="IsShowNewSystem">
    </div>
    <div class="container" v-show="IsShowNewSystem" @click="Inputback">
      <div class="create">
        <p class="close-p"><button class="close" type="button" name="colse" @click="Close"><Icon type="close-round" size="12"></Icon></button></p>
        <div class="upload">
          <form class="uploader">
            <div class="inputer">
              <p class="input-p">System</p>
              <Select v-model="system" style="width:48%">
                  <Option v-for="item in SystemList" :value="item.value" :key="item.value"></Option>
              </Select>
              <p v-if="system === 'Android'" class="input-p">Identification</p>
              <p v-if="system === 'Android'"><input v-model="identification" class="input-default" v-bind:class="{inputback: IsActive }" type="text" name="identification"></p>
              <p v-if="system === 'Android'"><input id="uploadnewfile" type="file" name="uploadnewfile" @change="GetNewFile($event)"></p>
              <p v-if="system === 'Android'">···请选择App Logo···</p>
              <p v-if="system === 'Android'">{{this.new_file.name}}</p>
              <p v-if="system === 'IOS'" class="input-p">iTunes Url</p>
              <p v-if="system === 'IOS'"><input v-model="itunes_url" type="text" name="itunes_url" class="input-default" v-bind:class="{inputback: IsActive }"></p>
            </div>
            <br>
            <button v-if="system === 'Android'" class="btn-save" type="submit" @click="UploadFormAndroid($event)">Save</button>
            <button v-if="system === 'IOS'" type="submit" class="btn-save" @click="UploadFormIOS($event)">Save</button>
         </form>
        </div>
      </div>
    </div>
    <div class="back_ground" v-show="IsShowNewLogo">
    </div>
    <div class="container" v-show="IsShowNewLogo">
      <div class="create">
        <p class="close-p"><button class="close" type="button" name="colse" @click="Close"><Icon type="close-round" size="12"></Icon></button></p>
        <div class="upload">
          <form class="uploader">
            <div class="inputer">
              <p><input v-model="AndroidId" type="hidden" name="android_id"></p>
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
  name: 'appsystemlist',
  components: {
    Navbar
  },
  data () {
    return {
      AppSystem: [],
      Android: [],
      Ios: [],
      ColumnsAndroid: ['android_id', 'identification', 'deleted_at', 'created_at', 'updated_at'],
      ColumnsIOS: ['alias', 'version', 'identification', 'deleted_at', 'created_at', 'updated_at'],
      Description: ['description'],
      Log: ['log'],
      Imageurl: ['logo'],
      IsShowNewSystem: false,
      IsShowDeletedSystem: false,
      IsShowDele: true,
      IsShowNewLogo: false,
      IsActive: true,
      IsActiveAndroid: true,
      IsActiveIos: false,
      systemname: 'Android',
      system: 'Android',
      AndroidId: '',
      identification: '',
      new_file: '',
      new_logo: '',
      itunes_url: '',
      SystemList: [
        {
          value: 'Android'
        },
        {
          value: 'IOS'
        }
      ]
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
      this.IsShowDele = false
    }
    this.GetSystemList()
  },
  methods: {
    GetSystemList: function () {
      this.$http.get('app/' + this.$route.params.id, {params: {apiToken: this.apiToken, username: this.username}})
      .then((response) => {
        this.AppSystem = response.data
        this.Android = this.AppSystem.android
        this.Ios = this.AppSystem.ios
        console.log(this.Android)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    DeleteSystemAndroid: function () {
      this.$http.delete('app/' + this.$route.params.id + '/android', {params: {apiToken: this.apiToken, username: this.username}})
      .then((response) => {
        this.$http.get('app/' + this.$route.params.id, {params: {apiToken: this.apiToken, username: this.username}})
        .then((response) => {
          this.AppSystem = response.data
          this.Android = this.AppSystem.android
          this.Ios = this.AppSystem.ios
          console.log(this.AppSystem)
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
    DeleteSystemIOS: function () {
      this.$http.delete('app/' + this.$route.params.id + '/ios', {params: {apiToken: this.apiToken, username: this.username}})
      .then((response) => {
        this.$http.get('app/' + this.$route.params.id, {params: {apiToken: this.apiToken, username: this.username}})
        .then((response) => {
          this.AppSystem = response.data
          this.Android = this.AppSystem.android
          this.Ios = this.AppSystem.ios
          console.log(this.AppSystem)
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
    ShowDeletedSystem: function () {
      if (this.IsShowDeletedSystem === true) {
        this.$http.get('app/' + this.$route.params.id, {params: {want_deleted: false, apiToken: this.apiToken, username: this.username}})
        .then((response) => {
          this.AppSystem = response.data
          this.Android = this.AppSystem.android
          this.Ios = this.AppSystem.ios
          console.log(this.AppSystem)
        })
        .catch(function (error) {
          console.log(error)
        })
        this.IsShowDeletedSystem = false
        this.IsShowDele = true
      } else {
        this.$http.get('app/' + this.$route.params.id, {params: {want_deleted: true, apiToken: this.apiToken, username: this.username}})
        .then((response) => {
          this.AppSystem = response.data
          this.Android = this.AppSystem.android
          this.Ios = this.AppSystem.ios
          console.log(this.AppSystem)
        })
        .catch(function (error) {
          console.log(error)
        })
        this.IsShowDeletedSystem = true
        this.IsShowDele = false
      }
    },
    ReviveSystemAndroid: function () {
      this.$http.put('app/' + this.$route.params.id + '/android', {apiToken: this.apiToken, username: this.username})
      .then((response) => {
        this.$http.get('app/' + this.$route.params.id, {params: {want_deleted: true, apiToken: this.apiToken, username: this.username}})
        .then((response) => {
          this.AppSystem = response.data
          this.Android = this.AppSystem.android
          this.Ios = this.AppSystem.ios
          console.log(this.AppSystem)
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
    ReviveSystemIOS: function () {
      this.$http.put('app/' + this.$route.params.id + '/ios', {apiToken: this.apiToken, username: this.username})
      .then((response) => {
        this.$http.get('app/' + this.$route.params.id, {params: {want_deleted: true, apiToken: this.apiToken, username: this.username}})
        .then((response) => {
          this.AppSystem = response.data
          this.Android = this.AppSystem.android
          this.Ios = this.AppSystem.ios
          console.log(this.AppSystem)
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
    CreateNewSystem: function () {
      this.IsShowNewSystem = true
    },
    Close: function () {
      this.IsShowNewSystem = false
      this.IsShowNewLogo = false
      this.identification = ''
      this.new_file = ''
    },
    GetNewFile (event) {
      this.new_file = event.target.files[0]
      console.log(this.new_file)
    },
    UploadFormAndroid (event) {
      event.preventDefault()
      let formData = new FormData()
      formData.append('file', this.new_file)
      formData.append('identification', this.identification)
      formData.append('username', this.username)
      formData.append('apiToken', this.apiToken)
      let config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
      this.$http.post('app/' + this.$route.params.id + '/android', formData, config)
      .then((response) => {
        this.$http.get('app/' + this.$route.params.id, {params: {apiToken: this.apiToken, username: this.username}})
        .then((response) => {
          this.AppSystem = response.data
          this.Android = this.AppSystem.android
          this.Ios = this.AppSystem.ios
          console.log(this.AppSystem)
        })
        .catch(function (error) {
          console.log(error)
        })
        console.log('success')
      })
      .catch(function (error) {
        console.log(error)
      })
      this.IsShowNewSystem = false
      this.identification = ''
      this.new_file = ''
    },
    UploadFormIOS (event) {
      event.preventDefault()
      let formData = new FormData()
      formData.append('username', this.username)
      formData.append('apiToken', this.apiToken)
      formData.append('itunes', this.itunes_url)
      let config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
      this.$http.post('app/' + this.$route.params.id + '/ios', formData, config)
      .then((response) => {
        this.$http.get('app/' + this.$route.params.id, {params: {apiToken: this.apiToken, username: this.username}})
        .then((response) => {
          this.AppSystem = response.data
          this.Android = this.AppSystem.android
          this.Ios = this.AppSystem.ios
          console.log(this.AppSystem)
        })
        .catch(function (error) {
          console.log(error)
        })
        console.log('success')
      })
      .catch(function (error) {
        console.log(error)
      })
      this.IsShowNewSystem = false
      this.itunes_url = ''
    },
    ShowVersionList: function (Android) {
      this.$router.push({path: '/Applist/' + this.$route.params.id + '/Systemlist/' + Android.id + '/Versionlist'})
      this.$Loading.finish()
    },
    AddLogo: function (Android) {
      this.IsShowNewLogo = true
      this.AndroidId = Android.android_id
    },
    GetNewLogo: function () {
      this.new_logo = event.target.files[0]
      console.log(this.new_logo)
    },
    UploadNewLogo (event) {
      event.preventDefault()
      let formData = new FormData()
      formData.append('file', this.new_logo)
      formData.append('android_id', this.AndroidId)
      formData.append('username', this.username)
      formData.append('apiToken', this.apiToken)
      let config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
      this.$http.post('image', formData, config)
      .then((response) => {
        this.$http.get('app/' + this.$route.params.id, {params: {apiToken: this.apiToken, username: this.username}})
        .then((response) => {
          this.AppSystem = response.data
          this.Android = this.AppSystem.android
          this.Ios = this.AppSystem.ios
          console.log(this.AppSystem)
        })
        .catch(function (error) {
          console.log(error)
        })
        console.log('success')
      })
      .catch(function (error) {
        console.log(error)
      })
      this.IsShowNewLogo = false
    },
    Back: function () {
      sessionStorage.appname = ''
      this.$router.push({path: '/Applist'})
      this.$Loading.finish()
    },
    Inputback: function () {
      this.IsActive = true
    },
    Switchsystem: function () {
      if (this.IsActiveAndroid === true) {
        this.IsActiveAndroid = false
        this.IsActiveIos = true
        this.systemname = 'IOS'
      } else {
        this.IsActiveAndroid = true
        this.IsActiveIos = false
        this.systemname = 'Android'
      }
    }
  }
}
</script>

<style scoped>
.switch{
  width: 100%;
  height: auto;
  margin: 0px auto 20px auto;
}

.systems{
  width: 80%;
  height: auto;
  display: inline-block;
  margin: 0px auto;
}

.android{
  width: 50%;
  margin: 0px;
  float: left;
  font-size: 30px;
  color: #2257c9;
  cursor: pointer;
}

.androidactive{
  width: 50%;
  margin: 0px;
  float: left;
  font-size: 30px;
  color: #2257c9;
  border-bottom: 2px solid #66ccff;
  cursor: pointer;
}

.ios{
  width: 50%;
  margin: 0px;
  float: left;
  font-size: 30px;
  color: #2257c9;
  cursor: pointer;
}

.iosactive{
  width: 50%;
  margin: 0px;
  float: left;
  font-size: 30px;
  color: #2257c9;
  border-bottom: 2px solid #66ccff;
  cursor: pointer;
}

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
