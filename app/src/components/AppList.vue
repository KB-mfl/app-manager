<template>
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
        <tr v-for="AppData in dataList">
          <td v-for="col in columns">
            {{AppData[col]}}
          </td>
          <td>
            <button @click="deleteapp">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'list',
  props: ['dataList', 'columns'],
  methods: {
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

.list{
  width: 80%;
  margin-top: 20px;
  margin-left: auto;
  margin-right: auto;
}
</style>
