export const loadProducts = ({ commit }) => {
  axios.get('/api/products')
    .then((response) => {
      commit('LOAD_PRODUCTS', response.data);
    })
    .catch((error) => {
      console.log('Error loading products');
      console.log(error);
      console.log(error.response);
    })
}

export const removeItemFromCart = ({ commit }, item) => {
  commit('REMOVE_FROM_CART', item);
}
