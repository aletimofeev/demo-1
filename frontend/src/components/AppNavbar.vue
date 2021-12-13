<template>
  <b-navbar class="container navbar">
    <template #brand>
      <b-navbar-item tag="router-link"
:to="{ path: AppRoute.MAIN }">
        <img
src="@/assets/adidas.png" alt="Logo" style="max-height: 60px" />
      </b-navbar-item>
    </template>

    <template #start>
      <b-navbar-item tag="router-link"
:to="{ path: AppRoute.MAIN }">
        Home
      </b-navbar-item>

      <b-navbar-item
        v-if="user"
        tag="router-link"
        :to="{ path: AppRoute.EMPLOYEES }"
      >
        Работники
      </b-navbar-item>
    </template>

    <template #end>
      <b-navbar-dropdown v-if="user"
:label="userName" hoverable collapsible>
        <b-navbar-item
href="#" @click="profile"> Профиль </b-navbar-item>
        <b-navbar-item @click="logout"> Выход </b-navbar-item>
      </b-navbar-dropdown>

      <div v-else
class="buttons">
        <router-link :to="{ path: AppRoute.LOGIN }"
class="button is-primary">
          Log in
        </router-link>
      </div>
    </template>
  </b-navbar>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import { AppRoute } from "@/utils/const";

export default {
  name: "AppNavbar",
  data() {
    return {
      AppRoute,
    };
  },
  computed: {
    ...mapGetters({
      user: "auth/getUser",
    }),
    userName() {
      if (!this.user) {
        return "";
      }
      const firstname = this.user.firstname || "";
      const lastname = this.user.lastname || "";
      return `${firstname} ${lastname}`;
    },
  },
  methods: {
    ...mapActions({
      authLogout: "auth/logout",
    }),
    async logout() {
      await this.authLogout();
      await this.$router.push(AppRoute.LOGIN);
    },
    async profile() {
      this.$buefy.notification.open({
        message: "Раздел в разработке",
        type: "is-success",
      });
    },
  },
};
</script>
