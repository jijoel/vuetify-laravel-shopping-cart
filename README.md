# Vuetify Laravel Shopping Cart

![screenshot](/docs/storefront.png?raw=true "Store Front")

This is an experimental shopping cart with Vuetify and Laravel. It's my attempt to learn how to put all of the pieces of a simple, but non-trivial application together.

This is a single-page web app. Data is served to the Vue front-end via a Laravel API, and kept in a Vuex store.

### Features

- [x] Storefront:
    - [x] List products
    - [x] Add items to cart
    - [x] Mark items as sold-out
    - [x] Search for products
    - [x] Check-out dialog box
    - [x] Connection to Stripe for credit card data
    - [x] Field sanitization
    - [x] Validation from Laravel and front-end js

- [x] Testing:
    - [x] Browser tests (end-to-end Dusk acceptance tests)
    - [x] Feature tests
    - [x] Unit tests

### To-do

- [ ] Admin panel:
    - [ ] Add, edit, delete products
    - [ ] Show / complete active orders
    - [ ] Show sales chart
    - [ ] Log ins / authentication
    - [ ] Restrictions / authorization
    - [ ] Add, edit, delete users (admin only)

### Help Wanted

I'm pretty much making this up as I go along. In many cases, I don't know if I'm doing it right. Feedback, bug reports, and pull requests are all very welcome!


### Installation

This is a standard Laravel project, so all standard processes should just work right out of the box:

    git clone git@github.com:jijoel/vuetify-laravel-shopping-cart.git
    composer install
    php artisan migrate --seed
    yarn install
    npm run dev


### Resources

Thank you to https://github.com/matheusazzi/shop-vue for the inspiration and basic template.
