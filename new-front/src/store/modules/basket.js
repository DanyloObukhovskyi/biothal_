const state = {
    products: [],
    globalSales: []
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
    },
    SET_GLOBAL_SALES(state, globalSales) {
        state.globalSales = globalSales;
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
    SET_GLOBAL_SALES(context, globalSales) {
        context.commit('SET_GLOBAL_SALES', globalSales);
    }
}

const getters = {
    products: state => state.products,
    globalSales: state => state.globalSales
}

export default {
    namespaced: true,
    state,
    mutations,
    getters,
    actions
}
