<template>
    <v-navigation-drawer
        :width="isMobile ? '100%' : '420'"
        :right="!isMobile"
        v-model="visible"
        height="100vh"
        absolute
        temporary>
        <v-card flat>
            <div class="basket__header">
                <div>Корзина({{ products.length }})</div>
                <v-btn icon @click="visibleModal(false)">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </div>
            <div class="page-form__wrapper">
                <div>
                    <div class="page-form__top" v-if="globalSales.length > 0 && nextGlobalSales !== null">
                        <div style="margin-bottom: 17px; font-size: 12px">
                            Еще {{ nextGlobalSales.sum_modal - productsSum }} грн и сработает скидка
                            {{ nextGlobalSales.procent_modal }}%
                        </div>
                        <v-progress-linear :value="linear"
                                           color="#2F7484"
                                           background-color="#ddd"
                                           class="main-linear"
                                           height="12"/>
                    </div>
                    <div class="page-form__middle">
                        <div class="page-form__middle__product-set">
                            <ProductCardsSet type-set="basket"
                                             :is-show-title="false"
                                             @delete="deleteProduct"
                                             :product-data="products"/>
                        </div>
                        <div class="total__wrapper">
                            <div class="total">
                                <div class="total__left">
                                    Стоимость товаров:
                                </div>
                                <div class="total__right">
                                    {{ productsSum }} грн.
                                </div>
                            </div>
                            <div class="total">
                                <div class="total__left">
                                    Стоимость доставки:
                                </div>
                                <div class="total__right">
                                    {{ deliveryPrice }} грн.
                                </div>
                            </div>
                            <div class="total" v-if="currentGlobalSales !== null">
                                <div class="total__left">
                                    Скидка:
                                </div>
                                <div class="total__right">
                                    {{ currentGlobalSales.procent_modal }}%.
                                </div>
                            </div>
                            <div class="total">
                                <div class="total__left" style="font-weight: 700">
                                    Итого к оплате:
                                </div>
                                <div class="total__right" style="font-weight: 700">
                                    {{ productsSumWithSales + deliveryPrice }} грн.
                                </div>
                            </div>
                        </div>
                        <div class="checkout-button__wrapper">
                            <v-btn dark class="checkout-button" elevation="0" @click="toPage({name: 'ordering'})">
                                Оформить заказ
                            </v-btn>
                        </div>
                    </div>
                </div>
                <div style="text-align: center">
                    <div v-if="!isMobile" style="margin: 20px; font-size: 16px">Рекомендуемые товары</div>
                    <ProductCardsSet v-if="!isMobile"
                                     :product-data="recommendedProducts"
                                     type-set="basket-menu"
                                     :is-show-title="false"/>
                    <ProductCardsSetMobile v-if="isMobile"
                                           :product-data="recommendedProducts"
                                           ype-set="product"
                                           title="Рекомендуемые товары"/>
                </div>
            </div>
        </v-card>
    </v-navigation-drawer>
</template>

<script>
import ProductCardsSet from "./desktop/ProductCardsSetDesktop";
import ProductCardsSetMobile from "./mobile/ProductCardsSetMobile";
import {mapActions, mapGetters} from "vuex";

export default {
    name: "Basket",
    components: {
        ProductCardsSet,
        ProductCardsSetMobile
    },
    data() {
        return {
            visible: false,
            deliveryPrice: 40,
            recommendedProducts: [],
        }
    },
    computed: {
        ...mapGetters('basket', [
            'products',
            'globalSales',
            'currentGlobalSales',
            'nextGlobalSales',
            'linear',
            'productsSum',
            'productsSumWithSales'
        ]),
    },
    watch: {
        visible(newValue) {
            if (newValue) {
                document.querySelector('html')
                    .classList
                    .add('hide-scroll')
            } else {
                document.querySelector('html')
                    .classList
                    .remove('hide-scroll')
            }
        }
    },
    methods: {
        ...mapActions('basket', {
            deleteProduct: 'DELETE_PRODUCT',
            setGlobalSales: 'SET_GLOBAL_SALES'
        }),
        visibleModal(visible) {
            window.scrollTo(0, 0)
            this.visible = visible
        },
        getGlobalSales() {
            this.axios.post('sales/global')
                .then(({data}) => {
                    this.setGlobalSales(data)
                })
        },
        getRecommendedProduct() {
            this.axios.post('products/recommended')
                .then(({data}) => {
                    this.recommendedProducts = data
                })
        }
    },
    mounted() {
        this.getGlobalSales();
        this.getRecommendedProduct();
    }
}
</script>

<style scoped lang="scss">

.basket {

    &__header {
        display: flex;
        justify-content: space-between;
        width: 100%;
        padding: 25px 20px 0 20px;
    }

    &__info {
        overflow: auto;
        height: 100vh;
    }
}

.total {
    display: flex;
    flex-direction: row;
    font-weight: 200;
    font-size: 11px;
    line-height: 15px;

    &__wrapper {
        padding: 20px 0 0 0;
    }

    &__left {
        width: 50%;
    }

    &__right {
        width: 50%;
        text-align: right;
    }
}

.main-linear {
    border-radius: 60px;
}

.page-form {
    &__wrapper {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 40px;

        @media screen and (max-width: 600px) {
            background-color: #F7F7F7;
            padding: 20px;
        }
    }

    &__content {
        width: 70%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    &__top {
        display: flex;
        flex-direction: column;
        text-align: center;
    }

    &__middle {

        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 100%;

        &__product-set {
            height: 580px;
            overflow: auto;
            padding: 7px;
        }
    }
}

.checkout-button {
    margin-top: 15px;

    &__wrapper {
        display: flex;
        justify-content: center;
    }
}
</style>
