<template>
  <section class="section">
    <div class="columns">
      <div class="column is-4 is-offset-4">
        <form @submit.prevent="handleSubmit">
          <b-field label="Email">
            <b-input v-model="email" type="email" />
          </b-field>

          <b-field label="Password">
            <b-input v-model="password" type="password" password-reveal />
          </b-field>

          <div class="field is-center">
            <div class="control">
              <button
                :disabled="isSubmitDisabled"
                class="button is-primary"
                @click.prevent="handleSubmit"
              >
                Вход
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>

<script>
import { mapActions } from "vuex";
import { AppRoute } from "@/utils/const";

export default {
  name: "Login",
  data() {
    return {
      email: "",
      password: "",
    };
  },
  computed: {
    isSubmitDisabled() {
      return !(!!this.email.trim().length && !!this.password.trim().length);
    },
  },
  methods: {
    ...mapActions({
      login: "auth/login",
    }),
    async handleSubmit() {
      try {
        const isAuth = await this.login({
          email: this.email,
          password: this.password,
        });

        if (!isAuth) {
          return;
        }

        await this.$router.push(AppRoute.MAIN);
      } catch (e) {
        console.log(e);
      }
    },
  },
};
</script>
