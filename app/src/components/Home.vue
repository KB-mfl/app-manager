<template>
  <div id="home">
    <Carousel autoplay v-model="value2" id="welcome">
      <Carousel-item>
        <div class="demo-carousel">1</div>
      </Carousel-item>
      <Carousel-item>
        <div class="demo-carousel">2</div>
      </Carousel-item>
      <Carousel-item>
        <div class="demo-carousel">3</div>
      </Carousel-item>
      <Carousel-item>
        <div class="demo-carousel">4</div>
      </Carousel-item>
    </Carousel>
  </div>
</template>

<script>
export default {
  name: 'home',
  data () {
    return {
      value2: 0
    }
  },
  methods: {
  }
}
</script>

<style scoped>
.demo-carousel{
  margin: 0 auto;
  height: 500px;
  width: 80%;
  background-color: #2ab27b;
  font-size: 200px;
}

#welcome{
  margin-left: 10%;
  width: 80%;
  margin-top: 20px;
}
</style>
