const state = {

  items: [
{
id: 1,
title: "Nemo esse nisi facilis cumque tempore.",
description: "Facilis velit enim dolor reiciendis voluptatem non. Laboriosam voluptatibus velit et officiis vitae sint aspernatur. Est quidem ratione possimus sed eos dolore.",
image: "http://lorempixel.com/640/480/?43840",
price: 5006,
inventory: 13,
shipping: 60,
created_at: "2017-06-15 23:30:44",
updated_at: "2017-06-15 23:30:44"
},
{
id: 2,
title: "Eum quos molestiae quos est dolores numquam asperiores.",
description: "Non et voluptatem vel quia at laborum eos. Similique accusamus qui qui odit corporis. Id aut est modi quasi doloremque.",
image: "http://lorempixel.com/640/480/?92653",
price: 75163,
inventory: 62,
shipping: 62,
created_at: "2017-06-15 23:30:44",
updated_at: "2017-06-15 23:30:44"
},
{
id: 3,
title: "Magnam suscipit eum numquam.",
description: "Dolor consequatur molestiae nemo minus. Fugiat enim ut tempora maxime et accusamus. Aliquid et vel doloribus et ab libero et.",
image: "http://lorempixel.com/640/480/?65769",
price: 166533,
inventory: 91,
shipping: 15,
created_at: "2017-06-15 23:30:44",
updated_at: "2017-06-15 23:30:44"
},

{
id: 4,
title: "Magnam suscipit eum numquam.",
description: "Dolor consequatur molestiae nemo minus. Fugiat enim ut tempora maxime et accusamus. Aliquid et vel doloribus et ab libero et.",
image: "http://lorempixel.com/640/480/?65769",
price: 166533,
inventory: 91,
shipping: 15,
created_at: "2017-06-15 23:30:44",
updated_at: "2017-06-15 23:30:44"
},


{
id: 5,
title: "Magnam suscipit eum numquam.",
description: "Dolor consequatur molestiae nemo minus. Fugiat enim ut tempora maxime et accusamus. Aliquid et vel doloribus et ab libero et.",
image: "http://lorempixel.com/640/480/?65769",
price: 166533,
inventory: 91,
shipping: 15,
created_at: "2017-06-15 23:30:44",
updated_at: "2017-06-15 23:30:44"
},






  ]
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
