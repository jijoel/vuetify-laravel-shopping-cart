<template>
  <v-toolbar class="indigo darken1">
    <v-toolbar-title>
      <span class="white--text">
        Store
      </span>
    </v-toolbar-title>
    <v-spacer></v-spacer>
    <div class="pr-2">
      Hello <strong>{{ name }}</strong>,
      your credit limit is <strong>{{ limit }}</strong>
    </div>
  </v-toolbar>
</template>


<script>
export default {

  computed: {
    name() {
      return 'Foo';
    },
    limit() {
      return '$45.00';
    },
  },
}
</script>
