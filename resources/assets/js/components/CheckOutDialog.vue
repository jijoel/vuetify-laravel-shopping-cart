<template>

  <v-dialog
    width="600"
    :value="value"
    :fullscreen="isTiny"
    :transition="dialogTransition"
    @input="valueChanged($evt)"
  >
    <v-card>
      <form>
        <v-card-title class="primary">
          <span class="white--text title">
            Check Out
          </span>
        </v-card-title>

        <v-stepper v-model="steps" vertical non-linear>
          <v-stepper-step editable step="1" :complete="steps > 1">
            Contact
            <small>How can we reach you?</small>
          </v-stepper-step>
          <v-stepper-content step="1">

            <v-text-field
              v-model="form.name"
              name="name"
              label="Name"
              hint="Please enter your name"
              required
            ></v-text-field>

            <v-layout row wrap>
              <v-flex xs12 sm6>
                <v-text-field
                  v-model="form.email"
                  name="email"
                  label="Email Address"
                  hint="Your email address"
                  required
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm6>
                <v-text-field
                  v-model="form.phone"
                  name="phone"
                  label="Phone Number"
                  hint="A number where we can contact you"
                ></v-text-field>
              </v-flex>
            </v-layout>

            <v-btn primary @click.native="steps = 2">
              Continue
            </v-btn>
          </v-stepper-content>

          <v-stepper-step editable step="2" :complete="steps > 3">
            Shipping Address
            <small>Where shall we ship?</small>
          </v-stepper-step>
          <v-stepper-content step="2">

            <v-text-field
              v-model="form.shipping.country"
              name="country"
              label="Country"
              hint="Please enter your country"
            ></v-text-field>

            <v-text-field
              v-model="form.shipping.address"
              name="address"
              label="Street Address"
            ></v-text-field>

            <v-layout row wrap>
              <v-flex xs12 sm6>
                <v-text-field
                  v-model="form.shipping.city"
                  name="city"
                  label="City"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm3>
                <v-text-field
                  v-model="form.shipping.state"
                  name="state"
                  label="State"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm3>
                <v-text-field
                  v-model="form.shipping.zip"
                  name="zip"
                  label="Zip Code"
                  hint="Your postal code"
                ></v-text-field>
              </v-flex>
            </v-layout>

            <v-btn primary @click.native="steps = 3">
              Continue
            </v-btn>

          </v-stepper-content>


          <v-stepper-step editable step="3" :complete="steps > 3">
            Billing Information
            <small>How shall we charge you?</small>
          </v-stepper-step>
          <v-stepper-content step="3">

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


            <p>
              Please enter your credit card information
              below:
            </p>
            <div id="stripe-element"></div>
            <span class="red--text">
              {{ stripe.error }}
            </span>

          </v-stepper-content>
        </v-stepper>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn primary
            class="white--text darken-1"
            @click.native.prevent="clickPurchaseButton"
          >
            Purchase
          </v-btn>
          <v-btn
            class="green--text darken-1"
            @click.native="valueChanged(false)"
            flat="flat"
          >
            Cancel
          </v-btn>
        </v-card-actions>
      </form>
    </v-card>
  </v-dialog>

</template>


<script>
import Stripe from '../mixins/stripe';

export default {

  mixins: [ Stripe ],

  props: {
    value: {
      accept: Boolean,
      default: false,
    },
  },

  data() {
    return {
      steps: 1,
      form: {
        name: '',
        email: '',
        phone: '',
        shipping: {
          address: '',
          city: '',
          state: '',
          zip: '',
          country: '',
        },
        stripe_token: '',
      },
    };
  },

  computed: {
    isTiny() {
      return window.innerWidth < 600;
    },
    dialogTransition() {
      return (this.isTiny)
        ? 'v-dialog-bottom-transition'
        : 'v-dialog-transition';
    },

    items() { return this.$store.getters.cartItems },
    item_count() { return this.$store.getters.cartItemCount },
    subtotal() { return this.$store.getters.cartSubtotal },
    shipping() { return this.$store.getters.cartShipping },
    taxes() { return this.$store.getters.cartTaxes },
    grand_total() { return this.$store.getters.cartGrandTotal },

  },

  methods: {
    valueChanged(val) {
      this.value = val
      this.$emit("input", val)
    },

    clickPurchaseButton() {
      this.createToken();

      // TODO: Submit the form to the server
      console.log(this.form);
    },

  },


}
</script>

