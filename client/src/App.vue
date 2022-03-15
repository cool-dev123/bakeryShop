<template>
  <v-app>
    <MainLayout>
      <router-view>
      </router-view>
    </MainLayout>
  </v-app>
</template>

<script>

import MainLayout from "@/components/layout/MainLayout";

export default {
  name: 'App',
  components: { MainLayout},
  data: () => ({}),
};
</script>


<style scoped>

</style>