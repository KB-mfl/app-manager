<template>
  <div class="fsdetails">
    <table>
      <thead>
        <tr>
          <th v-for="col in Imageurl">
            {{col}}
          </th>
          <th v-for="col in FirstscreenContent">
            {{col}}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr class="info" v-for="row in Firstscreen" v-if="row.id == Fsid">
          <td v-for="col in Imageurl">
            {{row[col]}}
          </td>
          <td v-for="col in FirstscreenContent">
            {{row[col]}}
          </td>
        </tr>
      </tbody>
    </table>
    <p>
      <button @click="Back">Back</button>
    </p>
  </div>
</template>

<script>
export default {
  name: 'fsdetails',
  data () {
    return {
      Firstscreen: [],
      Columns: ['id', 'app_id', 'created_at', 'updated_at', 'actived'],
      FirstscreenContent: ['content'],
      Imageurl: ['image_url'],
      Fsid: this.$route.params.firstscreenid
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
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    Back: function () {
      this.$router.push({path: '/Applist/' + this.$route.params.id + '/Firstscreen'})
    }
  }
}
</script>

<style scoped>
.fsdetails{
  width: 80%;
  height: auto;
  margin: 20px auto 50px auto;
}

table{
  margin: 0px auto 0px auto;
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
  margin-bottom: 200px;
  margin-left: auto;
  margin-right: auto;
}

.info{
  height: 500px;
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
</style>
