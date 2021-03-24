const state = {
    products: []
}

const mutations = {
    ADD_PRODUCT(state, product) {
        const existProduct = state.products.find(p => p.id === product.id);

        if (existProduct !== undefined) {
            state.products = state.products.map(p => {
                p.quantity += +product.quantity;

                return p;
            })
        } else {
            state.products.push(product);
        }
    },
    DELETE_PRODUCT(state, productId) {
        state.products = state.products.filter(p => p.id !== productId)
    },
    INCREMENT_PRODUCT_QUANTITY(state, productId) {
        state.products = state.products.map(p => {
            if (p.id === productId) {
                p.quantity++;
            }
            return p;
        })
    },
    DECREMENT_PRODUCT_QUANTITY(state, productId) {
        state.products = state.products.map(p => {
            if (p.id === productId) {
                p.quantity--;
            }
            return p;
        })
    }
}

const actions = {
    ADD_PRODUCT(context, product) {
        context.commit('ADD_PRODUCT', product);
    },
    DELETE_PRODUCT(context, productId) {
        context.commit('DELETE_PRODUCT', productId);
    },
    INCREMENT_PRODUCT_QUANTITY(context, productId) {
        context.commit('INCREMENT_PRODUCT_QUANTITY', productId);
    },
    DECREMENT_PRODUCT_QUANTITY(context, productId) {
        context.commit('DECREMENT_PRODUCT_QUANTITY', productId);
    },
}

const getters = {
    products: state => state.products
}

export default {
    namespaced: true,
    state,
    mutations,
    getters,
    actions
}
