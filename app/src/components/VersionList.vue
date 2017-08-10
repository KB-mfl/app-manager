<template>
  <div class="versionlist">
    <div class="list">
      <table>
        <thead>
          <tr>
            <th v-for="col in columns">
              {{col}}
            </th>
            <th v-if="isshowdele">Delete</th>
            <th v-if="isshowdeletedversion">Revive</th>
            <th>Download</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="row in Version">
            <td v-for="col in columns">
              {{row[col]}}
            </td>
            <td v-if="isshowdele">
              <button @click="deleteversion(row)">Delete</button>
            </td>
            <td v-if="isshowdeletedversion">
              <button @click="reviveversion(row)">Revive</button>
            </td>
            <td>
              <form id="download" action="http://192.168.1.160:8000/api/download" method="get">
                <input type="hidden" name="version_id" v-model="version_id"></input>
                <button class="download" @click="download(row)">Download</button>
              </form>
            </td>
          </tr>
        </tbody>
      </table>
      <p>
        <button type="button" name="create" @click="createnewversion">Create</button>
        <button @click="showdeletedversion">Revive</button>
      </p>
      <div class="back_ground" v-show="isshownewversion">
      </div>
      <div class="container" v-show="isshownewversion">
        <div class="create">
          <p class="close"><button class="close" type="button" name="colse" @click="close"><Icon type="close-round" size="12"></Icon></button></p>
          <div class="upload">
            <form class="uploader">
              <div class="inputer-1">
                <p><input v-model="version" class="input-version" type="text" name="version" placeholder="Version"></p>
              </div>
              <div class="inputer-2">
                <p><input id="uploadnewfile" type="file" name="uploadnewfile" @change="getnewfile($event)"></p>
                <p><label for="uploadnewfile">New File</label></p>
              </div>
              <br>
              <button type="submit" @click="uploadform($event)">Save</button>
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
      columns: ['id', 'version', 'build', 'system_id', 'deleted_at', 'created_at'],
      imageurl: ['file_url'],
      version: '',
      new_app: '',
      isshownewversion: false,
      isshowdeletedversion: false,
      isshowdele: true,
      version_id: ''
    }
  },
  beforeMount: function () {
    this.getversionlist()
  },
  methods: {
    getversionlist: function () {
      this.$http.get(this.$route.params.systemid + '/version')
      .then((response) => {
        this.Version = response.data
        console.log(this.Version)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    createnewversion: function () {
      this.isshownewversion = true
    },
    close: function () {
      this.isshownewversion = false
    },
    getnewfile (event) {
      this.new_app = event.target.files[0]
      console.log(this.new_app)
    },
    uploadform (event) {
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
      this.isshownewversion = false
    },
    deleteversion: function (row) {
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
    reviveversion: function (row) {
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
    showdeletedversion: function () {
      if (this.isshowdeletedversion === true) {
        this.isshowdeletedversion = false
        this.isshowdele = true
      } else {
        this.isshowdeletedversion = true
        this.isshowdele = false
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
    download: function (row) {
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
