<template>
  <div class="AppList">
    <Appinfolist :data-list="AppData" :columns="AppColumns">
    </Appinfolist>
  </div>
</template>

<script>
import Appinfolist from './AppList'
export default {
  name: 'AppList',
  data () {
    return {
      AppData: [],
      AppColumns: ['Id', 'Name', 'Hash_name', 'Logo_url', 'Image_url', 'Create-time', 'Delete-time', 'Updata-time']
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
      this.$http.get('/appmanager/applist')
      .then((response) => {
        this.$set('AppData', response.data)
        console.log(this.AppData)
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
