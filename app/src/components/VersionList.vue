<template>
  <div class="versionlist">
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
            <td>
              <form id="download" action="http://192.168.1.160:8000/api/download" method="get">
                <input type="hidden" name="version_id" v-model="version_id"></input>
                <button class="download" @click="Download(row)">Download</button>
              </form>
            </td>
          </tr>
        </tbody>
      </table>
      <p>
        <button type="button" name="create" @click="CreateNewVersion">Create</button>
        <button @click="ShowDeletedVersion">Revive</button>
      </p>
      <div class="back_ground" v-show="IsShowNewVersion">
      </div>
      <div class="container" v-show="IsShowNewVersion">
        <div class="create">
          <p class="close"><button class="close" type="button" name="colse" @click="Close"><Icon type="close-round" size="12"></Icon></button></p>
          <div class="upload">
            <form class="uploader">
              <div class="inputer-1">
                <p><input v-model="version" class="input-version" type="text" name="version" placeholder="Version"></p>
              </div>
              <div class="inputer-2">
                <p><input id="uploadnewfile" type="file" name="uploadnewfile" @change="GetNewFile($event)"></p>
                <p><label for="uploadnewfile">New File</label></p>
              </div>
              <br>
              <button type="submit" @click="UploadForm($event)">Save</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'versionlist',
  data () {
    return {
      Version: [],
      Columns: ['id', 'version', 'build', 'system_id', 'deleted_at', 'created_at'],
      imageurl: ['file_url'],
      version: '',
      new_app: '',
      IsShowNewVersion: false,
      IsShowDeletedVersion: false,
      IsShowDele: true,
      version_id: ''
    }
  },
  beforeMount: function () {
    this.GetVersionList()
  },
  methods: {
    GetVersionList: function () {
      this.$http.get(this.$route.params.systemid + '/version')
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
    },
    GetNewFile (event) {
      this.new_app = event.target.files[0]
      console.log(this.new_app)
    },
    UploadForm (event) {
      event.preventDefault()
      let formData = new FormData()
      formData.append('system_id', this.$route.params.systemid)
      formData.append('version', this.version)
      formData.append('file', this.new_app)
      let config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
      this.$http.post(this.$route.params.systemid + '/version', formData, config)
      .then((response) => {
        this.$http.get(this.$route.params.systemid + '/version')
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
      this.IsShowNewVersion = false
    },
    DeleteVersion: function (row) {
      this.$http.delete(this.$route.params.systemid + '/version', {params: {version_id: row.id}})
      .then((response) => {
        this.$http.get(this.$route.params.systemid + '/version')
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
      this.$http.put(this.$route.params.systemid + '/version', {version_id: row.id})
      .then((response) => {
        this.$http.get(this.$route.params.systemid + '/version', {params: {want_deleted: true}})
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
        this.IsShowDeletedVersion = false
        this.IsShowDele = true
      } else {
        this.IsShowDeletedVersion = true
        this.IsShowDele = false
      }
      this.$http.get(this.$route.params.systemid + '/version', {params: {want_deleted: true}})
      .then((response) => {
        this.Version = response.data
        console.log(this.Versionm)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    Download: function (row) {
      console.log(row.id)
      this.version_id = row.id
      document.getElementById('download').submit()
    }
  }
}
</script>

<style scoped>
.list{
  width: 90%;
  margin-top: 20px;
  margin-left: auto;
  margin-right: auto;
}

table{
  margin: 0px;
  padding: 0px;
  font-size: 20px;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  width: 100%;
  border-collapse: collapse;
}

thead{
  background-color: #2ab27b;
  color: #ffffff;
}

button{
  width: auto;
  height: auto;
  background: #efeeee;
  color: #333;
  border: 0;
  padding: 10px 10px;
  margin: 20px auto;
  border-radius: 5px;
  font-size: 15px;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  cursor: pointer;
}

button:hover{
  position: relative;
  bottom: 1px;
  right: 1px;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  background-color: #2ab27b;
  color: #ffffff;
}

.back_ground{
  height: 133%;
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  background-color: #000000;
  opacity: 0.5;
}

.container{
  height: 100%;
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
}

.container button{
  margin: 0px auto 10px auto;
}

.create{
  height: auto;
  width: 30%;
  margin-top: 30%;
  margin-left: auto;
  margin-right: auto;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  background-color: #ffffff;
}

.create p{
  height: auto;
}

.close{
  background-color: #2ab27b;
}

.create p button{
  margin: 1% 0 1% 92%;
  background: #efeeee;
  padding: 0px 7px;
  color: #333;
  border: 0;
  border-radius: 20px;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  cursor: pointer;
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

.inputer-1{
  margin: 0px;
}

.input-version{
  margin-top: 0px;
  margin-bottom: 10px;
  margin-left: auto;
  margin-right: auto;
  font-size: 20px;
  border-radius: 5px;
}

.input-version:hover{
  position: relative;
  bottom: 2px;
  right: 2px;
  border-radius: 5px;
  box-shadow: 1px 1px 2px rgba(0,0,0,.1), 0 0 3px rgba(0,0,0,.12);
  background-color: #2ab27b;
}

.inputer-2{
  margin: 10px 0px 0px 0px;
}

#uploadnewfile{
  font-size: 0px;
  margin: 0px auto;
}

#uploadnewfile::-webkit-file-upload-button{
  background: #ffffff;
  color: #333;
  border: dotted #2ab27b;
  padding: 30px 100px;
  border-radius: 5px;
  font-size: 12px;
  cursor: pointer;
}

#uploadnewfile::-webkit-file-upload-button:hover{
  position: relative;
  bottom: 1px;
  right: 1px;
  background-color: #2ab27b;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
}
</style>
