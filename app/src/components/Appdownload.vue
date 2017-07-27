<template>
  <div class="download">
    <p><button type="button" name="download" @click="getApp">Download</button></p>
  </div>
</template>

<script>
export default {
  name: 'download',
  data () {
    return {
    }
  },
  methods: {
    getApp: function () {
      this.$http.get('/download')
      .then((response) => {
        console.log(status)
      })
      .catch(function (error) {
        console.log(error)
      })
    }
  }
}
</script>

<style scoped>
.download{
  position: relative;
  top: 50px;
}

button{
  font-size: 15px;
  width: auto;
  height: auto;
  background: #efeeee;
  color: #333;
  border: 0;
  padding: 10px 10px;
  border-radius: 5px;
  font-size: 15px;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
}

button:hover{
  position: relative;
  bottom: 2px;
  right: 2px;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  background-color: rgb(150,200,250);
  color: #ffffff;
}
</style>
