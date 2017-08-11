<template>
  <div class="Feedback">
    <div>
      <div class="list">
        <table>
          <thead>
            <tr>
              <th v-for="col in Columns">
                {{col}}
              </th>
              <th>
                Create
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="row in Feedback">
              <td v-for="col in Columns">
                {{row[col]}}
              </td>
              <td>
                <button name="createnewfeedback" @click="CreateNewFeedback(row)">Create</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="back_ground"  v-show="IsShowNewFeedback">
    </div>
    <div class="container" v-show="IsShowNewFeedback">
      <div class="create">
        <p class="close"><button class="close" type="button" name="colse" @click="Close"><Icon type="close-round" size="12"></Icon></button></p>
        <div class="upload">
          <form class="uploader">
            <div class="inputer-1">
              <p><input v-model="title" class="input-title" type="text" name="title" placeholder="Title"></p>
              <p><textarea v-model="content" class="input-content" name="content"></textarea></p>
            </div>
            <br>
            <button type="submit" @click="UploadForm($event)">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Feedback',
  data () {
    return {
      Columns: ['id', 'user_id', 'app_id', 'feedback_id', 'title', 'created_at', 'updated_at'],
      Feedback: [],
      title: '',
      content: '',
      IsShowNewFeedback: false
    }
  },
  beforeMount: function () {
    this.GetFeedbackList()
  },
  methods: {
    GetFeedbackList: function () {
      this.$htttp.get('/feedback')
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
    },
    Close: function () {
      this.IsShowNewFeedback = false
    },
    UploadForm (event) {
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
  background-color: #2ab27b;
  color: #ffffff;
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

.close{
  background-color: #2ab27b;
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
  box-shadow: 1px 1px 2px #2ab27b, 0 0 3px #2ab27b;
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
  box-shadow: 1px 1px 2px #2ab27b, 0 0 3px #2ab27b;
  color: #000000;
}
</style>
