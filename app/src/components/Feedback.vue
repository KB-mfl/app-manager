<template>
  <div class="Feedback">
    <div class="list">
      <table>
        <thead>
          <tr>
            <th v-for="col in Columns">
              {{col}}
            </th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="row in Feedback">
            <td v-for="col in Columns" @mouseenter="ShowContent(row.id)" @mouseleave="HideContent()">
              {{row[col]}}
            </td>
            <td>
              <button name="deletefeedback" @click="DeleteFeedback(row)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <p>
      <button name="createnewfeedback" @click="CreateNewFeedback(row)">Create</button>
      <button @click="Back">Back</button>
    </p>
    <div class="back_ground"  v-show="IsShowNewFeedback">
    </div>
    <div class="container" v-show="IsShowNewFeedback">
      <div class="create">
        <p class="close"><button class="close" type="button" name="colse" @click="Close"><Icon type="close-round" size="12"></Icon></button></p>
        <div class="upload">
          <form class="uploader">
            <div class="inputer-1">
              <p><input v-model="Userid" type="hidden" name="user_id"></p>
              <p><input v-model="Appid" type="hidden" name="user_id"></p>
              <p><input v-model="Feedbackid" type="hidden" name="feedback_id"></p>
              <p><input v-model="Title" class="input-title" type="text" name="title" placeholder="Title"></p>
              <p><textarea v-model="Content" class="input-content" name="content"></textarea></p>
            </div>
            <br>
            <button type="submit" @click="UploadForm($event)">Submit</button>
          </form>
        </div>
      </div>
    </div>
    <div class="content" v-show="IsShowContent">
      <table>
        <thead>
          <tr>
            <th v-for="col in Feedbackcontent">
              {{col}}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="row in Feedback" v-if="row.id == Id">
            <td v-for="col in Feedbackcontent">
              {{row[col]}}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Feedback',
  data () {
    return {
      Feedback: [],
      Columns: ['id', 'user_id', 'app_id', 'title', 'created_at', 'updated_at'],
      Feedbackcontent: ['content'],
      Title: '',
      Content: '',
      Userid: '',
      Appid: '',
      Id: '',
      Feedbackid: '',
      IsShowNewFeedback: false,
      IsShowContent: false
    }
  },
  beforeMount: function () {
    this.GetFeedbackList()
  },
  methods: {
    GetFeedbackList: function () {
      this.$http.get('/' + this.$route.params.id + '/feedback')
      .then((response) => {
        this.Feedback = response.data
        console.log(this.Feedback)
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    CreateNewFeedback: function (row) {
      this.IsShowNewFeedback = true
      this.Userid = row.user_id
      this.Appid = row.app_id
      this.Feedbackid = row.feedback_id
    },
    Close: function () {
      this.IsShowNewFeedback = false
    },
    UploadForm (event) {
      event.preventDefault()
      let formData = new FormData()
      formData.append('title', this.Title)
      formData.append('user_id', this.Userid)
      formData.append('app-id', this.Appid)
      formData.append('feedback_id', this.Feedbackid)
      formData.append('content', this.Content)
      let config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
      this.$http.post('/' + this.$route.params.id + '/feedback', formData, config)
      .then((response) => {
        this.$http.get('/' + this.$route.params.id + '/feedback')
        .then((response) => {
          this.Feedback = response.data
          console.log(this.Feedback)
        })
        .catch(function (error) {
          console.log(error)
        })
      })
      .catch(function (error) {
        console.log(error)
      })
      this.IsShowNewFeedback = false
    },
    DeleteFeedback: function (row) {
      this.$http.delete('/' + this.$route.params.id + '/feedback', {params: {feedback_id: row.feedback_id}})
      .then((response) => {
        this.$http.get('/' + this.$route.params.id + '/feedback')
        .then((response) => {
          this.Feedback = response.data
          console.log(this.Feedback)
        })
        .catch(function (error) {
          console.log(error)
        })
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    Back: function () {
      this.$router.push({path: '/Applist'})
    },
    ShowContent: function (id) {
      this.IsShowContent = true
      this.Id = id
    },
    HideContent: function () {
      this.IsShowContent = false
    }
  }
}
</script>

<style scoped>
.Feedback{
  margin: 0px auto;
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
  top:20%;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  background-color: #ffffff;
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

.content{
  position: fixed;
  height: 400px;
  width: 21%;
  right: 0%;
  top: 20%;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  background-color: #ffffff;
  word-break:break-all;
}

.close{
  background-color: #2257c9;
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

.input-title{
  margin: 0px auto;
  font-size: 20px;
  border-radius: 5px;
}

.input-title:hover{
  position: relative;
  bottom: 2px;
  right: 2px;
  border-radius: 5px;
  box-shadow: 1px 1px 2px #2257c9, 0 0 3px #2257c9;
  color: #000000;
}

.input-content{
  margin: 10px auto;
  padding: 0px;
  font-size: 15px;
  width: 100%;
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
</style>
