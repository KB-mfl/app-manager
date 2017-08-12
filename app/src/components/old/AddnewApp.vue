<template>
  <div class="upload">
    <form class="uploader">
      <div class="inputer-1">
        <p><input v-model="name" class="input-name" type="text" name="name" placeholder="Name"></p>
      </div>
      <p><button type="submit" @click="uploadform($event)">Save</button></p>
    </form>
  </div>
</template>

<script>
export default {
  name: 'upload',
  data () {
    return {
      name: ''
    }
  },
  methods: {
    uploadform (event) {
      event.preventDefault()
      let formData = new FormData()
      formData.append('name', this.name)
      let config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
      this.$http.post('addapp', formData, config)
      .then((response) => {
        console.log('success')
      })
      .catch(function (error) {
        console.log(error)
      })
    }
  }
}
</script>

<style scoped>
p{
  width: auto;
  height: auto;
  text-align: center;
}

button{
  width: auto;
  height: auto;
  background: #efeeee;
  color: #333;
  border: 0;
  padding: 10px 10px;
  margin: 20px auto;
  border-radius: 5px;
  font-size: 15px;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  cursor: pointer;
}

button:hover{
  position: relative;
  bottom: 2px;
  right: 2px;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  background-color: #2ab27b;
  color: #ffffff;
}

.input-name{
  margin: auto 0px;
  font-size: 20px;
  border-radius: 5px;
}

.input-name:hover{
  position: relative;
  bottom: 2px;
  right: 2px;
  border-radius: 5px;
  box-shadow: 1px 1px 2px #2ab27b, 0 0 3px #2ab27b;
  color: #000000;
}

.upload{
  height: auto;
  width: auto;
  margin-top: 4%;
}

.uploader{
  border: 0px;
  width: 30% auto;
  height: auto;
  text-align: center;
  margin: 0px auto;
}

.inputer-1{
  display: inline-block;
  margin: 0px;
}
</style>
