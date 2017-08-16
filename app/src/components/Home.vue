<template>
  <div id="home">
  </div>
</template>

<script>
export default {
  name: 'home',
  data () {
    return {
      i: 300
    }
  }
  // mounted: function () {
  //   this.moveup()
  // },
  // methods: {
  //   moveup: function () {
  //     while (this.i > 0) {
  //       window.scrollBy(0, 1)
  //       this.i--
  //     }
  //   }
  // }
}
</script>

<style scoped>
#home{
  width: 100%;
  height: 500px;
}
</style>
