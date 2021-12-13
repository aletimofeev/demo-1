<template>
  <section class="section">
    <h1 class="title">
      Работники
    </h1>

    <ListEmployees />
  </section>
</template>

<script>
import ListEmployees from "@/modules/employees/ListEmployees";
export default {
  name: "Employees",
  components: { ListEmployees },
};
</script>
