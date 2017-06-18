<template>
  <div>
    <div class="display-1" style="text-align:center">Your Cart</div>

    <v-card>
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
              {{ item.price | money }}
            </v-list-tile-sub-title>
          </v-list-tile-content>

          <v-list-tile-action>
            <v-btn icon ripple
              @click.native="removeItem(item)"
            >
              <v-icon class="grey--text text--lighten-1">
                close
              </v-icon>
            </v-btn>
          </v-list-tile-action>

        </v-list-tile>
      </template>
    </v-list>

    <div class="table__overflow">
      <table class="datatable table">
        <tbody>
          <tr>
            <td>Subtotal ({{ item_count }} items):</td>
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
            <td class="text-xs-right"><strong>{{ grand_total | money }}</strong></td>
          </tr>

        </tbody>
      </table>
    </div><!-- .table__overflow -->

    <v-card-actions class="justify-center">
      <v-btn primary
        v-if="item_count > 0"
        @click.native.stop="checkout()"
      >
        Check out
      </v-btn>
    </v-card-actions>

  </v-card>

  <s-checkout-dialog v-model="checkoutDialog">
  </s-checkout-dialog>

  </div>
</template>


<script>
export default {

  data() {
    return {
      checkoutDialog: false,
    }
  },

  computed: {
    items() { return this.$store.getters.cartItems },
    item_count() { return this.$store.getters.cartItemCount },
    subtotal() { return this.$store.getters.cartSubtotal },
    shipping() { return this.$store.getters.cartShipping },
    taxes() { return this.$store.getters.cartTaxes },
    grand_total() { return this.$store.getters.cartGrandTotal },
  },

  methods: {

    removeItem(item) {
      this.$store.dispatch('removeItemFromCart',item);
    },

    checkout() {
      this.checkoutDialog = true;
    }

  },


}
</script>
