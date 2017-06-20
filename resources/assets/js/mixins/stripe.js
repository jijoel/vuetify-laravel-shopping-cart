import loadScript from '../loadScript';

export default {

  data() {
    return {
      stripe: {
        stripe: {},
        card: {},
        errors: {},
        error: '',
        token: {},
      },
    };
  },

  methods: {

    loadPaymentProcessor() {
      if (typeof Stripe === "function")
        return;

      loadScript('https://js.stripe.com/v3/')
        .then(() => this.buildStripeElement())
        .catch( (error) => console.log(error) );
    },

    createToken() {
      this.stripe.stripe
        .createToken(this.stripe.card)
        .then((result) => {
          if (result.error) {
            this.stripe.token = {};
            this.stripe.errors = result.error;
            this.stripe.error = result.error.message;
          } else {
            this.stripe.token = result.token;
          }
        });
    },

    buildStripeElement() {
      this.stripe.stripe = Stripe('pk_test_IlR1Cb2Jgi7D3A6okwhsSRFr');
      var elements = this.stripe.stripe.elements();
      this.stripe.card = elements.create('card', {
        iconStyle: 'solid',
        style: {
          base: {
            lineHeight: '36px',
            // fontWeight: 300,
            // fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSize: '16px',

            '::placeholder': {
              color: '#8898AA',
            },
          },
          invalid: {
            iconColor: '#e85746',
            color: '#e85746',
          }
        },
        classes: {
          focus: 'is-focused',
          empty: 'is-empty',
        },

      });
      this.stripe.card.mount('#stripe-element');
      this.stripe.card.addEventListener('change', (event) => {
          this.stripe.error = event.error
            ? event.error.message
            : '';
      });
    },
  }

}

