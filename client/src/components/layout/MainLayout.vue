<template>
  <v-app :style="pageStyle">
    <v-main>
      <div >
        <div class="root">
          <router-view></router-view>
        </div>
      </div>
    </v-main>
  </v-app>
</template>

<script>



export default {
  name: 'MainLayout',

  data() {
    return {

    }
  },
}
</script>

<style scoped>

</style>