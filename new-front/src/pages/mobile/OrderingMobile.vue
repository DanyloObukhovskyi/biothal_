<template>
    <div class="page-form__wrapper">
        <div class="page-form__top">
            <div class="page-form__top__title">Оформление заказа</div>
        </div>
        <div class="page-form__middle">
            <v-form ref="orderForm" style="width: 100%;" v-model="validProfile">
                <div>
                    <p class="main-input-label">Введите номер телефона</p>
                    <v-text-field
                        placeholder="+38 (___) ___-__-__"
                        v-mask="'+38 (###) ###-##-##'"
                        class="main-input-field"
                        :error-messages="errorValid.number"
                        :rules="numberRules"
                        flat
                        v-model="number"
                        rounded/>
                </div>
                <div class="mt-25px">
                    <p class="main-input-label">Введите имя</p>
                    <v-text-field
                        class="main-input-field"
                        flat
                        v-model="name"
                        :error-messages="errorValid.name"
                        :rules="nameRules"
                        rounded/>
                </div>
                <div class="mt-25px">
                    <p class="main-input-label">Введите фамилию</p>
                    <v-text-field
                        class="main-input-field"
                        flat
                        v-model="surname"
                        :error-messages="errorValid.surname"
                        :rules="surnameRules"
                        rounded/>
                </div>
                <div class="mt-25px">
                    <p class="main-input-label">Введите область</p>
                    <v-select
                        :items="regions"
                        color="#2F7484"
                        :loading="regionsLoading"
                        v-model="region"
                        :error-messages="errorValid.region"
                        :rules="regionRules"
                        class="main-input-field"
                        name="name"
                        flat
                        rounded>
                    </v-select>
                </div>
                <div class="mt-25px">
                    <p class="main-input-label">Введите город</p>
                    <v-select
                        :items="cities"
                        :loading="citiesLoading"
                        v-model="city"
                        color="#2F7484"
                        :item-text="(c) => c.name"
                        :error-messages="errorValid.city"
                        :rules="cityRules"
                        class="main-input-field"
                        flat
                        rounded>
                    </v-select>
                </div>
                <div class="mt-25px">
                    <p class="main-input-label">Выберите отделение Новой Почты</p>
                    <v-select
                        :items="postalOffices"
                        :loading="postalOfficesLoading"
                        v-model="postalOffice"
                        :error-messages="errorValid.postalOffice"
                        :rules="postalOfficeRules"
                        color="#2F7484"
                        :item-text="c => c.name"
                        :item-value="c => c"
                        name="name"
                        class="main-input-field"
                        flat
                        rounded>
                    </v-select>
                </div>
                <div class="mt-25px">
                    <p class="main-input-label">Выберите способ оплаты</p>
                    <v-select
                        :items="paymentMethods"
                        v-model="paymentMethod"
                        :rules="paymentMethodRules"
                        :item-text="(c) => c.title"
                        :item-value="(c) => c.id"
                        class="main-input-field"
                        flat
                        rounded
                        color="#2F7484"
                    ></v-select>
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
            <v-btn dark
                   class="checkout-button"
                   :style="{
                        opacity: !termsUse ? '.5' : '1'
                   }"
                   @click="checkout">
                Оформить заказ
            </v-btn>
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
                number: '',
                name: '',
                surname: '',
                region: '',
                city: '',
                user_id: '',
                postalOffice: '',
                paymentMethod: '',
                recommendedProducts: [],
                regions: [],
                regionsLoading: false,
                cities: [],
                citiesLoading: false,
                postalOffices: [],
                postalOfficesLoading: false,
                paymentMethods: [],
                validProfile: false,
                errorValid: {
                    name: '',
                    surname: '',
                    email: '',
                    number: '',
                    region: '',
                    city: '',
                    postalOffice: ''
                },
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
            ]),
            numberRules() {
                return [
                    v => !!v || 'Вы не ввели свое телефоный номер',
                    v => v.length >= 12 || 'Телефон должен содержать больше чем 12 символа',
                ];
            },
            nameRules() {
                return [
                    v => !!v || 'Вы не ввели свое имя',
                    v => v.length >= 2 || 'Имя должно содержать больше чем 2 символа',
                ]
            },
            surnameRules() {
                return [
                    v => !!v || 'Вы не ввели свою фамилию',
                    v => v.length >= 2 || 'фамилия должна содержать больше чем 2 символа',
                ]
            },
            regionRules() {
                return [
                    v => !!v || 'Вы не выбрали регион',
                ]
            },
            cityRules() {
                return [
                    v => !!v || 'Вы не выбрали город',
                ]
            },
            postalOfficeRules() {
                return [
                    v => !!v || 'Вы не выбрали город',
                ]
            },
            paymentMethodRules() {
                return [
                    v => !!v || 'Вы не выбрали способ оплаты',
                ]
            }
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
            clearValidation() {
                this.errorValid = {
                    name: '',
                    surname: '',
                    email: '',
                    number: '',
                    region: '',
                    city: '',
                    postalOffice: '',
                    paymentMethod: ''
                }
            },
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
            async checkout() {
                this.$loading(true)

                try {
                    this.$loading(true)
                    this.clearValidation()
                    let validate = await this.$refs['orderForm'].validate();

                    if (validate) {
                        const form = {
                            number: this.number,
                            name: this.name,
                            surname: this.surname,
                            city: this.city,
                            region: this.region,
                            postalOffice: this.postalOffice,
                            paymentMethod: this.paymentMethod,
                            products: this.products,
                            user_id: this.user_id
                        };

                        let data = await this.axios.post('checkout/create/order', form)

                        if (data) {
                            let message = data.data.message
                            this.$notify({
                                type: 'success',
                                title: 'Успех!',
                                text: message
                            });

                            this.clearValidation()

                            if (data.data.redirect) {
                                this.toPage({name: 'payment', params: {paymentUrl: data.data.redirect}});
                            } else {
                                this.toPage({name: 'order-status', params: {id: data.data.order_id}});
                            }
                        }
                    }
                    this.$loading(false)
                } catch (e) {
                    this.$loading(false)
                    this.errorMessagesValidation(e);
                }
            },
            async getProfile(){
                await this.checkUserIsValid()
                try {
                    const token = this.$store.getters.getToken;
                    if(token){
                        let data = await this.axios.post('profile', {

                        },  {
                            headers: {
                                'Authorization': `Bearer ${token}`
                            }
                        });
                        if(data){
                            let user = data.data.user
                            this.number = user.phone_number,
                            this.name = user.name,
                            this.surname = user.sur_name,
                            this.user_id = user.id
                        }
                    }
                } catch (e) {
                    this.errorMessagesValidation(e);
                }
            },
            async checkUserIsValid(){
                try {
                    const token = this.$store.getters.getToken;
                    if(token){
                        let data = await this.axios.post('checkUser', {

                        },  {
                            headers: {
                                'Authorization': `Bearer ${token}`
                            }
                        });
                        if(data){
                            let exist = data.data.exist
                            if(!exist){
                                await this.$store.dispatch('LOGIN', null);
                                return false;
                            }
                        } else {
                            await this.$store.dispatch('LOGIN', null);
                        }
                        return true;
                    } else {
                        return false;
                    }
                } catch (e) {
                    await this.$store.dispatch('LOGIN', null);
                    this.errorMessagesValidation(e);
                }
            }
        },
        mounted() {
            this.getProfile();
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
            padding: 20px 20px 40px 20px;
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
    .mt-25px {
        margin-top: 25px;
    }
</style>
