const state = {

  items: []

}


const mutations = {
  LOAD_PRODUCTS (state, products) {
    state.items = products
  },

  ADD_TO_CART (state, productId) {
    state.items
      .find(product => product.id === productId)
      .inventory--
  },

  REMOVE_FROM_CART (state, removedProduct) {
    state.items
      .find(product => product.id === removedProduct.id)
      .inventory += removedProduct.quantity
  }
}



export default {
  state,
  mutations,
}
