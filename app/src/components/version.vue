<template>
  <div class="version">
    <Table :columns="columns1" :data="data1"></Table>
  </div>
</template>
<script>
  export default {
    name: 'version',
    data () {
      return {
        columns1: [
          {
            title: '',
            key: 'id'
          },
          {
            title: '',
            key: ''
          },
          {
            title: '',
            key: ''
          }
        ],
        data1: []
      }
    }
  }
</script>
<style scoped>
.version{
  width: 90%;
  margin-left: auto;
  margin-right: auto;
  height: 350px;
  margin-top: 50px;
  font-size: 30px;
}
</style>
