<template>
  <div class="data">
    <div>
      <div class="list">
        <table>
          <thead>
            <tr>
              <th v-for="col in Columns">
                {{col}}
              </th>
              <th v-if="IsShowDel">Delete</th>
              <th v-if="IsShowEdit">Edit</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="row in Data">
              <td v-for="col in Columns">
                {{row[col]}}
              </td>
              <td v-if="IsShowDel">
                <button @click="DeleteData(row)">Delete</button>
              </td>
              <td v-if="IsShowEdit">
                <button @click="EditData(row)">Edit</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <p>
        <button type="button" name="create" @click="CreateNewData">Create</button>
        <button @click="ShowEdit">Edit</button>
      </p>
    </div>
    <div class="back_ground" v-show="IsShow">
    </div>
    <div class="container" v-show="IsShow">
      <div class="create">
        <p class="close"><button class="close" type="button" name="colse" @click="Close"><Icon type="close-round" size="12"></Icon></button></p>
        <div class="upload">
          <form class="uploader">
            <div class="inputer-1">
              <p><input v-model="Key" class="input-key" type="text" name="key" placeholder="Key"></p>
              <p><input v-model="Value" class="input-value" type="text" name="value" placeholder="Value"></p>
            </div>
            <br>
            <button type="submit" @click="UploadForm($event)">Save</button>
          </form>
        </div>
      </div>
    </div>
    <div class="back_ground" v-show="IsShowEditor">
    </div>
    <div class="container" v-show="IsShowEditor">
      <div class="editor">
        <p class="close"><button class="close" type="button" name="colse" @click="Close"><Icon type="close-round" size="12"></Icon></button></p>
        <div class="upload">
          <form class="uploader">
            <div class="inputer-1">
              <p><input v-model="Keys" class="input-key" type="text" name="key" :placeholder="Keys"></p>
              <p><input v-model="Values" class="input-value" type="text" name="value" :placeholder="Values"></p>
            </div>
            <br>
            <button type="submit" @click="Reset($event)">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'data',
  data () {
    return {
      Data: [],
      Columns: ['key', 'value', 'created_at', 'updated_at'],
      Key: '',
      Value: '',
      Keys: '',
      Values: '',
      IsShow: false,
      IsShowDel: true,
      IsShowEdit: false,
      IsShowEditor: false
    }
  },
  beforeMount: function () {
    this.GetData()
  },
  methods: {
    GetData: function () {
      this.$http.get('data')
      .then((response) => {
        this.Data = response.data
        console.log(this.Data)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    DeleteData: function (row) {
      this.$http.delete('data', {params: {key: row.key}})
      .then((response) => {
        this.$http.get('data')
        .then((response) => {
          this.Data = response.data
          console.log(this.Data)
        })
        .catch(function (error) {
          console.log(error)
        })
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    CreateNewData: function () {
      this.IsShow = true
    },
    Close: function () {
      this.IsShow = false
    },
    UploadForm (event) {
      event.preventDefault()
      let formData = new FormData()
      formData.append('key', this.Key)
      formData.append('value', this.Value)
      let config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
      this.$http.post('data', formData, config)
      .then((response) => {
        this.$http.get('data')
        .then((response) => {
          this.Data = response.data
          console.log(this.Data)
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
    ShowEdit: function () {
      if (this.IsShowEdit === false) {
        this.IsShowEdit = true
        this.IsShowDel = false
      } else {
        this.IsShowEdit = false
        this.IsShowDel = true
      }
    },
    EditData: function (row) {
      this.IsShowEditor = true
      this.Keys = row.key
      this.Values = row.value
    },
    Reset (event) {
      event.preventDefault()
      let formData = new FormData()
      formData.append('key', this.Keys)
      formData.append('value', this.Values)
      let config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
      this.$http.put('data', formData, config)
      .then((response) => {
        this.$http.get('data')
        .then((response) => {
          this.Data = response.data
          console.log(this.Data)
        })
        .catch(function (error) {
          console.log(error)
        })
      })
      .catch(function (error) {
        console.log(error)
      })
      this.IsShowEditor = false
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

.create{
  position: fixed;
  height: auto;
  width: 30%;
  left:35%;
  top:40%;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  background-color: #ffffff;
}

.close{
  background-color: #2257c9;
}

.create p{
  height: auto;
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

.editor{
  position: fixed;
  height: auto;
  width: 30%;
  left:35%;
  top:40%;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  background-color: #ffffff;
}

.editor p{
  height: auto;
}

.editor p button{
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

.input-key{
  margin: 0px auto;
  font-size: 20px;
  border-radius: 5px;
}

.input-key:hover{
  position: relative;
  bottom: 2px;
  right: 2px;
  border-radius: 5px;
  box-shadow: 1px 1px 2px #2257c9, 0 0 3px #2257c9;
  color: #000000;
}

.input-value{
  margin: 10px auto 0px auto;
  font-size: 20px;
  border-radius: 5px;
}

.input-value:hover{
  position: relative;
  bottom: 2px;
  right: 2px;
  border-radius: 5px;
  box-shadow: 1px 1px 2px #2257c9, 0 0 3px #2257c9;
  color: #000000;
}

.list{
  width: 90%;
  margin-top: 20px;
  margin-bottom: 200px;
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
  background-color: #2257c9;
  color: #ffffff;
}
</style>
