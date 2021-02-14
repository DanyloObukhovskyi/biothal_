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
                <div>Корзина(3)</div>
                <v-btn icon @click="visibleModal(false)">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </div>
            <div class="ordering__wrapper">
                <div>
                    <div class="ordering__top">
                        <div style="margin-bottom: 17px; font-size: 12px">Еще 735 грн и сработает скидка 50%</div>
                        <v-progress-linear v-model="linear"
                                           color="#2F7484"
                                           background-color="#ddd"
                                           class="main-linear"
                                           height="12"/>
                    </div>
                    <div class="ordering__middle">
                        <div class="ordering__middle__product-set">
                            <ProductCardsSet type-set="basket" :is-show-title="false"/>
                        </div>
                        <div class="total__wrapper">
                            <div class="total">
                                <div class="total__left">
                                    Стоимость товаров:
                                </div>
                                <div class="total__right">
                                    5555 грн.
                                </div>
                            </div>
                            <div class="total">
                                <div class="total__left">
                                    Стоимость доставки:
                                </div>
                                <div class="total__right">
                                    40 грн.
                                </div>
                            </div>
                            <div class="total">
                                <div class="total__left" style="font-weight: 700">
                                    Итого к оплате:
                                </div>
                                <div class="total__right" style="font-weight: 700">
                                    2320 грн.
                                </div>
                            </div>
                        </div>
                        <div>
                            <v-btn dark class="checkout-button" elevation="0" @click="toPage({name: 'ordering'})">
                                Оформить заказ
                            </v-btn>
                        </div>
                    </div>
                </div>
                <div style="text-align: center">
                    <div v-if="!isMobile" style="margin: 20px; font-size: 16px">Рекомендуемые товары</div>
                    <ProductCardsSet v-if="!isMobile" type-set="basket-menu" :is-show-title="false"/>
                    <ProductCardsSetMobile v-if="isMobile" type-set="product" title="Рекомендуемые товары"/>
                </div>
            </div>
        </v-card>
    </v-navigation-drawer>
</template>

<script>
    import ProductCardsSet from "./desktop/ProductCardsSetDesktop";
    import ProductCardsSetMobile from "./mobile/ProductCardsSetMobile";

    export default {
        name: "Basket",
        components: {
            ProductCardsSet,
            ProductCardsSetMobile
        },
        data() {
            return {
                visible: false,
                linear: 70
            }
        },
        watch: {
            visible(newValue) {
                if (newValue) {
                    document.querySelector('html').classList.add('hide-scroll')
                } else {
                    document.querySelector('html').classList.remove('hide-scroll')
                }
            }
        },
        methods: {
            visibleModal(visible) {
                window.scrollTo(0,0)
                this.visible = visible
            }
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

    .ordering {
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
        border-radius: 50px;
        width: 335px;
        height: 54px !important;
        background-color: #2F7484 !important;
        text-transform: none !important;
        font-weight: 500;
        font-size: 16px;
        line-height: 22px;
        margin-top: 15px;
    }
</style>
