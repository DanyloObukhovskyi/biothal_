<template>
  <v-breadcrumbs class="breadcrumb" :items="items">
    <template v-slot:item="{ item }">
      <v-breadcrumbs-item
        append
        link
        :to="item.name">
        {{ item.label }}
      </v-breadcrumbs-item>
    </template>
  </v-breadcrumbs>
</template>

<script>
export default {
  name: "PathBreadcrumb",
  props: {
    labelCurrentRoute: {
      type: String,
      default: ''
    },
  },

  computed: {
    items() {
      const routes = this.$route.matched;
      routes.forEach(e => e.label = e.name);
      routes[routes.length - 1].label = this.labelCurrentRoute || routes[routes.length - 1].label;

      return routes;
    },
  },
}
</script>

<style scoped>

</style>
