<template>
  <div id="footer">
    <div class="words">
      <p>Copyright © 2017 晴空工作室 All rights reserved.</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'footer',
  data () {
    return {
    }
  }
}
</script>

<style scoped>
#footer {
  width: 100%;
  height: 100px;
  margin-top: 20px;
  background-color: #5e79e6;
}

.words{
  font-size: 16px;
  color: #000000;
  position: relative;
  top: 44px;
}
</style>
