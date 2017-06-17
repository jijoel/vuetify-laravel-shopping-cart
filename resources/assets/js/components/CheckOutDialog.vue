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

          </v-stepper-content>

          <v-stepper-step editable step="3" :complete="steps > 3">
            Billing Information
            <small>How shall we charge you?</small>
          </v-stepper-step>
          <v-stepper-content step="3">

            <v-text-field
              name="card"
              label="Card Number"
            ></v-text-field>

            <v-layout row wrap>
              <v-flex xs6>
                <v-text-field
                  name="expiration"
                  label="Expiration"
                ></v-text-field>
              </v-flex>
              <v-flex xs6>
                <v-text-field
                  name="cvc"
                  label="CVC"
                ></v-text-field>
              </v-flex>

            </v-layout>

          </v-stepper-content>
        </v-stepper>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn primary
            class="white--text darken-1"
            @click.native="valueChanged(false)"
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
export default {

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
        }
      }
    };
  },

  computed: {
    isTiny() {
      return window.innerWidth < 600;
    },
    dialogTransition() {
      if (this.isTiny)
        return 'v-dialog-bottom-transition';

      return 'v-dialog-transition';
    },
  },

  methods: {
    valueChanged(val) {
      this.value = val
      this.$emit("input", val)
    },
  },

}
</script>
