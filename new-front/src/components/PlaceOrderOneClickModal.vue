<template>
    <v-dialog
        v-model="visible"
        width="420">

        <v-card class="order-dialog__wrapper">
            <div class="order-dialog__title">Оформить заказ в 1 клик</div>

            <div class="order-dialog__text">Наш менеджер свяжется с вами в течении 30 минут в рабочее время</div>

            <v-form class="order-dialog__form">
                <div>
                    <p class="main-input-label">Введите имя</p>
                    <v-text-field
                        class="main-input-field"
                        background-color="#F7F7F7"
                        flat
                        rounded
                        height="34"/>
                </div>
                <div>
                    <p class="main-input-label">Введите номер телефона</p>
                    <v-text-field
                        class="main-input-field"
                        background-color="#F7F7F7"
                        flat
                        rounded
                        placeholder="+38(___) ___-__-__"
                        v-mask="'+38(###) ###-##-##'"
                        height="34"/>
                </div>
            </v-form>
            <v-btn dark class="checkout-button" elevation="0">Оформить быстрый заказ</v-btn>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        name: "PlaceOrderOneClick",
        data() {
            return {
                visible: false
            }
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
        border-radius: 50px;
        width: 225px;
        height: 34px !important;
        background-color: #2F7484 !important;
        text-transform: none !important;
        font-weight: 500;
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
            display: none;
        }
    }
</style>
