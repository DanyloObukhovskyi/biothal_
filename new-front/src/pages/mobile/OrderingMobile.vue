<template>
    <div class="page-form__wrapper">
        <div class="page-form__top">
            <div class="page-form__top__title">Оформление заказа</div>
        </div>
        <div class="page-form__middle">
            <v-form style="width: 100%;">
                <div>
                    <p class="main-input-label">Введите номер телефона</p>
                    <v-text-field
                        placeholder="+38(___) ___-__-__"
                        v-mask="'+38(###) ###-##-##'"
                        class="main-input-field"
                        flat
                        v-model="number"
                        rounded/>
                </div>
                <div>
                    <p class="main-input-label">Введите имя</p>
                    <v-text-field
                        class="main-input-field"
                        flat
                        v-model="name"
                        rounded/>
                </div>
                <div>
                    <p class="main-input-label">Введите фамилию</p>
                    <v-text-field
                        class="main-input-field"
                        flat
                        v-model="surname"
                        rounded/>
                </div>
                <div>
                    <p class="main-input-label">Введите область</p>
                    <v-autocomplete
                        :items="regions"
                        color="#2F7484"
                        :loading="regionsLoading"
                        v-model="region"
                        class="main-input-field"
                        height="44"
                        name="name"
                        flat
                        rounded>
                    </v-autocomplete>
                </div>
                <div>
                    <p class="main-input-label">Введите город</p>
                    <v-autocomplete
                        :items="cities"
                        :loading="citiesLoading"
                        v-model="city"
                        color="#2F7484"
                        :item-text="(c) => c.name"
                        class="main-input-field"
                        height="44"
                        flat
                        rounded>
                    </v-autocomplete>
                </div>
                <div>
                    <p class="main-input-label">Выберите отделение Новой Почты</p>
                    <v-autocomplete
                        :items="postalOffices"
                        :loading="postalOfficesLoading"
                        v-model="postalOffice"
                        color="#2F7484"
                        :item-text="(c) => c.name"
                        name="name"
                        class="main-input-field"
                        height="44"
                        flat
                        rounded>
                    </v-autocomplete>
                </div>
            </v-form>
        </div>
        <div class="terms-use">
            <div>
                <v-checkbox
                    v-model="termsUse"/>
            </div>
            <div class="terms-use__right">
                <div>
                    Я прочитал и согласен с правилами
                </div>
                <div style="font-weight: 700">
                    Пользовательское соглашение
                </div>
            </div>
        </div>
        <div class="page-form__bottom">
            <v-btn dark class="checkout-button" elevation="0" @click="checkout">Оформить заказ</v-btn>
        </div>
    </div>
</template>

<script>

import {mapActions, mapGetters} from "vuex";

    export default {
        name: "OrderingMobile",
        components: {},
        data() {
            return {
                termsUse: false,
                deliveryPrice: 40,
                number: null,
                name: null,
                surname: null,
                region: '',
                city: '',
                postalOffice: '',
                paymentMethod: null,
                recommendedProducts: [],
                regions: [],
                regionsLoading: false,
                cities: [],
                citiesLoading: false,
                postalOffices: [],
                postalOfficesLoading: false,
                paymentMethods: []
            }
        },
        computed: {
            ...mapGetters('basket', [
                'products',
                'globalSales',
                'currentGlobalSales',
                'nextGlobalSales',
                'linear',
                'productsSum',
                'productsSumWithSales'
            ])
        },
        watch: {
            region() {
                if (this.region !== null && this.region !== '') {
                    this.getCities()
                    this.postalOffices = [];
                    this.city = '';
                }
            },
            city() {
                if (this.region !== null && this.region !== '') {
                    this.getPostalOffices()
                }
            }
        },
        methods: {
            ...mapActions('basket', {
                deleteProduct: 'DELETE_PRODUCT'
            }),
            getRecommendedProduct() {
                this.axios.post('products/recommended')
                    .then(({data}) => {
                        this.recommendedProducts = data
                    })
            },
            getRegionsAndCities() {
                this.regionsLoading = true;

                this.axios.post('checkout/regions')
                    .then(({data}) => {
                        this.regions = data;
                        this.regionsLoading = false;
                    })
            },
            getCities() {
                this.citiesLoading = true;

                const data = {
                    region: this.region,
                }
                this.axios.post('checkout/cities', data)
                    .then(({data}) => {
                        this.cities = data;
                        this.citiesLoading = false;
                    })
            },
            getPostalOffices() {
                this.postalOfficesLoading = true;

                const city = this.cities.find(c => c.name === this.city)

                this.axios.post('checkout/postal/offices', {city})
                    .then(({data}) => {
                        this.postalOffices = data;
                        this.postalOfficesLoading = false;
                    })
            },
            getPaymentMethods() {
                this.axios.post('checkout/payment/methods')
                    .then(({data}) => {
                        this.paymentMethods = data;
                    })
            },
            checkout() {
                const data = {
                    number: this.number,
                    name: this.name,
                    surname: this.surname,
                    city: this.city.name,
                    region: this.region,
                    postalOffice: this.postalOffice,
                    products: this.products
                };

                this.axios.post('checkout/create/order', data)
            }
        },
        mounted() {
            this.getRecommendedProduct();
            this.getRegionsAndCities();
            this.getPaymentMethods();
        }
    }
</script>

<style scoped lang="scss">
    .page-form {
        &__wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: scroll;
            padding: 20px 20px 15px 20px;
        }

        &__top {
            display: flex;
            flex-direction: column;
            text-align: center;

            &__title {
                font-size: 14px;
                line-height: 19px;
                font-weight: 400;
            }
        }

        &__middle {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        &__bottom {
            width: 100%;
            display: flex;
            justify-content: center;
        }
    }

    .terms-use {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        font-size: 14px;
        margin-top: 15px;

        &__right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
    }
</style>
