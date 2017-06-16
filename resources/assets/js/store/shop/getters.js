export const products = state => {
    return state.products.items
};

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

