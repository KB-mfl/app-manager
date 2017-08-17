<template>
  <div class="firstscreen">
    <div class="list">
      <table>
        <thead>
          <tr>
            <th v-for="col in Columns">
              {{col}}
            </th>
            <th v-if="IsShowDel">Delete</th>
            <th v-if="IsShowActive">Active</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="row in Firstscreen">
            <td v-for="col in Columns">
              {{row[col]}}
            </td>
            <td v-if="IsShowDel">
              <button @click="DeleteFSPush(row)">Delete</button>
            </td>
            <td v-if="IsShowActive">
              <button @click="ActiveFSPush(row)">Active</button>
            </td>
            <td>
              <button @click="ShowDetails(row)">Details</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <p>
      <button type="button" name="create" @click="CreateNewFSPush">Create</button>
      <button @click="ShowActive">Active</button>
      <button @click="Back">Back</button>
    </p>
    <div class="back_ground" v-show="IsShowNewFSPush">
    </div>
    <div class="container" v-show="IsShowNewFSPush">
      <div class="create">
        <p class="close"><button class="close" type="button" name="colse" @click="Close"><Icon type="close-round" size="12"></Icon></button></p>
        <div class="upload">
          <form class="uploader">
            <div class="inputer-2">
              <p><input v-model="Appid" type="hidden" name="app_id"></p>
              <p><textarea v-model="Content" class="input-content" name="content"></textarea></p>
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
  name: 'firstscreen',
  data () {
    return {
      Firstscreen: [],
      Columns: ['id', 'app_id', 'created_at', 'updated_at', 'actived'],
      FirstscreenContent: ['content'],
      Imageurl: ['image_url'],
      Appid: '',
      Content: '',
      IsShowDel: true,
      IsShowActive: false,
      IsShowNewFSPush: false
    }
  },
  beforeMount: function () {
    this.GetFirstscreen()
  },
  methods: {
    GetFirstscreen: function () {
      this.$http.get('/' + this.$route.params.id + '/first_screen')
      .then((response) => {
        this.Firstscreen = response.data
        console.log(this.Firstscreen)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    ShowActive: function () {
      if (this.IsShowActive === true) {
        this.IsShowActive = false
        this.IsShowDel = true
      } else {
        this.IsShowActive = true
        this.IsShowDel = false
      }
    },
    DeleteFSPush: function (row) {
      this.$http.delete('/' + this.$route.params.id + '/first_screen', {params: {first_screen_id: row.id}})
      .then((response) => {
        this.$http.get('/' + this.$route.params.id + '/first_screen')
        .then((response) => {
          this.Firstscreen = response.data
          console.log(this.Firstscreen)
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
    ActiveFSPush: function (row) {
      this.$http.put('/' + this.$route.params.id + '/first_screen', {first_screen_id: row.id})
      .then((response) => {
        this.$http.get('/' + this.$route.params.id + '/first_screen')
        .then((response) => {
          this.Firstscreen = response.data
          console.log(this.Firstscreen)
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
    CreateNewFSPush: function () {
      this.IsShowNewFSPush = true
    },
    Close: function () {
      this.IsShowNewFSPush = false
    },
    GetNewLogo: function () {
      this.new_logo = event.target.files[0]
      console.log(this.new_logo)
    },
    UploadNewLogo (event) {
      event.preventDefault()
      let formData = new FormData()
      formData.append('file', this.new_logo)
      formData.append('app_id', this.Appid)
      formData.append('content', this.Content)
      let config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
      this.$http.post('/' + this.$route.params.id + '/first_screen', formData, config)
      .then((response) => {
        this.$http.get('/' + this.$route.params.id + '/first_screen')
        .then((response) => {
          this.Firstscreen = response.data
          console.log(this.Firstscreen)
        })
        .catch(function (error) {
          console.log(error)
        })
        console.log('success')
      })
      .catch(function (error) {
        console.log(error)
      })
      this.IsShowNewFSPush = false
    },
    Back: function () {
      this.$router.push({path: '/Applist'})
    },
    ShowDetails: function (row) {
      this.$router.push({path: '/Applist/' + this.$route.params.id + '/Firstscreen/' + row.id})
    }
  }
}
</script>

<style scoped>
table{
  margin: 0px;
  padding: 0px;
  font-size: 18px;
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
  top:20%;
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

.input-content{
  margin: 10px auto;
  padding: 0px;
  font-size: 15px;
  width: 80%;
  height: 200px;
}

.input-content:hover{
  position: relative;
  bottom: 2px;
  right: 2px;
  border-radius: 5px;
  box-shadow: 1px 1px 2px #2257c9, 0 0 3px #2257c9;
  color: #000000;
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
</style>
