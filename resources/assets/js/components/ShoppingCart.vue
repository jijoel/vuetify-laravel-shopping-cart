<template>
  <div>
    <div class="display-1">Your Cart</div>

    <v-list two-line>
      <template v-for="item in items">
        <v-list-tile avatar :key="item.title">

          <v-list-tile-avatar>
            <img :src="item.image">
          </v-list-tile-avatar>

          <v-list-tile-content>
            <v-list-tile-title v-html="item.title">
            </v-list-tile-title>
            <v-list-tile-sub-title>
              Quantity: {{ item.quantity }} &nbsp; - &nbsp;
              ${{ item.price / 100 }}
            </v-list-tile-sub-title>
          </v-list-tile-content>

          <v-list-tile-action>
            <v-btn icon ripple>
              <v-icon class="grey--text text--lighten-1">close</v-icon>
            </v-btn>
          </v-list-tile-action>

        </v-list-tile>
      </template>
    </v-list>

    <div class="table__overflow">
      <table class="datatable table">
        <tbody>
          <tr>
            <td>Subtotal (0 items):</td>
            <td class="text-xs-right">{{ subtotal | money }}</td>
          </tr>
          <tr>
            <td>Shipping:</td>
            <td class="text-xs-right">{{ shipping | money }}</td>
          </tr>
          <tr>
            <td>Taxes:</td>
            <td class="text-xs-right">{{ taxes | money }}</td>
          </tr>
          <tr>
            <td><strong>Grand Total:</strong></td>
            <td class="text-xs-right">{{ grand_total | money }}</td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</template>


<script>
export default {

  computed: {
    items() {
      return this.$store.getters.cartItems
    },

    subtotal() {
      return this.calculate('price');
    },

    shipping() {
      return this.calculate('shipping');
    },

    taxes() {
      return Math.floor(
        100 * this.calculate('price') * .0466
      ) / 100;
    },

    grand_total() {
      return this.subtotal + this.shipping + this.taxes
    },
  },

  methods: {

    calculate(value) {

      let calculated = this.items.reduce( (total, current) => {
        return total + (current[value] * current['quantity'])
      }, 0);

      return (calculated / 100);
    },

  },


}
</script>
