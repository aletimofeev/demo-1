<template>
  <div
    v-if="isEditor"
    class="buttons"
  >
    <b-button
      v-if="isIcon"
      type="is-success"
      icon-right="plus-thick"
      @click="$emit('click')"
    />
    <b-button
      v-else
      type="is-success"
      @click="$emit('click')"
    >
      {{ title }}
    </b-button>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  name: "AddButton",
  props: {
    title: {
      type: String,
      default: "Добавить",
    },
    isIcon: {
      type: Boolean,
      default: false,
    },
  },
  computed: {
    ...mapGetters({
      isEditor: "auth/isEditor",
    }),
  },
};
</script>
