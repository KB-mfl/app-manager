<template>
  <div class="appsystemlist">
    <div class="list">
      <table>
        <thead>
          <tr>
            <th v-for="col in columns">
              {{col}}
            </th>
            <th v-if="isshowdele">Delete</th>
            <th v-if="isshowdeletedsystem">Revive</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="row in Appsystem">
            <td v-for="col in columns">
              {{row[col]}}
            </td>
            <td v-if="isshowdele">
              <button @click="deletesystem(row)">Delete</button>
            </td>
            <td v-if="isshowdeletedsystem">
              <button @click="revivesystem(row)">Revive</button>
            </td>
            <td>
              <button class="showversionlist" id="showversionlist" @click="showversionlist(row.id)">Details</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <p>
      <button type="button" name="create" @click="createnewsystem">Create</button>
      <button @click="showdeletedsystem">Revive</button>
    </p>
    <div class="back_ground" v-show="isshownewsystem">
    </div>
    <div class="container" v-show="isshownewsystem">
      <div class="create">
        <p class="close"><button class="close" type="button" name="colse" @click="close"><Icon type="close-round" size="12"></Icon></button></p>
        <div class="upload">
          <form class="uploader">
            <div class="inputer-1">
              <p><input v-model="system" class="input-system" type="text" name="system" placeholder="System"></p>
              <p><input v-model="identification" class="input-identification" type="text" name="identification" placeholder="Identification"></p>
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
</template>

<script>
export default {
  name: 'appsystemlist',
  data () {
    return {
      Appsystem: [],
      columns: ['id', 'app_id', 'logo_url', 'system', 'identification', 'deleted_at', 'created_at', 'updated_at'],
      isshownewsystem: false,
      isshowdeletedsystem: false,
      system: '',
      identification: '',
      new_file: '',
      isshowdele: true
    }
  },
  beforeMount: function () {
    this.getsystemlist()
  },
  methods: {
    getsystemlist: function () {
      this.$http.get(this.$route.params.id + '/system')
      .then((response) => {
        this.Appsystem = response.data
        console.log(this.Appsystem)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    deletesystem: function (row) {
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
    showdeletedsystem: function () {
      if (this.isshowdeletedsystem === true) {
        this.isshowdeletedsystem = false
        this.isshowdele = true
      } else {
        this.isshowdeletedsystem = true
        this.isshowdele = false
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
    revivesystem: function (row) {
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
    createnewsystem: function () {
      this.isshownewsystem = true
    },
    close: function () {
      this.isshownewsystem = false
    },
    getnewfile (event) {
      this.new_file = event.target.files[0]
      console.log(this.new_file)
    },
    uploadform (event) {
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
      this.isshownewsystem = false
    },
    showversionlist: function (id) {
      console.log(id)
      this.$router.push({path: '/Applist/' + this.$route.params.id + '/Systemlist/' + id + '/Versionlist'})
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
  background-color: #2ab27b;
  color: #ffffff;
  font-size: 20px;
}

td{
}

.list{
  width: 90%;
  margin-top: 20px;
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
  background-color: #2ab27b;
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

.showversionlist{
  width: auto;
  height: auto;
}
</style>
