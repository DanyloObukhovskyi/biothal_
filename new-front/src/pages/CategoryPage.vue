<template>
    <div>
        <ProductCardsSetDesktop v-if="!isMobile" :title="category" :product-data="productData"/>
        <ProductCardsSetMobile v-if="isMobile" :title="category"
                               :product-data="productData.slice(0, 4).concat(productData.slice(8, 12))"/>
    </div>
</template>

<script>
    import ProductCardsSetDesktop from "../components/desktop/ProductCardsSetDesktop";
    import ProductCardsSetMobile from "../components/mobile/ProductCardsSetMobile";

    export default {
        name: "CategoryPage",
        components: {
            ProductCardsSetDesktop,
            ProductCardsSetMobile
        },
        data() {
            return {
                productData: [
                    {
                        id: 1,
                        img: '../../../public/product-images/product-images.svg',
                        isShowStock: true
                    },
                    {
                        id: 2,
                        img: '../public/product-images/product-images.svg',
                        isShowStock: true
                    },
                    {
                        id: 3,
                        img: '../../public/product-images/product-images.svg',
                        isShowStock: true
                    },
                    {
                        id: 4,
                        img: '../../../public/product-images/product-images.svg',
                        isShowStock: true
                    },
                    {
                        id: 5,
                        img: '../public/product-images/product-images.svg',
                        isShowStock: true
                    },
                    {
                        id: 6,
                        img: '../../public/product-images/product-images.svg',
                        isShowStock: true
                    },
                    {
                        id: 7,
                        img: '../../public/product-images/product-images.svg',
                        isShowStock: false
                    },
                    {
                        id: 8,
                        img: '../../public/product-images/product-images.svg',
                        isShowStock: false
                    },
                    {
                        id: 9,
                        img: '../../public/product-images/product-images.svg',
                        isShowStock: false
                    },
                    {
                        id: 10,
                        img: '../../public/product-images/product-images.svg',
                        isShowStock: false
                    },
                    {
                        id: 11,
                        img: '../../public/product-images/product-images.svg',
                        isShowStock: false
                    },
                    {
                        id: 12,
                        img: '../../public/product-images/product-images.svg',
                        isShowStock: false
                    }
                ]
            }
        },
        computed: {
            category() {
                const category = this.$route.params.subCategory ? this.$route.params.subCategory : this.$route.params.category
                switch (category) {
                    case "for-face":
                        return "Для лица";
                    case "for-body":
                        return "Для тела";
                    case "effective-sets":
                        return "Эффективные наборы";
                    default:
                        return category;
                }
            }
        },
        created() {

        },
        methods: {

        }
    }
</script>

<style scoped>

</style>
