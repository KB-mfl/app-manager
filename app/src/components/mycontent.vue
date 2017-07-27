<template>
  <div class="mycontent">
    <ul>
      <li v-for="item in items" class="menu">
        {{item.label}}
      </li>
    </ul>
    <div class="content">

    </div>
  </div>
</template>
<script>
export default {
  name: 'mycontent',
  data () {
    return {
      items: [
        {
          label: '下载'
        },
        {
          label: '上传'
        },
        {
          label: '历史/版本'
        },
        {
          label: '图片'
        }
      ]
    }
  }
}
</script>
<style>
  .mycontent{
    width: 80%;
    margin-left: 20%;
  }
  .mycontent ul{
    list-style: none;
  }
  .menu{
    font-size: 40px;
    float: left;
    margin-right: 18%;
  }
</style>
