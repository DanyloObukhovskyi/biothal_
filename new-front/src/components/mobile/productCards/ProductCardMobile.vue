<template>
    <div class="product" @mouseover="isFavoritesShow = true" @mouseleave="isFavoritesShow = false">
        <div class="product__sale" v-if="isShowStock">-50%</div>
        <img class="product__image"
             :src="this.api+'/storage/img/products/' + dataCard.image.name" :alt="dataCard.image.name"/>
        <div class="product__description">
            <div @click="toPage({name: 'product', params: {id: 1}})" class="product__description__text">
                {{ dataCard.product_description.name }}
            </div>
            <div class="product__description__price default-cursor">{{ dataCard.price }} грн</div>
        </div>
        <div>
            <v-btn dark class="product__button" elevation="0" @click="addToCart">Купить</v-btn>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "ProductCardMobile",
    props: {
        dataCard: {
            type: Object,
            default: () => []
        },
        isShowStock: {
            type: Boolean,
            default: false
        }
    },
    components: {},
    data() {
        return {
            isFavorites: false,
            isFavoritesShow: false,
        }
    },
    methods: {
        ...mapActions('basket', {
            addProduct: 'ADD_PRODUCT'
        }),
        addToCart() {
            const product = this.dataCard;
            product.quantity = 1;

            this.addProduct(product)
        },
    }
}
</script>

<style scoped lang="scss">

.product {
    background-color: #fff;
    text-align: center;
    display: flex;
    flex-direction: column;
    padding: 0 10px 10px 10px;
    row-gap: 10px;

    &:hover {
        box-shadow: 0 0 33px #f2f2f2;

        & .product__button {
            background-color: #000 !important;
        }
    }

    &__sale {
        vertical-align: middle;
        color: #fff;
        background-color: #000;
        border-radius: 50%;
        width: 33px;
        height: 33px;
        line-height: 33px;
        font-weight: 400;
        font-size: 9px;
        position: absolute;
    }

    &__image {
        width: 100%;
    }

    &__description {
        display: flex;
        flex-direction: column;
        row-gap: 10px;
        font-size: 10px;
        font-weight: 400;
        line-height: 14px;

        &__text {
            &:hover {
                cursor: pointer;
            }
        }

        &__price {
            font-size: 13px;
            font-weight: 700;
            line-height: 18px;
        }
    }

    &__button {
        border-radius: 50px;
        width: 100px;
        height: 28px;
        text-transform: none;
        background-color: #2F7484 !important;
    }
}
</style>
