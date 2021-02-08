<template>
            <div class="product-card-basket__wrapper">
        <!--        <div class="product-card__wrapper-content">-->
        <!--            <div class="product-card__title">{{title}}</div>-->
        <!--            <div class="product-card__content">-->
        <ProductCardBasket v-for="item in productData"
                           :key="item.id"
                           :data-card="item"/>
        <!--                <ProductCard class="product-card__item"-->
        <!--                             v-for="item in productData"-->
        <!--                             :key="item.id"-->
        <!--                             :data-card="item"-->
        <!--                             :is-show-stock="item.isShowStock"/>-->
        <!--            </div>-->
        <!--        </div>-->
            </div>
</template>

<script>
    import ProductCardBasket from "./ProductCardBasket";
    import ProductCard from "./ProductCard";

    export default {
        name: "ProductCardBasketSet",
        components: {
            ProductCard,
            ProductCardBasket
        },
        props: {
            title: {
                type: String,
                default: ''
            },
            productData: {
                type: Array,
                default: () => [
                    {
                        id: 1,
                        img: '../../../public/product-images/product-images.svg',
                    },
                    {
                        id: 2,
                        img: '../public/product-images/product-images.svg',
                    },
                    {
                        id: 3,
                        img: '../../public/product-images/product-images.svg',
                    },
                    {
                        id: 4,
                        img: '../../public/product-images/product-images.svg',
                    },
                    {
                        id: 5,
                        img: '../../public/product-images/product-images.svg',
                    },
                    {
                        id: 6,
                        img: '../../public/product-images/product-images.svg',
                    }
                ]
            }
        },
        data() {
            return {}
        }
    }
</script>

<style scoped lang="scss">
    .product-card-basket {

        &__wrapper {
            margin-bottom: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /*&__wrapper-content {*/
        /*    width: 90%;*/
        /*    display: flex;*/
        /*    flex-direction: column;*/
        /*    text-align: center;*/
        /*}*/

        /*&__title {*/
        /*    text-align: center;*/
        /*    font-weight: 200;*/
        /*    font-size: 34px;*/
        /*    line-height: 46px;*/
        /*    margin: 40px;*/
        /*    text-transform: uppercase;*/
        /*}*/

        /*&__content {*/
        /*    display: flex;*/
        /*    flex-direction: row;*/
        /*    flex-wrap: wrap;*/
        /*    justify-content: space-around;*/
        /*    row-gap: 40px;*/
        /*}*/

        /*&__item {*/
        /*    width: 30%;*/
        /*}*/
    }
</style>
