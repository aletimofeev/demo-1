<template>
  <div id="app">
    <!--    <div id="nav">-->
    <!--      <router-link to="/">Home</router-link> |-->
    <!--      <router-link to="/about">About</router-link>-->
    <!--    </div>-->
    <!--    <router-view />-->
    <AppNavbar />
    <div class="container">
      <router-view />
    </div>
  </div>
</template>

<script>
import AppNavbar from "@/components/AppNavbar";
export default {
  components: { AppNavbar },

  async mounted() {
    await this.$store.dispatch("auth/setAuth");
  },
};
</script>
