<template>
  <div class="apphistorylist">
    <div class="list">
      <table>
        <thead>
          <tr>
            <th v-for="col in columns">
              {{col}}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="row in Apphistory">
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
import HistoryList from './HistoryList'
export default {
  name: 'apphistorylist',
  data () {
    return {
      Apphistory: [],
      columns: ['id', 'file_url', 'version', 'system', 'create-time', 'Delete-time', 'Delete']
    }
  },
  components: {
    HistoryList
  },
  ready: function () {
    this.gethistorylist()
  },
  methods: {
    gethistorylist: function () {
      this.$http.get('history')
      .then((response) => {
        this.Apphistory = response.history
        console.log(this.AppHistory)
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
  font-size: 25px;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  width: 100%;
  border-collapse: collapse;
}

thead{
  background-color: #2ab27b;
  color: #ffffff;
}

th{
}

.list{
  width: 80%;
  margin-top: 20px;
  margin-left: auto;
  margin-right: auto;
}
</style>
