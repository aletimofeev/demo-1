<template>
  <div
    class="buttons"
  >
    <b-button
      type="is-success"
      icon-left="pencil"
      size="is-small"
      @click="$emit('edit')"
    />
    <b-button
      type="is-danger"
      icon-left="delete"
      size="is-small"
      :disabled="isDeleteDisable"
      @click="$emit('remove')"
    />
  </div>
</template>

<script>

export default {
  name: "AppEditButtons",
  props: {
    isDeleteDisable: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
