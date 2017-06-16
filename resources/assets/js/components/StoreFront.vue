<template>
<v-app id="store-front">

  <v-navigation-drawer></v-navigation-drawer>

  <s-toolbar></s-toolbar>
  <main>
    <v-container fluid>

      <s-coupons></s-coupons>

      <v-layout row wrap>
        <v-flex xs12 sm8 md9 lg10 order-xs2 order-sm1>
          <s-product-list></s-product-list>
        </v-flex>
        <v-flex xs12 sm4 md3 lg2 order-xs1 order-sm2>
          <s-shopping-cart></s-shopping-cart>
        </v-flex>
      </v-layout>

    </v-container>
  </main>
  <v-footer></v-footer>

</v-app>
</template>

<script>
export default {

  created() {
    this.$store.dispatch('loadProducts',null);
  },

}
</script>
