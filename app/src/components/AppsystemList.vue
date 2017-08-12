<template>
  <div class="appsystemlist">
    <div class="list">
      <table>
        <thead>
          <tr>
            <th v-for="col in Columns">
              {{col}}
            </th>
            <th v-if="IsShowDele">Delete</th>
            <th v-if="IsShowDeletedSystem">Revive</th>
            <th>AddLogo</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="row in AppSystem">
            <td v-for="col in Columns">
              {{row[col]}}
            </td>
            <td v-if="IsShowDele">
              <button @click="DeleteSystem(row)">Delete</button>
            </td>
            <td v-if="IsShowDeletedSystem">
              <button @click="ReviveSystem(row)">Revive</button>
            </td>
            <td>
              <button @click="AddLogo(row)">Add</button>
            </td>
            <td>
              <button class="showversionlist" id="showversionlist" @click="ShowVersionList(row.id)">Details</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <p>
      <button type="button" name="create" @click="CreateNewSystem">Create</button>
      <button @click="ShowDeletedSystem">Revive</button>
    </p>
    <div class="back_ground" v-show="IsShowNewSystem">
    </div>
    <div class="container" v-show="IsShowNewSystem">
      <div class="create">
        <p class="close"><button class="close" type="button" name="colse" @click="Close"><Icon type="close-round" size="12"></Icon></button></p>
        <div class="upload">
          <form class="uploader">
            <div class="inputer-1">
              <p><input v-model="system" class="input-system" type="text" name="system" placeholder="System"></p>
              <p><input v-model="identification" class="input-identification" type="text" name="identification" placeholder="Identification"></p>
            </div>
            <div class="inputer-2">
              <p><input id="uploadnewfile" type="file" name="uploadnewfile" @change="GetNewFile($event)"></p>
              <p><label for="uploadnewfile">Logo</label></p>
            </div>
            <br>
            <button type="submit" @click="UploadForm($event)">Save</button>
         </form>
        </div>
      </div>
    </div>
    <div class="back_ground" v-show="IsShowNewLogo">
    </div>
    <div class="container" v-show="IsShowNewLogo">
      <div class="create">
        <p class="close"><button class="close" type="button" name="colse" @click="Close"><Icon type="close-round" size="12"></Icon></button></p>
        <div class="upload">
          <form class="uploader">
            <div class="inputer-2">
              <p><input v-model="Systemid" type="hidden" name="system_id"></p>
              <p><input id="uploadnewfile" type="file" name="uploadnewapp" @change="GetNewLogo($event)"></p>
              <p><label for="uploadnewfile">Logo</label></p>
            </div>
            <br>
            <button type="submit" @click="UploadNewLogo($event)">Save</button>
         </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'appsystemlist',
  data () {
    return {
      AppSystem: [],
      Columns: ['id', 'app_id', 'system', 'identification', 'deleted_at', 'created_at', 'updated_at'],
      Imageurl: ['logo_url'],
      IsShowNewSystem: false,
      IsShowDeletedSystem: false,
      IsShowDele: true,
      IsShowNewLogo: false,
      Systemid: '',
      system: '',
      identification: '',
      new_file: ''
    }
  },
  beforeMount: function () {
    this.GetSystemList()
  },
  methods: {
    GetSystemList: function () {
      this.$http.get(this.$route.params.id + '/system')
      .then((response) => {
        this.Appsystem = response.data
        console.log(this.Appsystem)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    DeleteSystem: function (row) {
      this.$http.delete(this.$route.params.id + '/system', {params: {system_id: row.id}})
      .then((response) => {
        this.$http.get(this.$route.params.id + '/system')
        .then((response) => {
          this.Appsystem = response.data
          console.log(this.Appsystem)
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
        this.IsShowDeletedSystem = false
        this.IsShowDele = true
      } else {
        this.IsShowDeletedSystem = true
        this.IsShowDele = false
      }
      this.$http.get(this.$route.params.id + '/system', {params: {want_deleted: true}})
      .then((response) => {
        this.Appsystem = response.data
        console.log(this.Appsystem)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    ReviveSystem: function (row) {
      this.$http.put(this.$route.params.id + '/system', {system_id: row.id})
      .then((response) => {
        this.$http.get(this.$route.params.id + '/system', {params: {want_deleted: true}})
        .then((response) => {
          this.Appsystem = response.data
          console.log(this.Appsystem)
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
    },
    GetNewFile (event) {
      this.new_file = event.target.files[0]
      console.log(this.new_file)
    },
    UploadForm (event) {
      event.preventDefault()
      let formData = new FormData()
      formData.append('app_id', this.$route.params.id)
      formData.append('file', this.new_file)
      formData.append('identification', this.identification)
      formData.append('system', this.system)
      let config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
      this.$http.post(this.$route.params.id + '/system', formData, config)
      .then((response) => {
        this.$http.get(this.$route.params.id + '/system')
        .then((response) => {
          this.Appsystem = response.data
          console.log(this.Appsystem)
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
    },
    ShowVersionList: function (id) {
      console.log(id)
      this.$router.push({path: '/Applist/' + this.$route.params.id + '/Systemlist/' + id + '/Versionlist'})
    },
    AddLogo: function (row) {
      this.IsShowNewLogo = true
      this.Systemid = row.id
    },
    GetNewLogo: function () {
      this.new_logo = event.target.files[0]
      console.log(this.new_logo)
    },
    UploadNewLogo (event) {
      event.preventDefault()
      let formData = new FormData()
      formData.append('file', this.new_logo)
      formData.append('system_id', this.Systemid)
      let config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
      this.$http.post(this.Systemid + '/image', formData, config)
      .then((response) => {
        this.$http.get(this.$route.params.id + '/system')
        .then((response) => {
          this.Appsystem = response.data
          console.log(this.Appsystem)
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
    }
  }
}
</script>

<style scoped>
table{
  margin: 0px;
  padding: 0px;
  font-size: 15px;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  width: 100%;
  border-collapse: collapse;
}

thead{
  background-color: #2257c9;
  color: #ffffff;
  font-size: 20px;
}

.list{
  width: 90%;
  margin-top: 20px;
  margin-bottom: 200px;
  margin-left: auto;
  margin-right: auto;
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
  background-color: #2257c9;
  color: #ffffff;
}

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

.container button{
  margin: 0px auto 10px auto;
}

.create{
  position: fixed;
  height: auto;
  width: 30%;
  left:35%;
  top:40%;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  background-color: #ffffff;
}

.create p{
  height: auto;
}

.close{
  background-color: #2257c9;
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

.input-system{
  margin-top: 0px;
  margin-bottom: 10px;
  margin-left: auto;
  margin-right: auto;
  font-size: 20px;
  border-radius: 5px;
}

.input-system:hover{
  position: relative;
  bottom: 2px;
  right: 2px;
  border-radius: 5px;
  box-shadow: 1px 1px 2px rgba(0,0,0,.1), 0 0 3px rgba(0,0,0,.12);
  background-color: #2257c9;
}

.input-identification{
  margin-top: 10px;
  margin-bottom: 0px;
  margin-left: auto;
  margin-right: auto;
  font-size: 20px;
  border-radius: 5px;
}

.input-identification:hover{
  position: relative;
  bottom: 2px;
  right: 2px;
  border-radius: 5px;
  box-shadow: 1px 1px 2px rgba(0,0,0,.1), 0 0 3px rgba(0,0,0,.12);
  background-color: #2257c9;
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
  border: dotted #2257c9;
  padding: 30px 100px;
  border-radius: 5px;
  font-size: 12px;
  cursor: pointer;
}

#uploadnewfile::-webkit-file-upload-button:hover{
  position: relative;
  bottom: 1px;
  right: 1px;
  background-color: #2257c9;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
}

.showversionlist{
  width: auto;
  height: auto;
}

.imageurl{
  font-size: 5px;
}
</style>
