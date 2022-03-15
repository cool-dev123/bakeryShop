<template>
  <div class="d-flex gap-8" >

    <div class="mr-10">the Store is open</div>

    <div justify="center">
      <v-date-picker v-model="picker"></v-date-picker>
    </div>
  </div>
</template>`

<script>
export default {
  name: "AppBar",
  data () {
    return {
      picker: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
    }
  },
}
</script>

<style scoped>

</style>