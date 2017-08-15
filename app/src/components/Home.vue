<template>
  <div id="home">
  </div>
</template>

<script>
export default {
  name: 'home',
  data () {
    return {
      value2: 1,
      i: 300
    }
  },
  mounted: function () {
    this.movedown()
  },
  methods: {
    movedown: function () {
      while (this.i > 0) {
        window.scrollBy(0, +1)
        this.i--
      }
    }
  }
}
</script>

<style scoped>
#home{
  width: 100%;
  height: 500px;
}
</style>
