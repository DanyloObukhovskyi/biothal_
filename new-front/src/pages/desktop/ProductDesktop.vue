<template>
    <div class="base-page-wrapper product-wrapper">
    <div>
        <span class="breadcrumb" @click="toPage( {name:'home'} )">Главная</span>
        <span> / </span>
        <span class="breadcrumb" @click="toPage({name: 'category-page', params:{ category: category['main_category']['slug'] }} )">{{ category['main_category']['title'] }}</span>
        <span  v-if="category['main_category'].length !== 0"> / </span>
        <span v-if="category['sub_category'] !== null" class="breadcrumb" @click="toPage({name: 'sub-category-page', params:{ category: category['sub_category']['slug'], subCategory: category['sub_category']['slug'] }} )">{{ category['sub_category']['title'] }}</span>
        <span v-if="category['sub_category'] !== null"> / </span>
        <span style="color: rgba(29,70,84,0.69)">{{ description['name'] }}</span>
    </div>
        <div class="block-product">
            <div class="block-product-base-info">

                <div class="block-product-base-info__image">
                    <img :src="image" :alt="productData['image'] ? productData['image']['name'] : ''"
                         class="image__product" :class="subImages" @click="getSubImages()"/>
<!--                    <img :src="require('../../../public/product-images/' + productData['image']['name'] || '')" :alt="productData['image']['name'] || ''"-->
<!--                         class="image__product"/>-->
                    <div class="image__discount" v-if="is_discount">- {{ productData.get_sale.percent }}%</div>
                </div>

                <div class="block-product-base-info__info">
                    <div class="info-title">
                        <span class="info-title__title">{{ description['name'] || '' }}</span>
                        <span class="info-title__subtitle">{{ productData['upc'] || '' }}</span>
                    </div>

                    <div class="info-price" >
                        <span class="info-price__price">{{ is_discount ?  productData['price_with_sale']  : productData['price'] }} грн</span>
                        <span class="info-price__discount" v-if="is_discount">{{ productData['price'] }} грн</span>
<!--                        <p class="info-price__in-stock">В наличии</p>-->
                    </div>
                    <div class="info-description"  v-html="productDescription"></div>
                    <span class="info-title__subtitle">{{ productData['product_description']['short_description'] }}</span>

                    <div class="info-count">
                        <span class="info-count__title">Количество</span>
                        <div>
                            <v-icon
                                @click="incrementCountGood"
                                :style="{'background-color': variables.basecolor, color: '#ffffff'}"
                                class="info-count__input-control">
                                mdi-plus
                            </v-icon>
                            <input v-model="count_good" type="number" style="width: 42px"/>
                            <v-icon
                                @click="decrementCountGood"
                                :style="{'background-color': count_good <= minimum_quantity ? variables.disablecolor : variables.basecolor, color: count_good <= minimum_quantity ? '#000000' : '#ffffff'}"
                                class="info-count__input-control">
                                mdi-minus
                            </v-icon>
                        </div>
                    </div>

                    <div class="info-pay-control">
                        <div class="info-pay-control__buy">
                            <v-btn dark color="#2F7484" elevation="0" @click="addToCart">Купить</v-btn>
<!--                            <span class="info-pay-control__text">Добавить в избранное</span>-->
                        </div>
                        <div class="info-pay-control__buy-fast">
                            <v-text-field
                                class="info-pay-control__buy-fast__input"
                                v-model="phone"
                                flat
                                rounded
                                placeholder="+38(___) ___-__-__"
                                v-mask="'+38(###) ###-##-##'"/>
                            <span class="info-pay-control__text">Купить в 1 клик</span>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="items.length" class="block-product__tabs">
                <v-tabs
                    color="#000"
                    centered
                    v-model="tab">
                    <v-tabs-slider color="#000"></v-tabs-slider>

                    <v-tab
                        :href="`#tab-${idx}`"
                        v-for="(item, idx) in this.items"
                        :key="idx"
                        v-html="item['tab_title']">
                    </v-tab>
                </v-tabs>

                <v-tabs-items style="margin-top: 30px" v-model="tab">
                    <v-tab-item
                        v-for="(item, idx) in this.items"
                        :key="idx"
                        :value="'tab-' + idx">
                        <v-card class="description-content" flat v-html="item['tab_desc']">
                        </v-card>
                    </v-tab-item>
                </v-tabs-items>
            </div>
        </div>

        <div>
            <ProductCardsSet type-set="product" :with-slider="true" title="C ЭТИМ ТОВАРОМ ПОКУПАЮТ" :product-data="recommendedProduct" />
        </div>

        <vue-gallery-slideshow :images="images" :index="index" @close="index = null"></vue-gallery-slideshow>
    </div>
</template>

<script>
    import variables from '@/styles/main.scss'
    import {TheMask} from 'vue-the-mask';
    import ProductCardsSet from "../../components/desktop/ProductCardsSetDesktop";
    import VueGallerySlideshow from 'vue-gallery-slideshow';
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "ProductDesktop",
        components: {
            TheMask,
            ProductCardsSet,
            VueGallerySlideshow
        },
        props: {
            id: {
                type: [Number, String],
                default: 1
            },
        },
        computed: {
            validPhoneInput() {
                return this.phone.length === 10
            },
            route() {
                return this.$route.params;
            }
        },
        watch: {
            route: {
                deep: true,
                handler (newRoute, oldRoute) {
                    this.fetchProductDetails();
                },
            }
        },
        created() {
            this.fetchProductDetails();
        },
        data() {
            return {
                tab: null,
                variables,
                count_good: 1,
                minimum_quantity: '',
                items: [],
                is_discount: false,
                phone: '',
                productData: {
                    image: {
                        name: ''
                    },
                    product_description:{}
                    },
                attr: [],
                description: [],
                productImages: [],
                recommendedProduct: [],
                images: [],
                image: '',
                index: null,
                subImages: null,
                category: {
                    main_category: {
                        title: ''
                    },
                    sub_category: {
                        title: ''
                    }
                },
                productDescription: ''
            }
        },
        methods: {
            ...mapActions('basket', {
               addProduct: 'ADD_PRODUCT'
            }),
            addToCart() {
                const product = this.productData;
                product.quantity = this.count_good;

                this.addProduct(product)
            },
            incrementCountGood() {
                ++this.count_good;
            },
            decrementCountGood() {
                if (this.count_good > this.minimum_quantity) {
                    --this.count_good;
                }
            },
            async fetchProductDetails() {
                this.is_discount = false
                let data = await this.axios.get('product/' + this.id);

                this.productData = data.data.productDetails;
                this.description = this.productData['product_description'];
                this.productDescription = data.data.description;
                this.items = this.productData['product_apts'];
                this.productImages = this.productData.product_images;
                this.recommendedProduct = data.data.recommendedProduct;
                this.image = this.productData['image'] ? this.api + '/storage/img/products/' + this.productData['image']['name'] : '';
                this.category = data.data.product_category;
                this.count_good = (data.data.productDetails.minimum !== 0) ? data.data.productDetails.minimum : 1;
                this.minimum_quantity = (data.data.productDetails.minimum !== 0) ? data.data.productDetails.minimum : 1;

                if (this.productImages) {
                    let url = [];
                    let api = this.api + '/storage/img/products/';
                    this.productImages.map(function(value, key) {
                        url.push(api + value['images']['name']);
                    });
                    this.images = url;
                }

                if(this.images[0]){
                    this.subImages = 'images'
                }

                if(this.productData.sale_id !== null){
                    this.is_discount = true;
                }
            },
            async getSubImages() {
                if(this.images[0]){
                    this.index = 0;
                }
            }
        },
    }
</script>

<style lang="scss" scoped>

    @import "src/styles/main";

    .product-wrapper {
        padding: 45px;
    }

    .block-product-base-info {
        width: 100%;
        display: flex;
        gap: 30px;

        &__image {
            width: 50%;
            height: 380px;
            position: relative;
            justify-content: center;
            display: inline-flex;
        }

        .image {
            &__product {
                max-width: 100%;
                height: 100%;
            }

            &__discount {
                position: absolute;
                top: 20px;
                left: 20px;
                background-color: black;
                color: white;
                width: 50px;
                height: 50px;
                text-align: center;
                font-weight: 300;
                border-radius: 50%;
                vertical-align: center;
                line-height: 50px;
            }
        }

        &__info {
            width: 50%;
            display: flex;
            flex-direction: column;
            row-gap: 9px;
        }
    }

    .info {

        &-title {
            display: flex;
            flex-direction: column;
            font-size: 18px;

            &__title {
                font-weight: 700;
            }

            &__subtitle {
            }

        }


        &-price {

            &__price {
                font-weight: 800;
                font-size: 24px;
                line-height: 32px;
            }

            &__discount {
                margin-left: 5px;
                font-size: 15px;
                text-decoration: line-through;
            }

            &__in-stock {
                font-size: 11px;
                color: $palette-base-color;
                margin-bottom: 0;
            }

        }

        &-description {
            font-size: 15px;
            line-height: 20px;
            color: black;
        }

        &-count {
            &__title {
                font-weight: 400;
                font-size: 13px;
                line-height: 18px;
            }

            &__input {
                padding: 0;
                width: calc(42px + (21px * 2));
                text-align: center;

                &-control {
                    padding: 4px;
                    margin: 0;
                    cursor: pointer;
                    font-size: 13px;
                    $input-slot-margin-bottom: 0;
                }
            }
        }

        &-pay-control {
            margin-top: 23px;
            display: flex;
            align-items: flex-start;
            column-gap: 15px;

            @media screen and (max-width: 767px) {
                flex-direction: column;
                row-gap: 15px;
            }

            &__buy {
                display: flex;
                flex-direction: column;
                justify-content: center;
                row-gap: 10px;
                @media screen and (max-width: 767px) {
                    width: 100%;
                    max-width: 243px;
                }

                button {
                    text-transform: none;
                    text-align: center;
                    font-size: 16px;
                    line-height: 22px;
                    font-weight: bold;
                    padding: 13px 62px;
                    background-color: $palette-base-color;
                    height: 48px !important;
                    border-radius: 50px;
                    @media screen and (max-width: 767px) {
                        width: 100%;
                    }
                }

                &__input {
                    background-color: transparent;
                    color: white;
                    width: 177px;
                    font-size: 16px;
                    line-height: 22px;
                    font-weight: 500;
                    text-align: center;

                    &::placeholder {
                        color: #C4C4C4;
                    }
                }

                &-fast {
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    row-gap: 10px;

                    &__input {
                        margin: 0 !important;
                        display: flex;
                        justify-content: center;
                        background-color: #EFEFEF;
                        height: 48px;
                        text-align: center;
                        font-size: 16px;
                        line-height: 22px;
                        font-weight: bold;
                        color: #C4C4C4;
                    }
                }
            }

            &__text {
                font-size: 12px;
                font-style: normal;
                line-height: 16px;
                text-align: center;
                cursor: pointer;
            }
        }
    }

    .block-product {
        display: flex;
        flex-direction: column;

        &__tabs {
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
        }
    }

    input[type=number] {
        &::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        text-align: center;
    }
    .images{
        &:hover {
            cursor: pointer;
            box-shadow: 0 2px 8px rgb(0 0 0 / 25%);
        }
    }

    .description-content {
        justify-content: center;
        display: flex;
    }

    .breadcrumb {
        cursor: pointer;
    }
</style>
