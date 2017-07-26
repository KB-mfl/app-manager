<template>
  <div class="upload">
    <form class="uploader">
      <p><input v-model="upload.name" class="input-name" type="text" name="name" placeholder="Name"></p>
      <p><input v-model="upload.hashname" class="input-hashname" type="text" name="hash_name" placeholder="Hash_name"></p>
      <p><input id="upload" type="file" name="upload"></p>
      <p><button @click="uploadfile($event)">Upload</button></p>
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
        hashname: ''
      }
    }
  },
  methods: {
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
}

.input-name{
  margin: 40px 0px 20px 0px;
}

.input-hashname{
  margin: 20px 0px 20px 0px;
}

.upload{
  height: auto;
}

#upload {
    font-size: 12px;
    margin: 20px 0px 20px 0px;
}

#upload::-webkit-file-upload-button {
    background: #efeeee;
    color: #333;
    border: 0;
    padding: 10px 10px;
    border-radius: 5px;
    font-size: 15px;
    box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
}

.uploader{
  box-shadow: 1px 1px 5px rgba(0,0,0,.1), 0 0 10px rgba(0,0,0,.12);
  border: 0px;
  position: relative;
  left: 560px;
  width: 400px;
  height: 350px;
}
</style>
