<template>
    <div class="ordering__wrapper">
        <div class="ordering__content">
            <div class="ordering__top">
                <div class="ordering__top__title">Оформление заказа</div>
                <template v-if="globalSales.length > 0 && nextGlobalSales !== null">
                    <div style="margin-bottom: 17px; font-size: 12px">
                        Еще {{ nextGlobalSales.sum_modal - productsSum }} грн и сработает скидка
                        {{ nextGlobalSales.procent_modal }}%
                    </div>
                    <v-progress-linear :value="linear"
                                       color="#2F7484"
                                       background-color="#ddd"
                                       class="main-linear"
                                       height="12"/>
                </template>
            </div>
            <div class="ordering__middle">
                <div class="ordering__middle__left">
                    <div>
                        <v-form autocomplete="off" ref="orderForm" style="width: 100%;" v-model="validProfile">
                            <div>
                                <p class="main-input-label">Введите номер телефона *</p>
                                <v-text-field
                                    v-model="number"
                                    :error-messages="errorValid.number"
                                    :rules="numberRules"
                                    placeholder="+38(___) ___-__-__"
                                    v-mask="'+38(###) ###-##-##'"
                                    class="main-input-field"
                                    background-color="#F7F7F7"
                                    flat
                                    rounded
                                    color="#2F7484"
                                    height="44"/>
                            </div>
                            <div class="mt-18px">
                                <p class="main-input-label">Введите имя *</p>
                                <v-text-field
                                    v-model="name"
                                    :error-messages="errorValid.name"
                                    :rules="nameRules"
                                    class="main-input-field"
                                    background-color="#F7F7F7"
                                    flat
                                    rounded
                                    color="#2F7484"
                                    height="44"/>
                            </div>
                            <div class="mt-18px">
                                <p class="main-input-label">Введите фамилию *</p>
                                <v-text-field
                                    v-model="surname"
                                    :error-messages="errorValid.surname"
                                    :rules="surnameRules"
                                    class="main-input-field"
                                    background-color="#F7F7F7"
                                    flat
                                    rounded
                                    color="#2F7484"
                                    height="44"/>
                            </div>
                            <div class="mt-18px">
                                <p class="main-input-label">Введите область *</p>
                                <v-autocomplete
                                    :items="regions"
                                    color="#2F7484"
                                    :loading="regionsLoading"
                                    v-model="region"
                                    :error-messages="errorValid.region"
                                    :rules="regionRules"
                                    class="main-input-field"
                                    height="44"
                                    name="name"
                                    flat
                                    rounded
                                    background-color="#F7F7F7">
                                </v-autocomplete>
                            </div>
                            <div class="mt-18px">
                                <p class="main-input-label">Введите город *</p>
                                <v-autocomplete
                                    :items="cities"
                                    :loading="citiesLoading"
                                    v-model="city"
                                    :error-messages="errorValid.city"
                                    :rules="cityRules"
                                    color="#2F7484"
                                    :item-text="(c) => c.name"
                                    class="main-input-field"
                                    height="44"
                                    flat
                                    rounded
                                    background-color="#F7F7F7">
                                </v-autocomplete>
                            </div>
                            <div class="mt-18px">
                                <p class="main-input-label">Выберите отделение Новой Почты *</p>
                                <v-autocomplete
                                    :items="postalOffices"
                                    :loading="postalOfficesLoading"
                                    v-model="postalOffice"
                                    :error-messages="errorValid.postalOffice"
                                    :rules="postalOfficeRules"
                                    color="#2F7484"
                                    :item-text="(c) => c.name"
                                    name="name"
                                    class="main-input-field"
                                    height="44"
                                    flat
                                    rounded
                                    background-color="#F7F7F7">
                                </v-autocomplete>
                            </div>
                            <div class="mt-18px">
                                <p class="main-input-label">Выберите способ оплаты *</p>
                                <v-select
                                    :items="['Наложенный платеж']"
                                    v-model="paymentMethod"
                                    :rules="paymentMethodRules"
                                    :item-text="name"
                                    class="main-input-field"
                                    background-color="#F7F7F7"
                                    flat
                                    rounded
                                    color="#2F7484"
                                    height="44"
                                ></v-select>
                            </div>
                        </v-form>
                    </div>
                    <div class="ordering__middle__left__checkout">
                        <div class="checkout-button__wrapper" @click="checkout">
                            <v-btn dark class="checkout-button" elevation="0">Оформить заказ</v-btn>
                        </div>
<!--                        <div class="checkout-link" @click="$refs['PlaceOrderOneClick'].visible=true">-->
<!--                            Оформить в 1 клик-->
<!--                        </div>-->
                    </div>
                </div>
                <div class="ordering__middle__right">
                    <div class="ordering__middle__right__product-set">
                        <ProductCardsSet type-set="basket"
                                         @delete="deleteProduct"
                                         :product-data="products"
                                         :is-show-title="false"/>
                    </div>
                    <div class="total__wrapper">
                        <div class="total">
                            <div class="total__left">
                                Стоимость товаров:
                            </div>
                            <div class="total__right">
                                {{ productsSum }} грн.
                            </div>
                        </div>
                        <div class="total">
                            <div class="total__left">
                                Стоимость доставки:
                            </div>
                            <div class="total__right">
                                {{ deliveryPrice }} грн.
                            </div>
                        </div>
                        <div class="total" v-if="currentGlobalSales !== null">
                            <div class="total__left">
                                Скидка:
                            </div>
                            <div class="total__right">
                                {{ currentGlobalSales.procent_modal }}%.
                            </div>
                        </div>
                        <div class="total">
                            <div class="total__left" style="font-weight: 700">
                                Итого к оплате:
                            </div>
                            <div class="total__right" style="font-weight: 700">
                                {{ productsSumWithSales + deliveryPrice }} грн.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <ProductCardsSet title="Рекомендуемые товары" :product-data="recommendedProducts"/>
        </div>

        <PlaceOrderOneClick ref="PlaceOrderOneClick"/>
    </div>
</template>

<script>
import ProductCardBasket from "../../components/desktop/productCards/ProductCardBasket";
import PlaceOrderOneClick from "../../components/PlaceOrderOneClickModal";
import ProductCardsSet from "../../components/desktop/ProductCardsSetDesktop";
import {mapActions, mapGetters} from "vuex";

export default {
    name: "OrderingDesktop",
    components: {
        ProductCardBasket,
        PlaceOrderOneClick,
        ProductCardsSet
    },
    data() {
        return {
            deliveryPrice: 40,
            number: '',
            name: '',
            surname: '',
            region: '',
            city: '',
            user_id: '',
            postalOffice: '',
            paymentMethod: { id: '', name: '' },
            recommendedProducts: [],
            regions: [],
            regionsLoading: false,
            cities: [],
            citiesLoading: false,
            postalOffices: [],
            postalOfficesLoading: false,
            paymentMethods: [
                {
                    id: 1,
                    name: 'Наложенный платеж'
                },
                {
                    id: 2,
                    name: 'Оплата картой'
                }
            ],
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
            profile:{
                number: '',
                name: '',
                surname: '',
                user_id: ''
            }
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
                v => !!v || 'Вы не выбрали метод доставки',
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
        },
        products: function (newProducts, old) {
            if(newProducts.length === 0){
                this.toPage({name: 'home'})
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
        clearValidation() {
            this.errorValid = {
                name: '',
                surname: '',
                email: '',
                number: '',
                region: '',
                city: '',
                postalOffice: ''
            }
        },
        async checkout() {
            this.$loading(true)

            try {
                this.$loading(true)
                this.clearValidation()
                let validate = await this.$refs['orderForm'].validate();
                console.log(validate)
                if (validate) {
                    const form = {
                        number: this.number,
                        name: this.name,
                        surname: this.surname,
                        city: this.city.name,
                        region: this.region,
                        postalOffice: this.postalOffice,
                        paymentMethods: this.paymentMethods,
                        products: this.products
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
        this.getRecommendedProduct();
        this.getRegionsAndCities();
        this.getPaymentMethods();
        this.getProfile()
    }
}
</script>

<style scoped lang="scss">

.ordering {

    &__wrapper {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        overflow: scroll;
    }

    &__content {
        width: 70%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    &__top {
        display: flex;
        flex-direction: column;
        text-align: center;

        &__title {
            font-size: 18px;
            margin: 20px;
        }
    }

    &__middle {
        display: flex;
        flex-direction: row;
        margin-top: 30px;
        flex-wrap: wrap;

        &__left {
            display: flex;
            flex-direction: column;
            width: 50%;

            &__checkout {
                display: flex;
                flex-direction: row;
                justify-content: space-between;

                @media screen and (max-width: 991px) {
                    flex-direction: column;
                    justify-content: center;
                }
            }
        }

        &__right {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 50%;

            &__product-set {
                height: 610px;
                overflow: auto;
                padding: 7px;
            }
        }
    }
}

.main-input-label {
    padding: 0 0 0 20px;
    margin: 0;
    font-weight: 200;
    font-size: 12px;
    line-height: 16px;
}

.main-input-field {
    margin: 0;
    padding: 5px;
}

.checkout-button {
    border-radius: 50px;
    width: 190px;
    height: 44px !important;
    font-size: 12px;
    line-height: 17px;

    &__wrapper {
        display: flex;

        @media screen and (max-width: 991px) {
            justify-content: center;
        }
    }
}

.checkout-link {
    display: flex;
    font-weight: 200;
    font-size: 12px;
    line-height: 16px;
    text-decoration-line: underline;
    margin: auto 0;

    &:hover {
        cursor: pointer;
    }

    @media screen and (max-width: 991px) {
        justify-content: center;
        margin-top: 10px;
    }
}

.total {
    display: flex;
    flex-direction: row;
    font-weight: 200;
    font-size: 11px;
    line-height: 15px;

    &__wrapper {
        padding: 20px 0 0 70px;
    }

    &__left {
        width: 50%;
    }

    &__right {
        width: 50%;
        text-align: right;
    }
}

.main-linear {
    border-radius: 60px;
}

.mt-18px {
    margin-top: 18px;
}
</style>
