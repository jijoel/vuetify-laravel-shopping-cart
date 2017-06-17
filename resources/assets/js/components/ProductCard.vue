<template>

  <v-card raised hover class="my-2" height="400px" style="min-width:200; max-width:300px">
    <v-card-media
      class="white--text"
      height="200px"
      :src="product.image"
    >
      <v-container fill-height fluid>
        <v-layout fill-height>
          <v-flex xs12 align-end flexbox>
            <span class="headline shadow-text">
              {{ product.title }}
            </span>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card-media>
    <v-card-text class="pb-0 fade-out product-card-description">
        {{product.description}}
    </v-card-text>
    <v-card-text class="pb-0 center-text">
        {{ product.price | money }} &nbsp; - &nbsp;
        Stock: {{product.inventory}}
    </v-card-text>
    <v-card-actions class="justify-center">
      <v-btn primary
        v-if="product.inventory > 0"
        @click.native="addToCart(product)"
      >
        Add to Cart
      </v-btn>
      <v-btn disabled
        v-if="product.inventory <= 0"
      >
        Sold Out
      </v-btn>
    </v-card-actions>
  </v-card>

</template>

<script>
export default {
  props: {
    product: {
      title: '',
      image: '',
      description: '',
      price: '',
      quantity: '',
    }
  },

  methods: {
    addToCart(item) {
      this.$store.dispatch('addItemToCart',item);
    }
  },

}

</script>
