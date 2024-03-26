<template>
  <div class="main-page">
    <header-main></header-main>
    <router-view class="router-page"></router-view>
    <footer-main></footer-main>
  </div>
</template>

<script>
import HeaderMain from "./head/Header";
import FooterMain from "./foot/Footer";
import "@/assets/css/reset.css"

export default {
  name: "MainPage",
  components: {
    HeaderMain,
    FooterMain,
  },
  data() {
    return {

    }
  },
  computed: {

  },
}
</script>

<style scoped lang="less">
.main-page {
  position: relative;
  min-width: 1200px;

  .router-page {
    padding-left: 5%;
    padding-right: 5%;
    min-height:85vh;
  }
}
</style>
