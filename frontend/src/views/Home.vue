<template>
  <section class="section">
    <div class="columns">
      <div class="column is-6 is-offset-3">
        <b-message
          type="is-success"
          has-icon
        >
          Для входа в систему
        </b-message>
        <b-message>
          <h2 class="title is-size-5">
            Пользователь
          </h2>
          <span>{{ loginText }} {{ user }}</span><br>
          <span>{{ passText }} {{ user }}</span>
        </b-message>
        <b-message>
          <h2 class="title is-size-5">
            Редактор
          </h2>
          <span>{{ loginText }} {{ editor }}</span><br>
          <span>{{ passText }} {{ editor }}</span>
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
      user: 'user@example.com',
      editor: 'editor@example.com'
    }
  }
};
</script>

