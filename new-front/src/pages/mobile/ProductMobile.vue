<template>
    <div class="product-mobile__wrapper">
        <path-breadcrumb style="text-align: left; justify-content: left" labelCurrentRoute="Увлажняющая маска для лица Апельсин Бергамот"/>
        <div class="product-info__wrapper">
            <div class="product-info__discount" v-if="is_discount">-50%</div>
            <div class="product-info__image">
                <img :src="image" :alt="productData['image']['name']" :class="subImages" @click="getSubImages()"/>
            </div>
            <div class="product-info__other">
                <div class="product-info__other__icons">
                    <ThreeDotsSlides/>
                    <v-icon size="10" color="#000">mdi-gift-outline</v-icon>
                    <v-icon size="10" color="#000" v-if="isShowFavorite">mdi-heart-outline</v-icon>
                </div>
            </div>

            <div class="product-info__title">
                <span>{{ description['name'] || '' }}</span>
                <span>{{ productData['product_description']['short_description'] }}</span>
            </div>

            <div class="product-info__price">
                <span class="product-info__price__price">{{ productData['price'] }} грн</span>
<!--                <span class="product-info__price__discount">Старая цена: 545 грн.</span>-->
            </div>

            <div class="product-info__pay">
                <v-btn class="product-info__pay__button" height="54" dark color="#2F7484" elevation="0">
                    Добавить в корзину
                </v-btn>
            </div>

            <div class="product-info__tabs">
                <v-tabs
                    style="justify-content: left"
                    hide-slider
                    color="#000"
                    background-color="#f7f7f7"
                    v-model="tab">
                    <v-tab
                        active-class="product-info__tabs__active"
                        class="product-info__tabs__default"
                        :href="`#tab-${idx}`"
                        v-for="(item, idx) in items"
                        :key="idx">
                        {{ item['tab_title'] }}
                    </v-tab>
                </v-tabs>
                <v-tabs-items v-model="tab">
                    <v-tab-item
                        v-for="(item, idx) in items"
                        :key="idx"
                        :value="'tab-' + idx">
                        <v-card flat class="tab-text">
                            {{ item['tab_desc'] }}
                        </v-card>
                    </v-tab-item>
                </v-tabs-items>
            </div>
        </div>
        <div>
            <ProductCardsSetMobile type-set="product" title="Рекомендуемые товары"/>
        </div>
        <v-system-bar color="#000" class="product-mobile__system-bar" dark height="34">
            <div>Бесплатная доставка от <span style="font-weight: 700">1500 грн</span></div>
            <div><img width="18" height="18" src="../../../public/package.svg"/></div>
        </v-system-bar>

        <vue-gallery-slideshow :images="images" :index="index" @close="index = null"></vue-gallery-slideshow>

    </div>
</template>

<script>
    import variables from '@/styles/main.scss'
    import {TheMask} from 'vue-the-mask';
    import PathBreadcrumb from "@/components/PathBreadcrumb";
    import ProductCardsSet from "../../components/desktop/ProductCardsSetDesktop";
    import ThreeDotsSlides from "../../components/ThreeDotsSlides";
    import ProductCardsSetMobile from "../../components/mobile/ProductCardsSetMobile";
    import VueGallerySlideshow from 'vue-gallery-slideshow';

    export default {
        name: "Product",
        components: {
            PathBreadcrumb,
            TheMask,
            ProductCardsSet,
            ThreeDotsSlides,
            ProductCardsSetMobile,
            VueGallerySlideshow
        },
        props: {
            id: {
                type: [Number, String],
                default: 1
            },
        },
        computed: {
            maskOptions() {
                return {
                    mask: '+38(###) ###-##-##',
                    masked: false,
                    placeholder: "+38(___) ___-__-__"
                }
            },
            validPhoneInput() {
                return this.phone.length === 10
            }
        },
        created() {
            this.fetchProductDetails();
        },
        data() {
            return {
                tab: null,
                items: [],
                variables,
                count_good: 1,
                is_discount: true,
                phone: '',
                productData: {
                    image: {},
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
            }
        },
        methods: {
            incrementCountGood() {
                ++this.count_good;
            },
            decrementCountGood() {
                if (this.count_good > 1) {
                    --this.count_good;
                }
            },
            async fetchProductDetails() {
                console.log(this.id)
                let data = await this.axios.get('product/' + this.id);
                this.productData = data.data.productDetails;
                this.description = this.productData['product_description']
                this.items = this.productData['product_apts'];
                this.productImages = this.productData.product_images;
                this.recommendedProduct = data.data.recommendedProduct;
                this.image = this.api + '/storage/img/products/' + this.productData['image']['name']
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

    .product-mobile {
        &__wrapper {
            background-color: #f7f7f7;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }
    }

    .product-info {

        &__wrapper {
            width: 90%;
        }

        &__discount {
            margin: 20px;
            position: absolute;
            background-color: black;
            color: white;
            width: 48px;
            height: 48px;
            text-align: center;
            font-weight: 300;
            border-radius: 50%;
            line-height: 50px;
        }

        &__image {
            width: 100%;
            display: flex;
            justify-content: center;
            background-color: #fff;
        }

        &__other {
            display: flex;
            justify-content: space-between;

            &__icons {
                display: flex;
                column-gap: 10px;
                align-items: center;
            }
        }

        &__title {
            margin: 10px 0;
            font-weight: 500;
            font-size: 15px;
            line-height: 20px;
            text-align: center;
        }

        &__price {

            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 0 40px;

            &__price {
                font-weight: 800;
                font-size: 21px;
                line-height: 29px;
                color: #2F7484;
            }

            &__discount {
                font-weight: 200;
                font-size: 16px;
                line-height: 22px;
                text-decoration-line: line-through;
            }
        }

        &__pay {
            display: flex;
            justify-content: center;
            padding: 15px;

            &__button {
                border-radius: 60px;
                text-transform: none;
                width: 100%;
                max-width: 335px;
            }
        }

        &__tabs {
            text-transform: none;

            &__active {
                background-color: #fff !important;

                &:before {
                    opacity: 0 !important;
                }

                &:hover:before {
                    opacity: 0 !important;
                }

                &:focus:before {
                    opacity: 0 !important;
                }
            }

            &__default {
                text-transform: none;
                background-color: #f7f7f7;
                font-size: 12px;
                line-height: 16px;
                padding: 3px 5px;
                height: 17px;
            }
        }
    }

    .tab-text {
        font-size: 12px;
        line-height: 16px;
        padding: 10px;
    }

    .product-mobile {
        &__system-bar {
            width: 100%;
            justify-content: center;
            color: #fff;
            column-gap: 5px;
        }
    }

    input[type=number] {
        &::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        text-align: center;
    }
</style>

<style lang="scss">
    .product-info__wrapper {
        & .v-slide-group__prev {
            display: none !important;
        }

        & .v-tabs {
            height: 17px !important;
        }
    }
</style>
