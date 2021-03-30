<template>
    <div>
        <agile autoplay :autoplaySpeed="5000" :navButtons="false" :speed="1000" :key="carousel.length">
            <div class="slide" v-for="(item, index) in carousel" :key="index">
                <img width="100%" :src="api + '/storage/img/carousel/' + item['name']"/>
            </div>
        </agile>
        <ProductsPaginate ref="productsPaginate" :title="categoryDetails.title" :is-empty-message="categoryMessage" :url="productsUrl"/>
        <div class="main-title seo-text-title">{{categoryDetails.seo_title}}</div>
        <div class="seo-text-description" v-html="categoryDetails.seo_description"></div>
    </div>
</template>

<script>
    import ProductCardsSetDesktop from "../components/desktop/ProductCardsSetDesktop";
    import ProductCardsSetMobile from "../components/mobile/ProductCardsSetMobile";
    import ProductsPaginate from "@/components/ProductsPaginate";

    export default {
        name: "CategoryPage",
        components: {
            ProductsPaginate,
            ProductCardsSetDesktop,
            ProductCardsSetMobile
        },
        metaInfo() {
            return {
                title: this.categoryDetails.seo_title,
                meta: [
                    { vmid: 'description', name: 'description', content: this.categoryDetails.seo_description },
                    { vmid: 'slug', name: 'slug', content: this.categoryDetails.slug }
                ]
            }
        },
        prop: {
            category: {
                type: [Number, String],
                default: 0
            },
            subCategory: {
                type: [Number, String],
                default: 0
            },
        },
        data() {
            return {
                carousel: [],
                productData: [],
                categoryDetails: [],
                categoryMessage: 'В данной категории нет товаров.',
                seoText: 'SEO-ТЕКСТ ДЛЯ КАТЕГОРИИ',
                productsUrl: null,
            }
        },
        computed: {
            route() {
                return this.$route.params;
            }
        },
        created() {
            this.productsUrl = (!this.$route.params.subCategory) ? 'category/products/' + this.$route.params.category : 'category/products/' + this.$route.params.category + '/' +  this.$route.params.subCategory;

            this.fetchCategory();
        },
        watch: {
            route: {
                deep: true,
                handler (newRoute, oldRoute) {
                    this.fetchCategory();

                    this.productsUrl = (!newRoute.subCategory) ? 'category/products/' + newRoute.category : 'category/products/' + newRoute.category + '/' +  newRoute.subCategory;
                },
            },
            productsUrl(val) {
                setTimeout(() => {
                    this.$refs.productsPaginate.getProducts();
                }, 1)
            }
        },
        methods: {
            async fetchCategory() {
                let url = (!this.$route.params.subCategory) ? 'category/' + this.$route.params.category : 'category/' + this.$route.params.category + '/' +  this.$route.params.subCategory;

                let data = await this.axios.get(url);

                this.carousel = data.data.carousel;
                this.productData = data.data.products.data;
                this.categoryMessage = this.productData.length ? '' :  'В данной категории нет товаров.';
                this.categoryDetails =  data.data.this_category;
            }
        }
    }
</script>

<style scoped lang="scss">

    .seo-text-description {
        padding: 20px;
        column-count: 2;
        column-gap: 30px;

        @media screen and (max-width: 600px) {
            column-count: 1;
        }
    }
</style>
