<template>

  <div>
    <div class="display-1">Products</div>
    <v-layout row wrap>
      <v-flex xs12 sm4 lg2 xl1
        v-for="item in products"
        :key="item.id">

        <s-product-card
          :product="item"
        >
        </s-product-card>

      </v-flex>
    </v-layout>
  </div>

</template>


<script>
export default {

  computed: {
    products() { return this.$store.getters.products },
  },

}
</script>
