<template>
  <div class="upload">
    <div class="uploader">
      <div class="inputer-1">
        <p><input v-model="upload.name" class="input-name" type="text" name="name" placeholder="Name"></p>
        <p><input v-model="upload.hashname" class="input-hashname" type="text" name="hash_name" placeholder="Hash_name"></p>
      </div>
      <div class="inputer-2">
        <Upload
          multiple
          type="drag"
          action="/api/appmanager/applist">
          <div style="padding: 20px 0">
            <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
            <p>点击或将LOGO拖拽到这里上传</p>
          </div>
        </Upload>
      </div>
      <div class="inputer-3">
        <Upload
          multiple
          type="drag"
          action="/api/appmanager/applist">
          <div style="padding: 20px 0">
            <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
            <p>点击或将图片拖拽到这里上传</p>
          </div>
        </Upload>
      </div>
      <p><button type="submit" @click="uploadform($event)">创建</button></p>
    </div>
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
    uploadform (event) {
      this.$http.post('/appmanager/applist', this.upload.name, this.upload.hashname)
      .then((response) => {
        this.$Message.success('上传成功')
        console.log(this.upload.name)
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
  padding: 5px 10px;
  border-radius: 5px;
  font-size: 20px;
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

.input-name{
  margin: 50px 0px;
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
