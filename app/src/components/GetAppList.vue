<template>
  <div class="AppList">
    <div>
      <div class="list">
        <table>
          <thead>
            <tr>
              <th v-for="col in Columns">
                {{col}}
              </th>
              <th v-if="IsShowDel">Delete</th>
              <th v-if="IsShowDeleted">Revive</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="row in AppData">
              <td v-for="col in Columns">
                {{row[col]}}
              </td>
              <td v-if="IsShowDel">
                <button @click="DeleteApp(row)">Delete</button>
              </td>
              <td v-if="IsShowDeleted">
                <button @click="ReviveApp(row)">Revive</button>
              </td>
              <td>
                <button class="showsystemlist" id="showsystemlist" @click="ShowSystemList(row.id)">Details</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <p>
        <button type="button" name="create" @click="CreateNewApp">Create</button>
        <button @click="ShowDeletedApp">Revive</button>
      </p>
    </div>
    <div class="back_ground"  v-show="IsShow">
    </div>
    <div class="container" v-show="IsShow">
      <div class="create">
        <p><button class="close" type="button" name="colse" @click="Close"><Icon type="close-round" size="12"></Icon></button></p>
        <div class="upload">
          <form class="uploader">
            <div class="inputer-1">
              <p><input v-model="Name" class="input-name" type="text" name="name" placeholder="Name"></p>
            </div>
            <br>
            <button type="submit" @click="UploadForm($event)">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AppList',
  data () {
    return {
      AppData: [],
      Columns: ['id', 'name', 'created_at', 'deleted_at', 'updated_at'],
      IsShow: false,
      IsShowDeleted: false,
      Name: '',
      IsShowDel: true
    }
  },
  beforeMount: function () {
    this.GetAppList()
  },
  methods: {
    GetAppList: function () {
      this.$http.get('applist')
      .then((response) => {
        this.AppData = response.data
        console.log(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    CreateNewApp: function () {
      this.IsShow = true
    },
    Close: function () {
      this.IsShow = false
    },
    UploadForm (event) {
      event.preventDefault()
      let formData = new FormData()
      formData.append('name', this.Name)
      let config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
      this.$http.post('addapp', formData, config)
      .then((response) => {
        console.log('success')
        this.$http.get('applist')
        .then((response) => {
          this.AppData = response.data
          console.log(this.AppData)
        })
        .catch(function (error) {
          console.log(error)
        })
      })
      .catch(function (error) {
        console.log(error)
      })
      this.IsShow = false
    },
    DeleteApp: function (row) {
      console.log(row.id)
      this.$http.delete(row.id + '/deleteapp', row.id)
      .then((response) => {
        this.$http.get('applist')
        .then((response) => {
          this.AppData = response.data
          console.log(this.AppData)
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
    ReviveApp: function (row) {
      this.$http.put(row.id + '/readapp', row.id)
      .then((response) => {
        this.$http.get('applist', {params: {want_deleted: true}})
        .then((response) => {
          this.AppData = response.data
          console.log(this.AppData)
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
    ShowDeletedApp: function () {
      if (this.IsShowDeleted === true) {
        this.IsShowDeleted = false
        this.IsShowDel = true
      } else {
        this.IsShowDeleted = true
        this.IsShowDel = false
      }
      this.$http.get('applist', {params: {want_deleted: true}})
      .then((response) => {
        this.AppData = response.data
        console.log(this.AppData)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    ShowSystemList: function (id) {
      console.log(id)
      this.$router.push({path: '/Applist/' + id + '/Systemlist'})
    }
  }
}
</script>

<style scoped>
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
  top:40%;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  background-color: #ffffff;
}

.create p{
  height: auto;
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
  display: inline-block;
  margin: 0px;
}

.input-name{
  margin: auto 0px;
  font-size: 20px;
  border-radius: 5px;
}

.input-name:hover{
  position: relative;
  bottom: 2px;
  right: 2px;
  border-radius: 5px;
  box-shadow: 1px 1px 2px #2ab27b, 0 0 3px #2ab27b;
  color: #000000;
}

.list{
  width: 90%;
  margin-top: 20px;
  margin-left: auto;
  margin-right: auto;
}

table{
  margin: 0px;
  padding: 0px;
  font-size: 25px;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  width: 100%;
  border-collapse: collapse;
}

thead{
  background-color: #2ab27b;
  color: #ffffff;
}

.showsystemlist{
  width: auto;
  height: auto;
}

label:hover {
  color: #2ab27b;
  cursor: pointer;
}
</style>
