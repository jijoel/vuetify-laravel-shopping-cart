import loadScript from '../loadScript';

export default {

  data() {
    return {
      stripe: {
        stripe: {},
        card: {},
        error: {},
      },
    };
  },

  watch: {
    // Load stripe when the dialog is opened
    value() {
      if (! this.value || (typeof Stripe === "function"))
        return;

      loadScript('https://js.stripe.com/v3/')
        .then(() => this.buildStripeElement())
        .catch( (error) => console.log(error) );
    }
  },


  methods: {

    createToken() {
      this.stripe.stripe
        .createToken(this.stripe.card)
        .then((result) => {
          if (result.error)
            this.stripe.error = result.error.message;
          else
            this.form.stripe_token = result.token;
        });
    },

    buildStripeElement() {
      this.stripe.stripe = Stripe('pk_test_IlR1Cb2Jgi7D3A6okwhsSRFr');
      var elements = this.stripe.stripe.elements();
      this.stripe.card = elements.create('card', {});
      this.stripe.card.mount('#stripe-element');
      this.stripe.card.addEventListener('change', (event) => {
          this.stripe.error = event.error
            ? event.error.message
            : '';
      });
    },
  }

}

