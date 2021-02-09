<template>
    <div class="base-page-wrapper product-wrapper">

        <path-breadcrumb labelCurrentRoute="Увлажняющая маска для лица Апельсин Бергамот"/>

        <div class="block-product-base-info">
            <div class="block-product-base-info__image">
                <img src="../../public/product-images/product-image.svg" :alt="product_id.toString()"
                     class="image__product"/>
                <div class="image__discount" v-if="is_discount">-50%</div>
            </div>

            <div class="block-product-base-info__info">
                <div class="info-title">
                    <span class="info-title__title">Увлажняющая маска для лица Апельсин Бергамот</span>
                    <span class="info-title__subtitle">Orange Bergamot Hydra Mask</span>
                </div>

                <div class="info-rating">
                    <v-rating
                        class="info-rating__rating"
                        :color="variables.basecolor"
                        :background-color="variables.basecolor"
                        hover
                        length="5"
                        padding=".1rem"
                        size="12.59"
                        :value="5">
                    </v-rating>
                    <span class="info-rating__comment">5 отзывов</span>
                </div>

                <div class="info-price">
                    <span class="info-price__price">633 грн</span>
                    <span class="info-price__discount">1265 грн</span>
                    <p class="info-price__in-stock">В наличии</p>
                </div>

                <div class="info-description">
                    Маска оказывает мгновенное увлажняющее действие, разглаживая кожу и повышая ее эластичность и
                    упругость.
                    Создает на коже защитную пленку, которая предохраняет от потери влаги и негативного воздействия
                    внешних
                    факторов.
                </div>

                <div class="info-count">
                    <span class="info-count__title">Количество</span>

                    <v-text-field hide-details single-line class="info-count__input" v-model.number="count_good">
                        <div @click="decrementCountGood" slot="prepend"
                             :style="{'background-color': count_good <= 1 ? variables.disablecolor : variables.basecolor, color: count_good <= 1 ? '#000000' : '#ffffff'}"
                             class="mdi mdi-minus info-count__input-control"/>
                        <div @click="incrementCountGood" slot="append-outer"
                             :style="{'background-color': variables.basecolor, color: '#ffffff'}"
                             class="mdi mdi-plus info-count__input-control"/>
                    </v-text-field>
                </div>

                <div class="info-pay-control">

                    <span class="info-pay-control__buy" style="cursor: pointer;">Купить</span>
                    <div class="info-pay-control__buy-fast" :disabled="!validPhoneInput">
                        <the-mask v-model="phone" type="tel" class="info-pay-control__buy__input" v-bind="maskOptions"
                                  :style="{color: validPhoneInput ? 'white' : 'black'}"/>
                    </div>
                    <span class="info-pay-control__text">Добавить в избранное</span>
                    <span class="info-pay-control__text">Купить в 1 клик</span>

                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import variables from '@/styles/main.scss'
    import {TheMask} from 'vue-the-mask';
    import PathBreadcrumb from "@/components/PathBreadcrumb";

    export default {
        name: "Product",
        components: {PathBreadcrumb, TheMask},
        props: {
            product_id: {
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
        data() {
            return {
                variables,
                count_good: 2,
                is_discount: true,
                phone: '',
                productData: [
                    {
                        id: 1,
                        img: 'public/product-images/product-images.svg'
                    },
                    {
                        id: 2,
                        img: '../../public/product-images/product-images.svg'
                    },
                    {
                        id: 3,
                        img: '../../public/product-images/product-images.svg'
                    },
                    {
                        id: 4,
                        img: '../../public/product-images/product-images.svg'
                    },
                    {
                        id: 5,
                        img: '../../public/product-images/product-images.svg'
                    },
                    {
                        id: 6,
                        img: '../../public/product-images/product-images.svg'
                    }
                ]
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
            }
        },
    }
</script>

<style lang="scss" scoped>

    @import "src/styles/main";

    .block-product-base-info {
        width: 100%;
        display: flex;
        gap: 30px;

        &__image {
            width: 50%;
            height: 380px;
            position: relative;
        }

        .image {
            &__product {
                width: 100%;
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

        &-rating {
            display: flex;
            align-items: center;

            &__rating {

                & > button:hover {

                    &::before {
                        text-shadow: 0 0 0 12px blue;
                    }
                }
            }

            &__comment {
                font-size: 12px;
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
            display: grid;
            grid-template-columns: max-content max-content;
            grid-gap: 2px 15px;

            &__buy {
                text-align: center;
                font-size: 16px;
                line-height: 22px;
                font-weight: bold;
                font-style: normal;
                padding: 13px 62px;
                background-color: $palette-base-color;
                max-width: 246px;
                border-radius: 50px;
                color: #FFFFFF;

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
                    text-align: center;
                    font-size: 16px;
                    line-height: 22px;
                    font-weight: bold;
                    font-style: normal;
                    padding: 13px 35px;
                    background-color: $palette-base-color;
                    max-width: 246px;
                    border-radius: 50px;
                    color: #FFFFFF;
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
</style>
