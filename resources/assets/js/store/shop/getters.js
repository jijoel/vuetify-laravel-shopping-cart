export const products = state => {
    return state.products.items
};

export const cartItemList = state => {
    return state.shoppingCart.items;
}

export const cartItems = state => {
    let items = state.shoppingCart.items;
    let cart = [];

    items.forEach((item, index) => {
        let found = state.products.items.find(
            (product) => item.id === product.id
        );

        cart.push({
            ...found,
            quantity: item.quantity,
        });
    });
    return cart;
};

export const cartItemCount = state => {
    return cartItems(state).reduce( (total, current) => {
        return total + current['quantity']
    }, 0);
}

export const cartSubtotal = state => {
    return calculateCart(state, 'price');
}

export const cartShipping = state => {
    return calculateCart(state, 'shipping');
}

export const cartTaxes = state => {
    return Math.floor(
        calculateCart(state, 'price') * .0466 // TODO: tax rate
    );
}

export const cartGrandTotal = state => {
    return cartSubtotal(state) + cartShipping(state) + cartTaxes(state)
}

const calculateCart = (state, value) => {
  return cartItems(state).reduce( (total, current) => {
    return total + (current[value] * current['quantity'])
  }, 0);
}
