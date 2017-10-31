<template>
  <div class="platform">
  </div>
</template>

<script>
export default {
  name: 'platform',
  data () {
    return {
      platform: '',
      system: ''
    }
  },
  beforeMount: function () {
    this.Getplatform()
  },
  methods: {
    Getplatform: function () {
      this.user = navigator.userAgent
      this.platform = navigator.platform
      if (this.user.indexOf('Windows') > -1) {
        this.system = 'Android'
        this.$router.push({path: '/' + this.$route.params.appname + '/' + this.system})
      }
      if (this.platform === 'MacIntel') {
        this.system = 'IOS'
        this.$router.push({path: '/' + this.$route.params.appname + '/' + this.system})
      }
      if (this.user.indexOf('Android') > -1) {
        this.system = 'Android'
        this.$router.push({path: '/' + this.$route.params.appname + '/' + this.system})
      }
      if (this.user.indexOf('iPhone') > -1) {
        this.system = 'IOS'
        this.$router.push({path: '/' + this.$route.params.appname + '/' + this.system})
      }
    }
  }
}
</script>

<style scoped>
</style>
