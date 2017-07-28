<template>
  <div class="upload">
    <form class="uploader">
      <div class="inputer-1">
        <p><input v-model="upload.name" class="input-name" type="text" name="name" placeholder="Name"></p>
        <p><input v-model="upload.hashname" class="input-hashname" type="text" name="hash_name" placeholder="Hash_name"></p>
      </div>
      <div class="inputer-2">
        <p><input id="uploadLogo" type="file" name="uploadLogo" @change="getlogo($event)"></p>
        </image>
        <p><label for="uploadLogo">Logo</label></p>
      </div>
      <div class="inputer-3">
        <p><input id="uploadimage" type="file" name="uploadimage" @change="getimage($event)"></p>
        </image>
        <p><label for="uploadimage">Image</label></p>
      </div>
      <p><button type="submit" @click="uploadform($event)">Upload</button></p>
    </form>
  </div>
</template>

<script>
export default {
  name: 'upload',
  data () {
    return {
      upload: {
        name: '',
        hashname: '',
        logo: '',
        image: ''
      }
    }
  },
  methods: {
    getlogo (event) {
      this.logo = event.target.files[0]
      console.log(this.logo)
    },
    getimage (event) {
      this.image = event.target.files[0]
      console.log(this.iamge)
    },
    uploadform (event) {
      event.preventDefault()
      let formData = new FormData()
      formData.append('name', this.name)
      formData.append('hashname', this.hashname)
      formData.append('logo', this.logo)
      formData.append('image', this.image)
      let config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
      this.$http.post('/appmanager/addapp', formData, config)
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

image{
  width: 50px;
  height: 50px;
}

.input-name{
  margin: 10px 0px 60px 0px;
  font-size: 20px;
  border-radius: 5px;
}

.input-name:hover{
  position: relative;
  bottom: 2px;
  right: 2px;
  border-radius: 5px;
  box-shadow: 1px 1px 2px rgba(0,0,0,.1), 0 0 3px rgba(0,0,0,.12);
  background-color: rgb(150,200,250);
}

.input-hashname{
  margin: 20px 0px 0px 0px;
  font-size: 20px;
  border-radius: 5px;
}

.input-hashname:hover{
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

#uploadLogo {
  font-size: 0px;
  margin: 2px 0px 2px 0px;
}

#uploadLogo::-webkit-file-upload-button {
  background: #efeeee;
  color: #333;
  border: 0;
  padding: 60px 60px;
  border-radius: 5px;
  font-size: 0px;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  cursor: pointer;
}

#uploadLogo::-webkit-file-upload-button:hover{
  position: relative;
  bottom: 2px;
  right: 2px;
  background-color: rgb(150,200,250);
}

#uploadimage {
  font-size: 0px;
  margin: 2px 0px 2px 0px;
}

#uploadimage::-webkit-file-upload-button {
  background: #efeeee;
  color: #333;
  border: 0;
  padding: 60px 60px;
  border-radius: 5px;
  font-size: 0px;
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  cursor: pointer;
}

#uploadimage::-webkit-file-upload-button:hover{
  position: relative;
  bottom: 2px;
  right: 2px;
  background-color: rgb(150,200,250);
}

.inputer-1{
  display: inline-block;
  margin: 0px 20px 30px 0px;
}

.inputer-2{
  display: inline-block;
  margin: 30px 50px 0px 80px;
}

.inputer-3{
  display: inline-block;
  margin: 30px 50px 0px 50px;
}
</style>
