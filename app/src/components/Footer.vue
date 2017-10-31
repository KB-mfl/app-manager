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
@media screen and (min-width: 900px)
{
  #footer {
    width: 100%;
    height: 100px;
    background-color: #2257c9;
    margin-top: 150px;
  }

  .words{
    font-size: 16px;
    color: #FFF;
    height: auto;
    width: auto;
    text-align: center;
  }

  .words p{
    line-height: 100px;
  }
}

@media screen and (min-width: 600px) and (max-width: 900px)
{
  #footer {
    width: 100%;
    height: 80px;
    background-color: #2257c9;
    margin-top: 100px;
  }

  .words{
    font-size: 13px;
    color: #FFF;
    height: auto;
    width: auto;
    vertical-align: middle;
  }

  .words p{
    line-height: 80px;
  }
}

@media screen and (max-width: 600px)
{
  #footer {
    width: 100%;
    height: 60px;
    background-color: #2257c9;
    margin-top: 50px;
  }

  .words{
    font-size: 10px;
    color: #FFF;
    height: auto;
    width: auto;
    text-align: center;
  }

  .words p{
    line-height: 60px;
  }
}
</style>
