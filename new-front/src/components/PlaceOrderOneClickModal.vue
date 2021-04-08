<template>
    <v-dialog
        v-model="visible"
        width="420">

        <v-card class="order-dialog__wrapper">
            <div class="order-dialog__title">Оформить заказ в 1 клик</div>

            <div class="order-dialog__text">Наш менеджер свяжется с вами в течении 30 минут в рабочее время</div>

            <v-form class="order-dialog__form" ref="orderQuickForm">
                <div>
                    <p class="main-input-label">Введите имя</p>
                    <v-text-field
                        v-model="name"
                        :error-messages="errorValid.name"
                        :rules="nameRules"
                        class="main-input-field"
                        background-color="#F7F7F7"
                        flat
                        rounded
                        height="34"/>
                </div>
                <div>
                    <p class="main-input-label">Введите номер телефона</p>
                    <v-text-field
                        v-model="number"
                        :error-messages="errorValid.number"
                        :rules="numberRules"
                        class="main-input-field"
                        background-color="#F7F7F7"
                        flat
                        rounded
                        placeholder="+38(___) ___-__-__"
                        v-mask="'+38(###) ###-##-##'"
                        height="34"/>
                </div>
            </v-form>
            <v-btn dark class="checkout-button" elevation="0" @click="checkout">Оформить быстрый заказ</v-btn>
        </v-card>
    </v-dialog>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "PlaceOrderOneClick",
        props: {
            number: {
                type: [Number, String],
                default: ''
            },
            name: {
                type: [Number, String],
                default: ''
            },
            user_id: {
                type: [Number, String],
                default: ''
            }
        },
        data() {
            return {
                visible: false,
                errorValid: {
                    name: '',
                    number: ''
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
            nameRules() {
                return [
                    v => !!v || 'Вы не ввели свое имя',
                    v => v.length >= 2 || 'Имя должно содержать больше чем 2 символа',
                ]
            },
            numberRules() {
                return [
                    v => !!v || 'Вы не ввели свое телефоный номер',
                    v => v.length >= 12 || 'Телефон должен содержать больше чем 12 символа',
                ];
            }
        },
        methods: {
            ...mapActions('basket', {
                deleteProduct: 'DELETE_PRODUCT',
                clearCart: 'CLEAR_ALL_CART'
            }),
            clearCartProducts() {
                this.clearCart()
            },
            async checkout() {
                this.$loading(true);
                try {
                    this.clearValidation()
                    let validate = await this.$refs['orderQuickForm'].validate();

                    if (validate) {
                        const form = {
                            number: this.number,
                            name: this.name,
                            products: this.products,
                            user_id: this.user_id
                        };
                        let data = await this.axios.post('checkout/create/orderQuick', form)

                        if (data) {
                            let message = data.data.message

                            this.$notify({
                                type: 'success',
                                title: 'Успех!',
                                text: message
                            });
                            this.clearValidation();

                            this.toPage({name: 'order-status', params:{ id: data.data.order_id }});

                            this.clearCartProducts()
                        }
                    }
                    this.$loading(false);
                } catch (e) {
                    this.$loading(false);
                    this.errorMessagesValidation(e);
                }
            },
            clearValidation() {
                this.errorValid = {
                    name: '',
                    number: '',
                }
            },
        }
    }
</script>

<style scoped lang="scss">

    .main-input-label {
        padding: 0 0 0 15px;
        margin: 0;
        font-weight: 200;
        font-size: 12px;
        line-height: 16px;
    }

    .main-input-field {
        margin: 0;
        padding: 5px;
    }

    .order-dialog {
        &__wrapper {
            text-align: center;
        }

        &__form {
            text-align: left;
        }

        &__title {
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
            margin-bottom: 5px;
        }

        &__text {
            font-size: 13px;
            margin-bottom: 5px;
        }
    }

    .checkout-button {
        font-size: 11px;
        line-height: 15px;
        margin-top: 15px;
    }
</style>

<style lang="scss">
    .order-dialog__wrapper {
        padding: 15px;

        & .v-input__slot {
            border-radius: 4px !important;
            margin: 0 0 5px 0 !important;
        }

        & .v-text-field__details {
            display: block;
        }
    }
</style>
