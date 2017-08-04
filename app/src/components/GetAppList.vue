<template>
  <div class="AppList">
    <Appinfolist :data-list="AppData" :columns="AppColumns"></Appinfolist>
  </div>
</template>

<script>
import Appinfolist from './AppList'
export default {
  name: 'AppList',
  data () {
    return {
      AppData: [],
      AppColumns: ['id', 'name', 'created_at', 'deleted_at', 'updated_at']
    }
  },
  components: {
    Appinfolist
  },
  beforeMount: function () {
    this.getapplist()
  },
  methods: {
    getapplist: function () {
      this.$http.get('applist')
      .then((response) => {
        this.AppData = response.data
        console.log(this.AppData)
      })
      .catch(function (error) {
        console.log(error)
      })
    }
  }
}
</script>

<style scoped>
</style>
