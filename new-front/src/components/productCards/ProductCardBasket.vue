<template>
    <div class="product-basket__wrapper">
        <div class="product-basket__left">
            <img height="150" width="150" src="../../../public/product-images/product-image.svg"/>
        </div>
        <div class="product-basket__right">
            <div class="product-basket__right__title" @click="toPage({name: 'product', params: {id: 1}})">
                Очищающая маска для лица Конопля Водоросли
            </div>
            <div class="product-basket__right__text">
                <div>Количество</div>
                <div style="display: flex; flex-direction: row">
                    <v-icon class="main-icon-btn" size="12" @click="count_good >0 ? count_good-- : null">
                        mdi-minus
                    </v-icon>
                    <input style="width: 30px" v-model="count_good" type="number" :min="0"/>
                    <v-icon class="main-icon-btn" size="12" @click="count_good++">mdi-plus</v-icon>
                </div>
                <div class="product-basket__right__text__price">Цена: 1920 грн.</div>
                <div class="product-basket__right__text__delete-basket" @click="$emit('delete')">Удалить из корзины
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "ProductCardBasket",
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
            flex-direction: row;
            padding: 10px;
            column-gap: 10px;

            &:hover {
                box-shadow: 0 0 33px #f2f2f2;
            }
        }

        &__left {
            width: 50%;
        }

        &__right {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 50%;
            text-align: left;

            &__title {
                font-weight: 700;
                font-size: 10px;
                line-height: 14px;
            }

            &__text {
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

    $rating-dense-padding: 2rem !important;
</style>
