<template>
    <div class="ordering__wrapper">
        <div class="ordering__content">
            <div class="ordering__top">
                <div class="ordering__top__title">Оформление заказа</div>
                <template v-if="globalSales.length > 0 && nextGlobalSales !== null">
                    <div style="margin-bottom: 17px; font-size: 12px">
                        Еще {{ nextGlobalSales.sum_modal - productsSum }} грн и сработает скидка
                        {{ nextGlobalSales.procent_modal }}%
                    </div>
                    <v-progress-linear :value="linear"
                                       color="#2F7484"
                                       background-color="#ddd"
                                       class="main-linear"
                                       height="12"/>
                </template>
            </div>
            <div class="ordering__middle">
                <div class="ordering__middle__left">
                    <div>
                        <v-form>
                            <div>
                                <p class="main-input-label">Введите номер телефона *</p>
                                <v-text-field
                                    class="main-input-field"
                                    background-color="#F7F7F7"
                                    flat
                                    rounded
                                    height="44"/>
                            </div>
                            <div>
                                <p class="main-input-label">Введите имя *</p>
                                <v-text-field
                                    class="main-input-field"
                                    background-color="#F7F7F7"
                                    flat
                                    rounded
                                    height="44"/>
                            </div>
                            <div>
                                <p class="main-input-label">Введите фамилию *</p>
                                <v-text-field
                                    class="main-input-field"
                                    background-color="#F7F7F7"
                                    flat
                                    rounded
                                    height="44"/>
                            </div>
                            <div>
                                <p class="main-input-label">Введите область *</p>
                                <v-text-field
                                    class="main-input-field"
                                    background-color="#F7F7F7"
                                    flat
                                    rounded
                                    height="44"/>
                            </div>
                            <div>
                                <p class="main-input-label">Введите город *</p>
                                <v-text-field
                                    class="main-input-field"
                                    background-color="#F7F7F7"
                                    flat
                                    rounded
                                    height="44"/>
                            </div>
                            <div>
                                <p class="main-input-label">Выберите отделение Новой Почты *</p>
                                <v-text-field
                                    class="main-input-field"
                                    background-color="#F7F7F7"
                                    flat
                                    rounded
                                    height="44"/>
                            </div>
                            <div>
                                <p class="main-input-label">Выберите способ оплаты *</p>
                                <v-text-field
                                    class="main-input-field"
                                    background-color="#F7F7F7"
                                    flat
                                    rounded
                                    height="44"/>
                            </div>
                        </v-form>
                    </div>
                    <div class="ordering__middle__left__checkout">
                        <div class="checkout-button__wrapper">
                            <v-btn dark class="checkout-button" elevation="0">Оформить заказ</v-btn>
                        </div>
                        <div class="checkout-link" @click="$refs['PlaceOrderOneClick'].visible=true">
                            Оформить в 1 клик
                        </div>
                    </div>
                </div>
                <div class="ordering__middle__right">
                    <div class="ordering__middle__right__product-set">
                        <ProductCardsSet type-set="basket"
                                         :product-data="products"
                                         :is-show-title="false"/>
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
                </div>
            </div>
        </div>
        <div>
            <ProductCardsSet title="Рекомендуемые товары"/>
        </div>

        <PlaceOrderOneClick ref="PlaceOrderOneClick"/>
    </div>
</template>

<script>
    import ProductCardBasket from "../../components/desktop/productCards/ProductCardBasket";
    import PlaceOrderOneClick from "../../components/PlaceOrderOneClickModal";
    import ProductCardsSet from "../../components/desktop/ProductCardsSetDesktop";
    import {mapGetters} from "vuex";

    export default {
        name: "OrderingDesktop",
        components: {
            ProductCardBasket,
            PlaceOrderOneClick,
            ProductCardsSet
        },
        computed: {
            ...mapGetters('basket', [
                'products',
                'globalSales'
            ]),
            currentGlobalSales() {
                let current = null;

                for (let sales of this.globalSales) {
                    if (sales.sum_modal <= this.productsSum) {
                        current = sales;
                    }
                }
                return current;
            },
            nextGlobalSales() {
                let next = null;

                for (let sales of this.globalSales) {
                    if (sales.sum_modal > this.productsSum) {
                        next = sales;
                        break;
                    }
                }
                return next;
            },
            linear() {
                let percentage = 0;
                if (this.nextGlobalSales !== null) {
                    const number = this.nextGlobalSales.sum_modal / 100;
                    percentage = this.productsSum / number;
                }
                return Math.round(percentage);
            },
            productsSum() {
                let sum = 0;
                for (let product of this.products) {
                    sum += +product.price * +product.quantity;
                }
                return sum;
            },
            productsSumWithSales() {
                let sum = this.productsSum;

                if (this.currentGlobalSales !== null) {
                    sum = sum - ((sum / 100) * this.currentGlobalSales.procent_modal);
                }
                return sum;
            }
        }
    }
</script>

<style scoped lang="scss">

    .ordering {

        &__wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: scroll;
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

            &__title {
                font-size: 18px;
                margin: 20px;
            }
        }

        &__middle {
            display: flex;
            flex-direction: row;
            margin-top: 30px;
            flex-wrap: wrap;

            &__left {
                display: flex;
                flex-direction: column;
                width: 50%;

                &__checkout {
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;

                    @media screen and (max-width: 991px) {
                        flex-direction: column;
                        justify-content: center;
                    }
                }
            }

            &__right {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                width: 50%;

                &__product-set {
                    height: 610px;
                    overflow: auto;
                    padding: 7px;
                }
            }
        }
    }

    .main-input-label {
        padding: 0 0 0 20px;
        margin: 0;
        font-weight: 200;
        font-size: 12px;
        line-height: 16px;
    }

    .main-input-field {
        margin: 0;
        padding: 5px;
    }

    .checkout-button {
        border-radius: 50px;
        width: 190px;
        height: 44px !important;
        font-size: 12px;
        line-height: 17px;

        &__wrapper {
            display: flex;

            @media screen and (max-width: 991px) {
                justify-content: center;
            }
        }
    }

    .checkout-link {
        display: flex;
        font-weight: 200;
        font-size: 12px;
        line-height: 16px;
        text-decoration-line: underline;
        margin: auto 0;

        &:hover {
            cursor: pointer;
        }

        @media screen and (max-width: 991px) {
            justify-content: center;
            margin-top: 10px;
        }
    }

    .total {
        display: flex;
        flex-direction: row;
        font-weight: 200;
        font-size: 11px;
        line-height: 15px;

        &__wrapper {
            padding: 20px 0 0 70px;
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
</style>

<style lang="scss">
    .ordering__wrapper {
        & .v-input__slot {
            border-radius: 4px !important;
            margin: 0 0 20px 0 !important;
        }

        & .v-text-field__details {
            display: none;
        }
    }
</style>
