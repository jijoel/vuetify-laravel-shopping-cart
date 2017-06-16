const state = {

  items: [ ]

}


const mutations = {

  ADD_TO_CART (state, productId) {
    const found = state.items.find(
      (product) => product.id == productId
    );

    if (found)
      found.quantity++;
    else
      state.items.push({
        id: productId,
        quantity: 1,
      });
  },

  REMOVE_FROM_CART (state, removedProduct) {
    const index = state.items.findIndex(
      (currentItem) => currentItem.id === removedProduct.id
    );
    state.items.splice(index, 1);
  }

}



export default {
  state,
  mutations,
}
