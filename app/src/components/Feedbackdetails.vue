<template>
  <div class="feedbackdetails">
    <Navbar></Navbar>
    <div class="list-1">
      <table>
        <thead>
          <tr v-for="row in Feedback" v-if="row.id == feedbackid">
            <th>{{row.title}}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="row in Feedback" v-if="row.id == feedbackid">
            <td>
              <textarea class="input-default-feedback" name="contents" readonly="readonly">{{row.contents}}</textarea>
              <p class="time"><span>created_at: {{row.created_at}}</span> <span>updated_at: {{row.updated_at}}</span></p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <br>
    <div class="list-2">
      <table>
        <tbody>
          <tr v-for="row in Feedback" v-if="row.feedback_id == feedbackid">
            <td>
              <div class="title">
                <p class="fdtitle">{{row.title}}</p>
              </div>
              <textarea class="input-default-reply" name="contents" rows="3" cols="60" readonly="readonly">{{row.contents}}</textarea>
              <p class="time"><span>created_at: {{row.created_at}}</span> <span>updated_at: {{row.updated_at}}</span></p>
              <button @click="DeleteFeedback(row)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <p>
      <button class="btn-back" @click="Back">Back</button>
    </p>
  </div>
</template>

<script>
import Navbar from './Navbar'
export default {
  name: 'feedbackdetails',
  components: {
    Navbar
  },
  data () {
    return {
      Feedback: [],
      Columns: ['id', 'username'],
      Time: ['created_at', 'updated_at'],
      Feedbackcontent: ['id', 'title', 'contents'],
      feedbackid: ''
    }
  },
  beforeMount: function () {
    this.feedbackid = this.$route.params.feedbackid
    this.state = sessionStorage.state
    this.apiToken = sessionStorage.apiToken
    this.username = sessionStorage.username
    this.admin = sessionStorage.admin
    if (this.state !== 'true') {
      this.$router.push({path: '/Login'})
      this.$Loading.error()
    }
    this.GetFeedbackList()
  },
  methods: {
    GetFeedbackList: function () {
      this.$http.get('app/' + this.$route.params.id + '/feedback', {params: {apiToken: this.apiToken, username: this.username}})
      .then((response) => {
        this.Feedback = response.data
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    DeleteFeedback: function (row) {
      this.$http.delete('app/' + this.$route.params.id + '/feedback', {params: {feedback_id: row.id, apiToken: this.apiToken, username: this.username}})
      .then((response) => {
        this.$http.get('app/' + this.$route.params.id + '/feedback', {params: {apiToken: this.apiToken, username: this.username}})
        .then((response) => {
          this.Feedback = response.data
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
      this.$router.push({path: '/Applist/' + this.$route.params.id + '/Feedback'})
    }
  }
}
</script>

<style scoped>
.time{
  margin-left: 50%;
  font-size: 5px;
}

.title{
  height: auto;
  width: 100%;
}

.fdtitle{
  margin: 0px 88% 0px auto;
  font-size: 20px;
}

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

.btn-create{
  display: inline-block;
  border-radius: 4px;
  background-color: #2257c9;
  border: none;
  color: #FFF;
  text-align: center;
  font-size: 15px;
  padding: 10px;
  width: auto;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  border: 1px solid;
  border-color: #2257c9;
}

.btn-back{
  display: inline-block;
  border-radius: 4px;
  background-color: #2257c9;
  border: none;
  color: #FFF;
  text-align: center;
  font-size: 15px;
  padding: 10px;
  width: auto;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  border: 1px solid;
  border-color: #2257c9;
}

.btn-submit{
  display: inline-block;
  border-radius: 4px;
  background-color: #2257c9;
  border: none;
  color: #FFF;
  text-align: center;
  font-size: 15px;
  padding: 10px;
  width: auto;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  border: 1px solid;
  border-color: #2257c9;
}

.btn-create:hover{
  display: inline-block;
  border-radius: 4px;
  background-color: #FFF;
  border: none;
  color: #2257c9;
  text-align: center;
  font-size: 15px;
  padding: 10px;
  width: auto;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  border: 1px solid;
  border-color: #2257c9;
}


.btn-back:hover{
  display: inline-block;
  border-radius: 4px;
  background-color: #FFF;
  border: none;
  color: #2257c9;
  text-align: center;
  font-size: 15px;
  padding: 10px;
  width: auto;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  border: 1px solid;
  border-color: #2257c9;
}

.btn-submit:hover{
  display: inline-block;
  border-radius: 4px;
  background-color: #FFF;
  border: none;
  color: #2257c9;
  text-align: center;
  font-size: 15px;
  padding: 10px;
  width: auto;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  border: 1px solid;
  border-color: #2257c9;
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
  top:25%;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  background-color: #ffffff;
}

.create p{
  height: auto;
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

.close-p{
  background-color: #2257c9;
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
.inputer{
  height: auto;
  width: 100%;
  margin-bottom: 5%;
}

.input-p{
  font-size: 20px;
  color: #2257c9;
  margin-bottom: 2%;
  margin-top: 2%;
}

input:-webkit-autofill{
-webkit-box-shadow: 0 0 0px 1000px #FFFFFF inset !important;
-webkit-text-fill-color: #000000;
}

.input-default{
  width: 30%;
  font-size: 15px;
  border-left: 0px;
  border-right: 0px;
  border-top: 2px solid;
  border-bottom: 2px solid;
  border-color: #66ccff;
  caret-color: #66ccff;
  color: #A2A3A2;
  text-align: center;
  vertical-align: middle;
}

.input-default-feedback{
  width: 80%;
  height: 170px;
  font-size: 15px;
  border-left: 1px solid;
  border-right: 1px solid;
  border-top: 1px solid;
  border-bottom: 1px solid;
  border-color: #66ccff;
  caret-color: #66ccff;
  color: #2A8FBD;
  vertical-align: middle;
  outline: none;
  resize: none;
}

table tr:nth-child(odd) .input-default-reply{
  width: 80%;
  height: 170px;
  font-size: 15px;
  border: 0px;
  color: #73C5FF;
  background-color: #FFF;
  vertical-align: middle;
  outline: none;
  resize: none;
}

table tr:nth-child(even) .input-default-reply{
  width: 80%;
  height: 170px;
  font-size: 15px;
  border: 0px;
  color: #FFF;
  background-color: #73C5FF;
  vertical-align: middle;
  outline: none;
  resize: none;
}

.input-default:focus{
  width: 30%;
  font-size: 15px;
  border-left: 0px;
  border-right: 0px;
  border-top: 2px solid;
  border-bottom: 2px solid;
  border-color: #66ccff;
  caret-color: #66ccff;
  color: #A2A3A2;
  text-align: center;
  vertical-align: middle;
  outline: none;
  -webkit-animation: actived 0.5s;
  -webkit-animation-fill-mode: forwards;
}

@-webkit-keyframes actived{
  0% {-webkit-transform:scale(1);transform:scale(1);}
  100% {-webkit-transform:scale(1.5);transform:scale(1.5);}
}

.inputback{
  width: 30%;
  font-size: 15px;
  border-left: 0px;
  border-right: 0px;
  border-top: 2px solid;
  border-bottom: 2px solid;
  border-color: #66ccff;
  caret-color: #66ccff;
  color: #A2A3A2;
  text-align: center;
  vertical-align: middle;
  outline: none;
  -webkit-animation: back 1s;
  -webkit-animation-fill-mode: forwards;
  -webkit-animation-delay: -0.5s;
}

@-webkit-keyframes back{
  0% {-webkit-transform:scale(1);transform:scale(1);}
  50% {-webkit-transform:scale(1.5);transform:scale(1.5);}
  100% {-webkit-transform:scale(1);transform:scale(1);}
}
/*-----表格-----*/
.list-1{
  width: 100%;
  margin-top:  20px;
  margin-left: auto;
  margin-right: auto;
}

.list-2{
  width: 100%;
  margin-bottom: 20px;
  margin-left: auto;
  margin-right: auto;
}

table thead, table tr {
  border-top-width: 2px;
  border-top-style: solid;
  border-top-color: #2257c9;
}

table {
  width: 80%;
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
