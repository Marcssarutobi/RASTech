import { createStore } from "vuex";

const store = createStore({
    state(){
        return{
            cart:[]
        }
    },
    mutations: {
        addToCart(state, product) {
          const item = state.cart.find(item => item.id === product.id);
          if (item) {
            item.quantity++;
          } else {
            state.cart.push({ ...product, quantity: 1 });
          }
        },
        removeFromCart(state, productId) {
            const index = state.cart.findIndex(item => item.id === productId);
            if (index !== -1) {
                state.cart.splice(index, 1);
            }
        },
    },
    getters:{
        cartItems: state => state.cart,
        cartTotal: state => state.cart.reduce((total, product)=> total + product.quantity, 0),
    }
})

export default store