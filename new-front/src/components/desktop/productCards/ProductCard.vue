<template>
    <div class="product" @mouseover="isFavoritesShow = true" @mouseleave="isFavoritesShow = false">
        <div class="product__sale" v-if="isShowStock">-50%</div>
        <div class="product__heart"  v-if="isShowFavorite">
            <v-btn
                v-show="isFavoritesShow || isFavorites"
                icon
                large
                size="18"
                color="#000"
                @click="()=>{isFavorites = !isFavorites}">
                <v-icon>{{isFavorites ? 'mdi-cards-heart' : 'mdi-heart-outline'}}</v-icon>
            </v-btn>
        </div>
        <img class="product__image" @click="toPage({name: 'product', params: {id: dataCard['id']}})"
             width="100%" :src="this.api+'/storage/img/products/' + dataCard['image']['name']" :alt="dataCard['image']['name']"/>

        <div class="product__description">
            <div @click="toPage({name: 'product', params: {id: dataCard['id']}})" class="product__description__text">{{ dataCard['product_description']['name'] }}</div>
            <div class="product__description__price default-cursor">{{ dataCard['price'] }} грн</div>
        </div>
        <div>
            <v-btn dark class="product__button" elevation="0" @click="addProductToCart">Купить</v-btn>
        </div>
        <v-snackbar
            v-model="showMessage"
            v-bind="snackbar">
            <v-icon color="white" size="25">
                check_circle_outline
            </v-icon>
            Товар добавлен в корзину
        </v-snackbar>
    </div>
</template>

<script>

import {mapActions} from "vuex";

export default {
    name: "ProductCard",
    props: {
        dataCard: {
            type: Object
        },
        isShowStock: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            isFavorites: false,
            isFavoritesShow: false,
            showMessage: false,
            snackbar: {
                top: true,
                right: true,
                color: 'green',
                timeout: 900,
                multiLine: true
            }
        }
    },
    methods:{
        ...mapActions('basket', {
            addProduct: 'ADD_PRODUCT'
        }),
        addProductToCart() {
            this.showMessage = true;

            const product = this.dataCard;
            product.quantity = 1;

            this.addProduct(product)
        }
    }
}
</script>

<style scoped lang="scss">

.product {
    text-align: center;
    display: flex;
    flex-direction: column;
    padding: 17px 30px 20px 17px;
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
        width: 72px;
        height: 72px;
        line-height:72px;
        font-weight: 300;
        font-size: 21px;
        position: absolute;
    }

    &__heart {
        text-align: right;
        height: 16.5px;
    }

    &__image {
        &:hover {
            cursor: pointer;
        }
    }

    &__description {
        display: flex;
        flex-direction: column;
        row-gap: 10px;

        &__text {
            height: 50px;
            justify-content: center;
            display: flex;
            &:hover {
                cursor: pointer;
            }
        }

        &__price {
            font-weight: 800;
        }
    }

    &__button {
        border-radius: 50px;
        width: 180px;
        height: 48px;
        background-color: #2F7484 !important;
    }
}
</style>
