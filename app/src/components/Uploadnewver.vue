<template>
  <div id="updatnewver">
    <form class="uploader">
      <div class="inputer-1">
        <p><input v-model="version" class="input-version" type="text" name="version" placeholder="Version"></p>
        <p><input v-model="system" class="input-system" type="text" name="system" placeholder="System"></p>
      </div>
      <div class="inputer-2">
        <p><input id="uploadnewapp" type="file" name="uploadnewapp" @change="getnewapp($event)"></p>
        <p><label for="uploadnewapp">New App</label></p>
      </div>
      <p><button type="submit" @click="uploadform($event)">Upload</button></p>
    </form>
  </div>
</template>

<script>
export default {
  name: 'uploadnewver',
  data () {
    return {
      version: '',
      system: '',
      upload: {
        new_app: ''
      }
    }
  },
  methods: {
    getnewapp (event) {
      this.new_app = event.target.files[0]
      console.log(this.new_app)
    },
    uploadform (event) {
      event.preventDefault()
      let formData = new FormData()
      formData.append('version', this.version)
      formData.append('system', this.system)
      formData.append('new_app', this.new_app)
      let config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
      this.$http.post('id', formData, config)
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
  cursor: pointer;
}

button:hover{
  position: relative;
  bottom: 2px;
  right: 2px;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  background-color: rgb(150,200,250);
  color: #ffffff;
}

label{
  font-size: 20px;
  cursor: pointer;
}

label:hover{
  position: relative;
  bottom: 2px;
  right: 2px;
  border-radius: 5px;
  box-shadow: 1px 1px 2px rgba(0,0,0,.1), 0 0 3px rgba(0,0,0,.12);
  background-color: rgb(150,200,250);
  color: #ffffff;
}

.input-version{
  margin: 10px 0px 60px 0px;
  font-size: 20px;
  border-radius: 5px;
}

.input-version:hover{
  position: relative;
  bottom: 2px;
  right: 2px;
  border-radius: 5px;
  box-shadow: 1px 1px 2px rgba(0,0,0,.1), 0 0 3px rgba(0,0,0,.12);
  background-color: rgb(150,200,250);
}

.input-system{
  margin: 20px 0px 0px 0px;
  font-size: 20px;
  border-radius: 5px;
}

.input-system:hover{
  position: relative;
  bottom: 2px;
  right: 2px;
  border-radius: 5px;
  box-shadow: 1px 1px 2px rgba(0,0,0,.1), 0 0 3px rgba(0,0,0,.12);
  background-color: rgb(150,200,250);
}

.upload{
  height: auto;
  width: auto;
}

.uploader{
  border: 0px;
  width: 100% auto;
  height: auto;
  text-align: center;
}

#uploadnewapp {
  font-size: 0px;
  margin: 2px 0px 2px 0px;
}

#uploadnewapp::-webkit-file-upload-button {
  background: #ffffff;
  color: #333;
  border: dotted #66ccff;
  padding: 50px 50px;
  border-radius: 5px;
  font-size: 12px;
  cursor: pointer;
}

#uploadnewapp::-webkit-file-upload-button:hover{
  position: relative;
  bottom: 2px;
  right: 2px;
  background-color: rgb(150,200,250);
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
}

#uploadimage {
  font-size: 0px;
  margin: 2px 0px 2px 0px;
}

.inputer-1{
  display: inline-block;
  margin: 0px 20px 30px 0px;
}

.inputer-2{
  display: inline-block;
  margin: 30px 50px 0px 80px;
}

</style>
