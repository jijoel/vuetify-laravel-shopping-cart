<template>

  <div>
    <v-layout row wrap>
      <v-flex>
        <div class="display-1">Products</div>
      </v-flex>
      <v-flex>
        <v-text-field
          append-icon="search"
          label="Search"
          single-line
          hide-details
          v-model="filter"
        ></v-text-field>
      </v-flex>
    </v-layout>

    <v-layout row wrap>
      <v-flex xs12 sm4 lg2 xl1
        v-for="item in filteredProducts"
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

  data() {
    return {
      filter: '',
    };
  },

  computed: {
    products() { return this.$store.getters.products },

    filteredProducts() {
      return this.products.filter((product) => {
        return (! this.filter.length )
          || product.title.toLowerCase()
              .includes(this.filter.toLowerCase())
          || product.description.toLowerCase()
              .includes(this.filter.toLowerCase());
      })
    }
  },

}
</script>
