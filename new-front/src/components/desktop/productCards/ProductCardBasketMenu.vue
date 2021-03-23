<template>
    <div class="product-basket__wrapper">
        <div class="product-basket">
            <img class="product-basket__image" height="150" width="150"
                 src="../../../../public/product-images/product-image.svg"/>
        </div>
        <div class="product-basket">
            <div class="product-basket__title" @click="toPage({name: 'product', params: {id: 1}})">
                Очищающая маска для лица Конопля Водоросли
            </div>
            <div class="product-basket__text">
                <div class="product-basket__text__price">1920 грн</div>
                <div class="product-basket__text__delete-basket">
                    <v-btn dark class="product__button" elevation="0" @click="$emit('delete')">
                        Добавить
                    </v-btn>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "ProductCardBasketMenu",
        props: {
            dataCard: {
                type: Object,
                default: () => {
                }
            }
        },
        data() {
            return {
                count_good: 0,
            }
        },
        methods: {}
    }
</script>

<style scoped lang="scss">

    .product-basket {

        &__wrapper {
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 10px;
            column-gap: 10px;

            &:hover {
                box-shadow: 0 0 33px #f2f2f2;
            }
        }

        &__image {
            width: 100%;
        }

        display: flex;
        flex-direction: column;
        justify-content: center;
        width: 100%;
        text-align: center;

        &__title {
            font-weight: 700;
            font-size: 10px;
            line-height: 14px;
        }

        &__text {
            display: flex;
            flex-direction: column;
            justify-content: center;
            font-size: 11px;

            &__price {
                font-weight: 700;
            }

            &__delete-basket {
                color: #C2C2C2;

                &:hover {
                    cursor: pointer;
                    text-decoration: underline;
                }
            }
        }
    }

    input[type=number] {
        &::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        text-align: center;
    }

    .main-icon-btn {
        &:hover {
            cursor: pointer;
        }
    }

    .product__button {
        border-radius: 50px;
        width: 100px;
        height: 28px !important;
        background-color: #2F7484 !important;
        text-transform: none !important;
        font-weight: 700;
        font-size: 11px;
        line-height: 15px;
    }
</style>
