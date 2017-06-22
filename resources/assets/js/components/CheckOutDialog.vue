<template>

  <v-dialog
    width="600"
    :value="value"
    :fullscreen="isTiny"
    :transition="dialogTransition"
    @input="valueChanged($event)"
  >
    <v-card>
      <form>
        <v-card-title class="primary">
          <span class="white--text title">
            Check Out
          </span>
        </v-card-title>

        <v-stepper v-model="step" vertical non-linear>
          <v-stepper-step editable step="1" :complete="step > 1">
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
              :error-messages="getErrors('name')"
            ></v-text-field>

            <v-layout row wrap>
              <v-flex xs12 sm6>
                <v-text-field
                  v-model="form.email"
                  name="email"
                  label="Email Address"
                  :error-messages="getErrors('email')"
                  hint="Your email address"
                  required
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm6>
                <v-text-field
                  v-model="form.phone"
                  name="phone"
                  label="Phone Number"
                  :error-messages="getErrors('phone')"
                  hint="A number where we can contact you"
                ></v-text-field>
              </v-flex>
            </v-layout>

            <v-btn primary @click.native="step = 2">
              Continue
            </v-btn>
          </v-stepper-content>

          <v-stepper-step editable step="2" :complete="step > 3">
            Shipping Address
            <small>Where shall we ship?</small>
          </v-stepper-step>
          <v-stepper-content step="2">

            <v-text-field
              v-model="form.shipping.country"
              name="country"
              label="Country"
              hint="Please enter your country"
              :error-messages="getErrors('shipping.country')"
            ></v-text-field>

            <v-text-field
              v-model="form.shipping.address"
              name="address"
              label="Street Address"
              :error-messages="getErrors('shipping.address')"
            ></v-text-field>

            <v-layout row wrap>
              <v-flex xs12 sm6>
                <v-text-field
                  v-model="form.shipping.city"
                  name="city"
                  label="City"
                  :error-messages="getErrors('shipping.city')"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm3>
                <v-text-field
                  v-model="form.shipping.state"
                  name="state"
                  label="State"
                  :error-messages="getErrors('shipping.state')"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm3>
                <v-text-field
                  v-model="form.shipping.zip"
                  name="zip"
                  label="Zip Code"
                  :error-messages="getErrors('shipping.zip')"
                  hint="Your postal code"
                ></v-text-field>
              </v-flex>
            </v-layout>

            <v-btn primary @click.native="step = 3">
              Continue
            </v-btn>

          </v-stepper-content>


          <v-stepper-step editable step="3" :complete="step > 3">
            Billing Information
            <small>How shall we charge you?</small>
          </v-stepper-step>
          <v-stepper-content step="3">

            <s-shopping-cart-totals></s-shopping-cart-totals>

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
import InputValidation from '../mixins/InputValidation';

export default {

  mixins: [ Stripe, InputValidation ],

  props: {
    value: {
      accept: Boolean,
      default: false,
    },
  },

  data() {
    return {
      step: 1,
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
      },
      rules: {
        'name': 'required|min:3',
        'email': 'required|email',
        'shipping.address': 'required|min:6',
      }
    };
  },

  computed: {
    items() { return this.$store.getters.cartItemList },
    grand_total() { return this.$store.getters.cartGrandTotal },

    isTiny() {
      return window.innerWidth < 600;
    },
    dialogTransition() {
      return (this.isTiny)
        ? 'v-dialog-bottom-transition'
        : 'v-dialog-transition';
    },
  },

  methods: {
    valueChanged(val) {
      this.value = val
      this.$emit("input", val)
    },

    clickPurchaseButton() {
      this.createToken();

      axios.post('/api/checkout', Object.assign({
        stripe_token: this.stripe.token,
        items: this.items,
        total: this.grand_total,
      }, this.form))
      .then((response) => {
        console.log(response);
      })
      .catch((error) => this.setErrors(error.response.data))
    },
  },

  watch: {
    value() {
      this.step = 1;
      this.value && this.loadPaymentProcessor();
    },
  }


}
</script>

