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
        <div class="page-form__bottom">
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
