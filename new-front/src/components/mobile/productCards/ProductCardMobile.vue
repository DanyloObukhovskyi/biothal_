<template>
    <div class="product" @mouseover="isFavoritesShow = true" @mouseleave="isFavoritesShow = false">
        <div class="product__sale" v-if="isShowStock">-50%</div>
        <img class="product__image" src="../../../../public/product-images/product-image.svg"/>
        <div class="product__description">
            <div @click="toPage({name: 'product', params: {id: 1}})" class="product__description__text">Очищающая маска для лица Конопля Водоросли</div>
            <div class="product__description__price default-cursor">1920 грн</div>
        </div>
        <div>
            <v-btn dark class="product__button" elevation="0">Купить</v-btn>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductCardMobile",
        props: {
            dataCard: {
                type: Object,
                default: ()=>[]
            },
            isShowStock: {
                type: Boolean,
                default: false
            }
        },
        components: {
        },
        data() {
            return {
                isFavorites: false,
                isFavoritesShow: false,
            }
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
            line-height:33px;
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
