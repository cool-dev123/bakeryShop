<template>
  <v-card class="sidebar">
    Dashboard
  </v-card>
</template>

<script>
export default {
  name: "Dashboard",
  data() {
    return {
      path: this.$route.path,
      myStyle: {
        backgroundColor: '#2B0F4D',
      }
    }
  },
  watch: {
    $route(to) {
      this.path = to.path;
    }
  }
}
</script>

<style scoped>

</style>