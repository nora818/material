<template>
  <div id="app">
    <main-page></main-page>
  </div>
</template>

<script>
import MainPage from "./views/MainPage";
export default {
  name: 'App',
  components: {
    MainPage,
  },

  created() {
    const state = localStorage.getItem('state')
    if (state) {
      const { user } = JSON.parse(state)
      this.$store.commit('updateUser', user)
    }
  },
  methods: {
  }
}
</script>

<style scoped></style>
