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
    globalSales: state => state.globalSales,
    currentGlobalSales: (state, getters) => {
        let current = null;

        for (const [key, sales] of Object.entries(state.globalSales)) {
            if (sales.sum_modal <= getters.productsSum) {
                current = sales;
            }
        }
        return current;
    },
    nextGlobalSales: (state, getters) => {
        let next = null;

        for (let sales of state.globalSales) {
            if (sales.sum_modal > getters.productsSum) {
                next = sales;
                break;
            }
        }
        return next;
    },
    linear: (state, getters) => {
        let percentage = 0;

        if (getters.nextGlobalSales !== null) {
            const number = getters.nextGlobalSales.sum_modal / 100;

            if (getters.productsSum > number) {
                percentage = getters.productsSum / number;
            }
        }
        return Math.round(percentage);
    },
    productsSum: state => {
        let sum = 0;
        for (let product of state.products) {
            sum += +product.price * +product.quantity;
        }
        return sum;
    },
    productsSumWithSales: (state, getters) => {
        let sum = getters.productsSum;

        if (getters.currentGlobalSales !== null) {
            sum = sum - ((sum / 100) * getters.currentGlobalSales.procent_modal);
        }
        return sum;
    }
}

export default {
    namespaced: true,
    state,
    mutations,
    getters,
    actions
}