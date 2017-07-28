<template>
  <div class="apphistorylist">
    <HistoryList :data-list="Apphistory" :columns="AppColumns">
    </HistoryList>
  </div>
</template>

<script>
import HistoryList from './HistoryList'
export default {
  name: 'apphistorylist',
  data () {
    return {
      Apphistory: [],
      AppColumns: ['Id', 'File_url', 'Version', 'System', 'Create-time', 'Delete-time']
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
      this.$http.get('./history')
      .then((response) => {
        this.$set('Apphistory', response.history)
      })
      .catch(function (response) {
        console.log(response)
      })
    }
  }
}
</script>

<style scoped>
</style>
