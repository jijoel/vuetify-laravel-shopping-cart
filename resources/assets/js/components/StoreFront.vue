<template>
<v-app id="store-front">

  <v-navigation-drawer></v-navigation-drawer>

  <s-toolbar></s-toolbar>
  <main>
    <v-container fluid>

      <s-coupons></s-coupons>

      <v-layout row wrap>
        <v-flex xs12 sm9 md10 order-xs2>
          <s-product-list></s-product-list>
        </v-flex>
        <v-flex xs12 sm3 md2 order-xs1>
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

}
</script>
