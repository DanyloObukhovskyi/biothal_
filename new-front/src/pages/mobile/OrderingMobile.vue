<template>
    <div class="ordering__wrapper">
        <div class="ordering__top">
            <div class="ordering__top__title">Оформление заказа</div>
        </div>
        <div class="ordering__middle">
            <v-form style="width: 100%;">
                <div>
                    <p class="main-input-label">Введите номер телефона</p>
                    <v-text-field
                        placeholder="+38(___) ___-__-__"
                        v-mask="'+38(###) ###-##-##'"
                        class="main-input-field"
                        flat
                        rounded/>
                </div>
                <div>
                    <p class="main-input-label">Введите имя</p>
                    <v-text-field
                        class="main-input-field"
                        flat
                        rounded/>
                </div>
                <div>
                    <p class="main-input-label">Введите фамилию</p>
                    <v-text-field
                        class="main-input-field"
                        flat
                        rounded/>
                </div>
                <div>
                    <p class="main-input-label">Введите область</p>
                    <v-text-field
                        class="main-input-field"
                        flat
                        rounded/>
                </div>
                <div>
                    <p class="main-input-label">Введите город</p>
                    <v-text-field
                        class="main-input-field"
                        flat
                        rounded/>
                </div>
                <div>
                    <p class="main-input-label">Выберите отделение Новой Почты</p>
                    <v-text-field
                        class="main-input-field"
                        flat
                        rounded/>
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
        <div class="ordering__bottom">
            <v-btn dark class="checkout-button" elevation="0">Оформить заказ</v-btn>
        </div>
    </div>
</template>

<script>

    export default {
        name: "OrderingMobile",
        components: {},
        data() {
            return {
                termsUse: false,
                linear: 70,
                productData: [
                    {
                        id: 1,
                        img: '../../../public/product-images/product-images.svg'
                    },
                    {
                        id: 2,
                        img: '../public/product-images/product-images.svg'
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

    .main-input-label {
        font-weight: 200;
        font-size: 12px;
        line-height: 16px;
        color: #7E7E7E;
        margin: 15px 0 0 0;
    }

    .main-input-field {
        width: 100%;
        height: 54px;
        background: #fff;
        border-radius: 2px;
    }

    .checkout-button {
        border-radius: 50px;
        max-width: 335px;
        width: 100%;
        height: 54px !important;
        background-color: #2F7484 !important;
        text-transform: none !important;
        font-weight: 500;
        font-size: 16px;
        line-height: 22px;
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

<style lang="scss">
    .ordering__wrapper {
        background-color: #f7f7f7;

        & .v-input__slot {
            border-radius: 4px !important;
            margin: 0 0 20px 0 !important;
        }

        & .v-text-field__details {
            display: none;
        }
    }
</style>
