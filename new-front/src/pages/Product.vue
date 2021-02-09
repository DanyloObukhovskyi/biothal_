<template>
    <div class="base-page-wrapper product-wrapper">

        <path-breadcrumb labelCurrentRoute="Увлажняющая маска для лица Апельсин Бергамот"/>

        <div class="block-product">
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
                            <the-mask v-model="phone" type="tel" class="info-pay-control__buy__input"
                                      v-bind="maskOptions"
                                      :style="{color: validPhoneInput ? 'white' : 'black'}"/>
                        </div>
                        <span class="info-pay-control__text">Добавить в избранное</span>
                        <span class="info-pay-control__text">Купить в 1 клик</span>

                    </div>
                </div>
            </div>
            <div class="block-product__tabs">
                <v-tabs
                    color="#000"
                    centered
                    v-model="tab">
                    <v-tabs-slider color="#000"></v-tabs-slider>

                    <v-tab
                        :href="`#tab-${index+1}`"
                        v-for="(item, index) in items"
                        :key="item">
                        {{ item }}
                    </v-tab>
                </v-tabs>

                <v-tabs-items v-model="tab">
                    <v-tab-item
                        v-for="i in 4"
                        :key="i"
                        :value="'tab-' + i">
                        <v-card flat>
                            Увлажняющая маска моментально насыщает кожу необходимой влагой, тонизирует и укрепляет кожу.
                            Формула на основе масел, коллагена и гиалуроновой кислоты эффективно борется с морщинками,
                            повышает упругость и эластичность кожи. Регулярное использование маски заметно подтягивает
                            овал лица, помогает предотвратить преждевременное старение кожи. Кожа приобретает гладкость,
                            бархатистость и здоровое сияние.

                            ПРЕИМУЩЕСТВА

                            • Моментальный эффект увлажнения;
                            • Эффективна против первых признаков старения;
                            • Заметный эффект уже после первого применения.

                            Гиалуроновая кислота удерживает в коже влагу, помогая повысить ее плотность и разгладить
                            морщинки. В состав входит 2 вида гиалуроновой кислоты:

                            • Гиалуроновая кислота средней молекулярной массы работает на поверхности кожи, увлажняя
                            верхний эпидермальный слой.
                            • Низкомолекулярная гиалуроновая кислота воздействует на глубокие слои, восполняя недостаток
                            влаги изнутри.

                            Масло крамбе содержит редкие жирные кислоты, которые обуславливают его отличные смягчающие и
                            питающие свойства. Оказывает разглаживающий эффект, убирает мелкие морщинки, делает кожу
                            более гладкой и бархатистой.

                            Масло кивано нейтрализует действие свободных радикалов, предотвращает преждевременное
                            старение кожи.

                            Масло брокколи – эффективно борется с акне, интенсивно смягчает кожу, защищает ее от
                            негативного воздействия ультрафиолета.

                            Масло авокадо устраняет шелушения, воспаления, замедляет процессы старения. Благодаря
                            большому количеству витамина А, содержащемуся в авокадо, кожа дольше сохраняет молодость и
                            сияние.

                            Комплекс Альго + насыщает кожу влагой и микроэлементами, оказывает подтягивающее и
                            укрепляющее действие, повышает упругость и эластичность кожи.
                        </v-card>
                    </v-tab-item>
                </v-tabs-items>
            </div>
        </div>

        <div>
            <ProductCardsSet type-set="product" title="C ЭТИМ ТОВАРОМ ПОКУПАЮТ"/>
        </div>

    </div>
</template>

<script>
    import variables from '@/styles/main.scss'
    import {TheMask} from 'vue-the-mask';
    import PathBreadcrumb from "@/components/PathBreadcrumb";
    import ProductCardsSet from "../components/ProductCardsSet";

    export default {
        name: "Product",
        components: {PathBreadcrumb, TheMask, ProductCardsSet},
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
                tab: null,
                items: [
                    'Описание', 'Состав', 'Применение', 'Отзывы'
                ],
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
</style>
