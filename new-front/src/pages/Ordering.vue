<template>
    <div class="ordering__wrapper">
        <div class="ordering__content">
            <div class="ordering__top">
                <div class="ordering__top__title">Оформление заказа</div>
                <div style="margin-bottom: 17px">Еще 735 грн и сработает скидка 50%</div>
                <v-progress-linear v-model="linear"
                                   color="#2F7484"
                                   background-color="#ddd"
                                   class="main-linear"
                                   height="12"/>
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
                                <p class="main-input-label">Введите номер телефона *</p>
                                <v-text-field
                                    class="main-input-field"
                                    background-color="#F7F7F7"
                                    flat
                                    rounded
                                    height="44"/>
                            </div>
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
                                <p class="main-input-label">Введите номер телефона *</p>
                                <v-text-field
                                    class="main-input-field"
                                    background-color="#F7F7F7"
                                    flat
                                    rounded
                                    height="44"/>
                            </div>
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
                                <p class="main-input-label">Введите номер телефона *</p>
                                <v-text-field
                                    class="main-input-field"
                                    background-color="#F7F7F7"
                                    flat
                                    rounded
                                    height="44"/>
                            </div>
                            <div>
                                <p class="main-input-label">Введите номер телефона *</p>
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
                        <div>
                            <v-btn dark class="checkout-button" elevation="0">Оформить заказ</v-btn>
                        </div>
                        <div class="checkout-link" @click="$refs['PlaceOrderOneClick'].visible=true">
                            Оформить в 1 клик
                        </div>
                    </div>
                </div>
                <div class="ordering__middle__right">
                    <div style="height: 520px; overflow: auto; padding: 7px">
                        <ProductCardBasketSet/>
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
            <ProductCardSet title="Рекомендуемые товары"/>
        </div>

        <PlaceOrderOneClick ref="PlaceOrderOneClick"/>
    </div>
</template>

<script>
    import ProductCardSet from "../components/ProductCardSet";
    import ProductCardBasket from "../components/ProductCardBasket";
    import ProductCardBasketSet from "../components/ProductCardBasketSet";
    import PlaceOrderOneClick from "../components/PlaceOrderOneClick";

    export default {
        name: "Ordering",
        components: {
            ProductCardSet,
            ProductCardBasket,
            ProductCardBasketSet,
            PlaceOrderOneClick
        },
        data() {
            return {
                linear: 70,
                productData: [
                    {
                        id: 1,
                        img: '../../../public/product-images/product-images.svg'
                    },
                    {
                        id: 2,
                        img: '../public/product-images/product-images.svg'
                    },
                    {
                        id: 3,
                        img: '../../public/product-images/product-images.svg'
                    },
                    {
                        id: 4,
                        img: '../../public/product-images/product-images.svg'
                    },
                    {
                        id: 5,
                        img: '../../public/product-images/product-images.svg'
                    },
                    {
                        id: 6,
                        img: '../../public/product-images/product-images.svg'
                    }
                ]
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
                text-transform: uppercase;
                margin: 20px;
            }
        }

        &__middle {
            display: flex;
            flex-direction: row;
            margin-top: 30px;

            &__left {
                width: 50%;

                &__checkout {
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                }
            }

            &__right {
                width: 50%;
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
        background-color: #2F7484 !important;
        text-transform: none !important;
        font-weight: 500;
        font-size: 12px;
        line-height: 17px;
    }

    .checkout-link {
        font-weight: 200;
        font-size: 12px;
        line-height: 16px;
        text-decoration-line: underline;
        margin: auto 0;

        &:hover {
            cursor: pointer;
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
