<template>
    <div class="product-card__wrapper">
        <div class="product-card__wrapper-content">
            <div class="product-card__title">{{title}}</div>
            <div class="product-card__content">
                <ProductCard class="product-card__item"
                             v-for="item in productData"
                             :key="item.id"
                             :data-card="item"
                             :is-show-stock="item.isShowStock"/>
            </div>
        </div>
    </div>
</template>

<script>
    import ProductCard from "./ProductCard";

    export default {
        name: "ProductCardSet",
        components: {
            ProductCard
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
                        isShowStock: false
                    },
                    {
                        id: 2,
                        img: '../public/product-images/product-images.svg',
                        isShowStock: false
                    },
                    {
                        id: 3,
                        img: '../../public/product-images/product-images.svg',
                        isShowStock: false
                    },
                    {
                        id: 4,
                        img: '../../public/product-images/product-images.svg',
                        isShowStock: false
                    },
                    {
                        id: 5,
                        img: '../../public/product-images/product-images.svg',
                        isShowStock: false
                    },
                    {
                        id: 6,
                        img: '../../public/product-images/product-images.svg',
                        isShowStock: false
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
    .product-card {

        &__wrapper {
            margin-bottom: 40px;
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        &__wrapper-content {
            width: 90%;
            display: flex;
            flex-direction: column;
            text-align: center;
        }

        &__title {
            text-align: center;
            font-weight: 200;
            font-size: 34px;
            line-height: 46px;
            margin: 40px;
            text-transform: uppercase;
        }

        &__content {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-around;
            row-gap: 40px;
        }

        &__item {
            width: 30%;
        }
    }
</style>
