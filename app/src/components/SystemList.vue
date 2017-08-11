<template>
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
        <tr v-for="(index,entry) in dataList">
          <td v-for="col in columns">
            {{entry[col]}}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'list',
  props: ['dataList', 'columns']
}
</script>

<style scoped>
table{
  margin: 0px;
  padding: 0px;
  font-size: 20px;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  width: 100%;
  border-collapse: collapse;
}

thead{
  background-color: rgb(150,200,250);
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
