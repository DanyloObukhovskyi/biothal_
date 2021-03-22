<template>
    <div class="base-page-wrapper product-wrapper">

        <path-breadcrumb labelCurrentRoute="Увлажняющая маска для лица Апельсин Бергамот"/>

        <div class="block-product">
            <div class="block-product-base-info">

                <div class="block-product-base-info__image">
                    <img src="../../../public/product-images/product-image.svg" :alt="product_id.toString()"
                         class="image__product"/>
                    <div class="image__discount" v-if="is_discount">-50%</div>
                </div>

                <div class="block-product-base-info__info">
                    <div class="info-title">
                        <span class="info-title__title">Увлажняющая маска для лица Апельсин Бергамот</span>
                        <span class="info-title__subtitle">Orange Bergamot Hydra Mask</span>
                    </div>

                    <div class="info-rating">
                        <Rating :color="variables.basecolor"/>
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
                                :style="{'background-color': count_good <= 1 ? variables.disablecolor : variables.basecolor, color: count_good <= 1 ? '#000000' : '#ffffff'}"
                                class="info-count__input-control">
                                mdi-minus
                            </v-icon>
                        </div>
                    </div>

                    <div class="info-pay-control">
                        <div class="info-pay-control__buy">
                            <v-btn dark color="#2F7484" elevation="0">Купить</v-btn>
                            <span class="info-pay-control__text">Добавить в избранное</span>
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

                <v-tabs-items style="margin-top: 30px" v-model="tab">
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
    import ProductCardsSet from "../../components/desktop/ProductCardsSetDesktop";
    import Rating from "../../components/Rating";

    export default {
        name: "ProductDesktop",
        components: {PathBreadcrumb, TheMask, ProductCardsSet, Rating},
        props: {
            product_id: {
                type: Number,
                default: 1
            },
        },
        computed: {
            validPhoneInput() {
                return this.phone.length === 10
            }
        },
        mounted() {
            // this.fetchProductDetails();
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
            },
            async fetchProductDetails() {
                let data = await this.axios.get('product/'+this.product_id);

                console.log(this.product_id)

                this.productData = data.data.products.data;
                this.best_seller = data.data.best_seller.data;
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
                margin-left: 12px;
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
</style>
