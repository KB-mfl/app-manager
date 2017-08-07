<template>
  <div class="AppList">
    <div class="list">
      <table>
        <thead>
          <tr>
            <th v-for="col in columns">
              {{col}}
            </th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="row in AppData">
            <td v-for="col in columns">
              {{row[col]}}
            </td>
            <td>
              <button @click="deleteapp(row)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <p><button type="button" name="create" @click="createnewapp">Create</button></p>
    <div class="back_ground"  v-show="isshow">
    </div>
    <div class="container" v-show="isshow">
      <div class="create">
        <p><button  class="close" type="button" name="colse" @click="colse"><Icon type="close-round" size="12"></Icon></button></p>
        <div class="upload">
          <form class="uploader">
            <div class="inputer-1">
              <p><input v-model="name" class="input-name" type="text" name="name" placeholder="Name"></p>
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
  name: 'AppList',
  data () {
    return {
      AppData: [],
      columns: ['id', 'name', 'created_at', 'deleted_at', 'updated_at'],
      isshow: false,
      name: ''
    }
  },
  beforeMount: function () {
    this.getapplist()
  },
  methods: {
    getapplist: function () {
      this.$http.get('applist')
      .then((response) => {
        this.AppData = response.data
        console.log(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    createnewapp: function () {
      this.isshow = true
    },
    colse: function () {
      this.isshow = false
    },
    uploadform (event) {
      event.preventDefault()
      let formData = new FormData()
      formData.append('name', this.name)
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
      this.isshow = false
    },
    deleteapp: function (row) {
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
    }
  }
}
</script>

<style scoped>
button{
  font-size: 15px;
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
  height: 180%;
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  background-color: #000000;
  opacity: 0.5;
}

.container{
  height: 180%;
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
}

.create{
  height: auto;
  width: 30%;
  margin-top: 50%;
  margin-left: auto;
  margin-right: auto;
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
  width: 80%;
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
</style>
