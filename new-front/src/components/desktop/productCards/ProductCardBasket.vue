<template>
    <div class="product-basket__wrapper">
        <div class="product-basket__sale" v-if="isShowStock">-{{ dataCard.get_sale.percent }}%</div>
        <div class="product-basket__left">
            <img class="product-basket__image" height="150" width="150"
                 @click="toPage({name: 'product', params: {id: dataCard.id}})"
                 :src="this.api+'/storage/img/products/' + dataCard.image.name" :alt="dataCard.image.name"/>
        </div>
        <div class="product-basket__right">
            <div class="product-basket__right__title" @click="toPage({name: 'product', params: {id: dataCard.id}})">
                {{ dataCard.product_description.name }}
            </div>
            <div class="product-basket__right__text">
                <div>Количество</div>
                <div style="display: flex; flex-direction: row">
                    <v-icon class="main-icon-btn" size="12" @click="dataCard.quantity > dataCard.minimum ? decrementQuantity(dataCard.id) : null">
                        mdi-minus
                    </v-icon>
                    <input style="width: 30px" v-model="dataCard.quantity" type="number" :min="dataCard.minimum"/>
                    <v-icon class="main-icon-btn" size="12" @click="incrementQuantity(dataCard.id)">mdi-plus</v-icon>
                </div>
                <div class="product-basket__right__text__price">Цена: {{ isShowStock ? dataCard.price_with_sale: dataCard.price }} грн.</div>
                <div class="product-basket__right__text__delete-basket" @click="$emit('delete')">Удалить из корзины
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import {mapActions} from "vuex";

export default {
    name: "ProductCardBasket",
    props: {
        dataCard: {
            type: Object,
        },
        isShowStock: {
            type: Boolean,
            default: false
        }
    },
    watch: {
        'dataCard.quantity': function (value) {
            if (value === 0) {
                this.$emit('delete')
            }
        }
    },
    methods: {
        ...mapActions('basket', {

            incrementQuantity: 'INCREMENT_PRODUCT_QUANTITY',
            decrementQuantity: 'DECREMENT_PRODUCT_QUANTITY'
        }),
    },
    mounted() {
        window.app = this
    }
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

    &__image {
        max-width: 100%;
    }

    &__left {
        background-color: #fff;
        width: 50%;
    }

    &__sale {
        vertical-align: middle;
        color: #fff;
        background-color: #000;
        border-radius: 50%;
        width: 50px;
        height: 41px;
        line-height: 40px;
        font-weight: 300;
        font-size: 16px;
        position: relative;
    }

    &__right {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 50%;
        text-align: left;
        padding: 15px 0 15px 20px;

        &__title {
            cursor: pointer;
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
.product-basket__image {
    cursor: pointer;
    max-width: 100%;
}

</style>
