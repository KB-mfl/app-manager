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
            </tr>
          </thead>
          <tbody>
            <tr v-for="row in Feedback">
              <td v-for="col in Columns">
                {{row[col]}}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <p><button name="createnewfeedback" @click="CreateNewFeedback">Create</button></p>
  </div>
</template>

<script>
export default {
  name: 'Feedback',
  data () {
    return {
      Columns: ['id', 'user_id', 'app_id', 'feedback_id', 'title', 'created_at', 'updated_at'],
      Content: ['content'],
      Feedback: []
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
    CreateNewApp: function () {
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
</style>
