<template>
    <div class="product" @mouseover="isFavoritesShow = true" @mouseleave="isFavoritesShow = false">
        <div class="product__sale" v-if="isShowStock">-{{ dataCard.get_sale.percent }}%</div>
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
             :src="dataCard.image ? this.api+'/storage/img/products/' + dataCard.image.name : ''" :alt="dataCard.image ? dataCard.image.name : ''"/>

        <div class="product__description">
            <div @click="toPage({name: 'product', params: {id: dataCard['id']}})" class="product__description__text" style=" display: block; text-overflow: ellipsis; white-space: normal;">{{ dataCard['product_description']['name'] }}</div>
            <div class="product__description__price default-cursor">{{ isShowStock ? dataCard.price_with_sale: dataCard.price }} грн</div>
        </div>
        <div>
            <v-btn :disabled="dataCard.stock_status_id === 3" class="product__button white--text" elevation="0" @click="addProductToCart">
                {{ dataCard.stock_status_id === 3 ? 'Нет в наличии' : 'Купить'}}
            </v-btn>
        </div>
        <v-snackbar
            v-model="showMessage"
            v-bind="snackbar">
            Товар добавлен в корзину
        </v-snackbar>
    </div>
</template>

<script>

    import {mapActions} from "vuex";

    export default {
        name: "ProductCard",
        metaInfo() {
            return {
                title: this.dataCard.product_description.meta_title,
                meta: [
                    {
                        vmid: 'description',
                        name: 'description',
                        content: this.dataCard.product_description.meta_description
                    },
                    {vmid: 'keyword', name: 'keyword', content: this.dataCard.product_description.meta_keyword},
                    {vmid: 'h1', name: 'h1', content: this.dataCard.product_description.meta_h1},
                    {vmid: 'tag', name: 'tag', content: this.dataCard.product_description.tag},
                ]
            }
        },
        props: {
            dataCard: {
                type: Object,
                image: {
                    name: ''
                },
                product_description: {}
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
        methods: {
            ...mapActions('basket', {
                addProduct: 'ADD_PRODUCT'
            }),
            addProductToCart() {
                this.showMessage = true;

                const product = this.dataCard;
                product.quantity = (product.minimum !== 0) ? product.minimum : 1;

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
        padding: 17px 30px 20px 30px;
        row-gap: 10px;
        width: 350px !important;
        position: relative;

        &:hover {
            box-shadow: 0 0 33px #f2f2f2;

            & .product__button[disabled] {
                background-color: #909090 !important;
            }

            & .product__button {
                background-color: #000 !important;
            }
        }

        &__sale {
            color: #fff;
            background-color: #000;
            border-radius: 50%;
            width: 72px;
            height: 72px;
            line-height: 72px;
            font-weight: 300;
            font-size: 21px;
            position: absolute;
          left: 20px;
          top: 20px;
        }

        /*&__heart {*/
        /*    text-align: right;*/
        /*    height: 16.5px;*/
        /*}*/

        &__image {
            width: 290px;

            &:hover {
                cursor: pointer;
            }
        }

        &__description {
            display: flex;
            flex-direction: column;
            row-gap: 10px;
            text-transform: none;

            &__text {
                justify-content: center;
                display: flex;
                overflow: hidden;
                font-style: normal;
                font-weight: 500;
                font-size: 18px;
                line-height: 25px;
                text-align: center;

                &:hover {
                    cursor: pointer;
                }
            }

            &__price {
                font-style: normal;
                font-weight: 800;
                font-size: 18px;
                line-height: 25px;
            }
        }

        &__button {
            text-transform: none;
            border-radius: 50px;
            width: 180px;
            height: 48px !important;
            padding: 0 !important;
            background-color: #2F7484 !important;
            font-style: normal;
            font-weight: bold;
            font-size: 16px;
            line-height: 22px;
            margin: 10px;

            /*&:hover {*/
            /*    &[disabled].product__button {*/
            /*        background-color: #ded4d4 !important;*/
            /*    }*/
            /*}*/
        }
    }
</style>
