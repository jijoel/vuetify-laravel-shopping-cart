<template>

  <v-card raised hover class="my-2" height="400px">
    <v-card-media
      class="white--text"
      height="200px"
      :src="product.image"
    >
      <v-container fill-height fluid>
        <v-layout fill-height>
          <v-flex xs12 align-end flexbox>
            <span class="headline">{{ product.title }}</span>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card-media>
    <v-card-text class="pb-0">
        {{product.description}}
    </v-card-text>
    <v-card-text class="pb-0" style="text-align:center">
        {{product.price}} - Stock: {{product.inventory}}
    </v-card-text>
    <v-card-actions style="justify-content:center">
      <v-btn primary>Add to Cart</v-btn>
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
  }
}
</script>
