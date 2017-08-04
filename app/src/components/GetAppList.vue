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
      AppColumns: ['Id', 'Name', 'Create-time', 'Delete-time', 'Updata-time', 'Delete']
    }
  },
  components: {
    Appinfolist
  },
  ready: function () {
    this.getapplist()
  },
  methods: {
    getapplist: function () {
      this.$http.get('applist')
      .then((response) => {
        this.$set('AppData', response.data)
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
