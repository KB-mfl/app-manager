<template>
  <div class="appsystemlist">
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
          <tr v-for="row in Appsystem">
            <td v-for="col in columns">
              {{row[col]}}
            </td>
            <td>
              <button @click="deleteapp()">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: 'appsystemlist',
  data () {
    return {
      Appsystem: [],
      columns: ['id', 'app_id', 'logo_url', 'system', 'identification', 'deleted_at', 'created_at', 'updated_at']
    }
  },
  beforeMount: function () {
    this.getsystemlist()
  },
  methods: {
    getsystemlist: function () {
      console.log(this.$route.params)
      this.$http.get(this.$route.params.id + '/system')
      .then((response) => {
        this.Appsystem = response.data
        console.log(this.Appsystem)
      })
      .catch(function (error) {
        console.log(error)
      })
    }
  }
}
</script>

<style scoped>
table{
  margin: 0px;
  padding: 0px;
  font-size: 15px;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  width: 100%;
  border-collapse: collapse;
}

thead{
  background-color: #2ab27b;
  color: #ffffff;
  font-size: 20px;
}

td{
}

.list{
  width: 90%;
  margin-top: 20px;
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
  background-color: #2ab27b;
  color: #ffffff;
}
</style>
