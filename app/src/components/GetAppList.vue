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
              <th>Data</th>
              <th>Firstscreen</th>
              <th>Feedback</th>
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
                <button class="showsystemlist" id="showsystemlist" @click="ShowSystemList(row.id)"><span>Details</span></button>
              </td>
              <td>
                <button @click="Data(row)"><span>Data</span></button>
              </td>
              <td>
                <button @click="Firstscreen(row)"><span>Firstscreen</span></button>
              </td>
              <td>
                <button @click="Feedback(row)"><span>Feedback</span></button>
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
        this.$http.get('applist', {params: {want_deleted: false}})
        .then((response) => {
          this.AppData = response.data
          console.log(this.AppData)
        })
        .catch(function (error) {
          console.log(error)
        })
        this.IsShowDeleted = false
        this.IsShowDel = true
      } else {
        this.$http.get('applist', {params: {want_deleted: true}})
        .then((response) => {
          this.AppData = response.data
          console.log(this.AppData)
        })
        .catch(function (error) {
          console.log(error)
        })
        this.IsShowDeleted = true
        this.IsShowDel = false
      }
    },
    ShowSystemList: function (id) {
      console.log(id)
      this.$router.push({path: '/Applist/' + id + '/Systemlist'})
    },
    Firstscreen: function (row) {
      console.log(row.id)
      this.$router.push({path: '/Applist/' + row.id + '/Firstscreen'})
    },
    Data: function (row) {
      console.log(row.id)
      this.$router.push({path: '/Applist/' + row.id + '/Data'})
    },
    Feedback: function (row) {
      console.log(row.id)
      this.$router.push({path: '/Applist/' + row.id + '/Feedback'})
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

.showsystemlist{
  width: auto;
  height: auto;
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
  top:40%;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  background-color: #ffffff;
}

.create p{
  height: auto;
  background-color: #2257c9;
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

/*-----输入框-----*/
/*-----表格-----*/
.list{
  width: 100%;
  margin-top:  20px;
  margin-bottom: 200px;
  margin-left: auto;
  margin-right: auto;
}

table thead, table tr {
  border-top-width: 2px;
  border-top-style: solid;
  border-top-color: #2257c9;
}

table {
  width: 95%;
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
