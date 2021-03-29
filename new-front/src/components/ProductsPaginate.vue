<template>
    <div v-if="products !== null">
        <div>
            <ProductCardsSetDesktop v-if="!isMobile" :title="title" :product-data="products.data" :isShowStock="isShowStock"/>
            <ProductCardsSetMobile v-if="isMobile" :title="title" :product-data="products.data"/>
        </div>
        <div class="text-center mb-5" v-if="productsPagesCount > 1">
            <v-pagination
                v-model="productsPage"
                :length="productsPagesCount"
                circle
                color="#2F7484"
            ></v-pagination>
        </div>
    </div>
</template>

<script>
import ProductCardsSetMobile from "@/components/mobile/ProductCardsSetMobile";
import ProductCardsSetDesktop from "@/components/desktop/ProductCardsSetDesktop";

export default {
    name: "ProductsPaginate",
    components: {ProductCardsSetDesktop, ProductCardsSetMobile},
    props: {
        url: String,
        title: String,
        isShowStock: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            products: null,
            productsPage: 1,
        }
    },
    watch: {
        productsPage() {
            this.getProducts(this.productsPage);
        }
    },
    computed: {
        productsPagesCount() {
            let count = 0;

            if (this.products !== null) {
                if (this.products.total <= this.products.per_page) {
                    count = 1
                } else {
                    count = Math.ceil(this.products.total / this.products.per_page);
                }
            }
            return count;
        }
    },
    methods: {
        async getProducts(page = 1) {
            this.$loading(true)
            let data = await this.axios.post(`${this.url}?page=${page}`);

            this.products = data.data;
            this.$loading(false)
        },
    },
    mounted() {
        this.getProducts();
    }
}
</script>

<style scoped>

</style>
