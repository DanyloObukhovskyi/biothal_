<template>
    <div class="page-form__wrapper">
        <div class="page-form__top">
            <div class="page-form__top__title">Авторизация</div>
        </div>
        <div class="page-form__middle">
            <v-form style="width: 100%;">
                <div>
                    <p class="main-input-label">Введите номер телефона</p>
                    <v-text-field
                        placeholder="+38(___) ___-__-__"
                        v-mask="'+38(###) ###-##-##'"
                        class="main-input-field"
                        v-model="user.number"
                        flat
                        rounded/>
                </div>
                <div>
                    <p class="main-input-label">Введите пароль</p>
                    <v-text-field
                        class="main-input-field"
                        v-model="user.password"
                        flat
                        rounded/>
                </div>
            </v-form>
        </div>
        <div class="remember-me">
            <div>
                <v-checkbox
                    v-model="rememberMe"/>
            </div>
            <div class="remember-me__right">
                Запомнить меня
            </div>
        </div>
        <div class="page-form__bottom">
            <v-btn dark class="checkout-button" elevation="0" @click="login">Войти</v-btn>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AuthorizationMobile",
        data() {
            return {
                rememberMe: false,
                user: {
                    number: '',
                    password: ''
                }
            }
        },
        methods: {
            async login() {
                try {
                    await this.$store.dispatch('LOGIN', this.model);
                    this.toPage({name: 'home'})
                } catch (e) {
                    console.log(e)
                }
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

    .remember-me {
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
