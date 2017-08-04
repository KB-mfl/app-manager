<template>
  <div class="download">
    <p>{{system}}
      <Select v-model="model1" style="width:200px">
        <Option v-for="item in systemList" :value="item.value" :key="item.value">{{ item.label }}</Option>
      </Select>
    </p>
    <div id="button" @click="getApp">Download now!</div>
  </div>
</template>

<script>
export default {
  name: 'download',
  data () {
    return {
      system: '您当前的操作系统是：',
      systemList: [
        {
          value: 'Windows',
          label: 'Windows'
        },
        {
          value: 'Mac',
          label: 'Mac'
        },
        {
          value: 'Linux',
          label: 'Linux'
        },
        {
          value: 'iOS',
          label: 'iOS'
        },
        {
          value: 'Android',
          label: 'Android'
        }
      ],
      model1: ''
    }
  },
  methods: {
    getApp: function () {
      this.$http.get(+'download')
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
  font-size: 20px;
}

Option{
  font-size: 20px;
}

.download{
  margin-top: 150px;
  width: 80%;
  height: 500px;
  margin-left: 10%;
}

#button{
  margin: 0 auto;
  margin-top: 50px;
  width: 500px;
  height: 80px;
  font-size: 60px;
  line-height: 75px;
  border: solid 2px black;
  border-radius: 40px;
}

#button:hover{
  background-color: #2ab27b;
  opacity: 1;
  color: #ffffff;
  cursor: pointer;
}
</style>
