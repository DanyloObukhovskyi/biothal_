<template>
    <div>
        <div>
            <agile autoplay :autoplaySpeed="5000" :navButtons="false" :speed="1000" :key="carousel.length">
                <div class="slide" v-for="(item, index) in carousel" :key="index">
                    <img width="100%" :src="api + '/storage/img/carousel/' + item['name']"/>
                </div>
            </agile>
        </div>
        <ProductCardsSetDesktop v-if="!isMobile" :title="categoryDetails.title" :message="categoryMessage" :product-data="productData"/>
        <ProductCardsSetMobile v-if="isMobile" :title="categoryDetails.title" :message="categoryMessage"
                               :product-data="productData.slice(0, 4).concat(productData.slice(8, 12))"/>
        <div class="main-title seo-text-title">{{categoryDetails.seo_title}}</div>
        <div class="seo-text-description" v-html="categoryDetails.seo_description"></div>
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
                categoryMessage: ''
            }
        },
        computed: {
            route() {
                return this.$route.params;
            }
        },
        created() {
            this.fetchCategory();
        },
        watch: {
            route: {
                deep: true,
                handler (newRoute, oldRoute) {
                    this.fetchCategory();
                },
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
