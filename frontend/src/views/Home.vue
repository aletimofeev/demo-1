<template>
  <section class="section">
    <div class="columns">
      <div class="column is-6 is-offset-3">
        <b-message
          type="is-success"
          has-icon
        >
          <h1 class="title is-size-4 mt-4">
            Вход в систему
          </h1>
        </b-message>
        <b-message>
          <h2 class="title is-size-5">
            Пользователь
          </h2>
          <span>{{ loginText }} {{ user }}</span><br>
          <span>{{ passText }} {{ user }}</span>

          <h2 class="title is-size-5 mt-4">
            Редактор
          </h2>
          <span>{{ loginText }} {{ editor }}</span><br>
          <span>{{ passText }} {{ editor }}</span>
        </b-message>

        <b-message>
          <a
            :href="checkEmailHref"
            target="_blank"
          >Проверка почты</a>
        </b-message>
      </div>
    </div>
  </section>
</template>

<script>

export default {
  name: "Home",
  data() {
    return {
      loginText: 'Логин:',
      passText: 'Пароль:',
      user: process.env.VUE_APP_API_EDITOR,
      editor: process.env.VUE_APP_API_EDITOR,
      checkEmailHref: process.env.VUE_APP_SMTP_SERVICE
    }
  }
};
</script>

