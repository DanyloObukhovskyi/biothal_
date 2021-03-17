<template>
    <div class="page-form__wrapper">
        <div class="page-form__top">
            <div class="page-form__top__title">Мой профиль</div>
            <div class="user-image__wrapper">
                <div
                    class="user-image__no-image">
                    <v-icon size="35" class="user-image__no-image__icon">
                        person_add
                    </v-icon>
                </div>
                <div
                    class="user-image__text">
                    <div>
                        Загрузить фото
                    </div>
                    <div class="second-text">
                        <v-icon size="10">
                            close
                        </v-icon>
                        Удалить фото
                    </div>
                </div>
            </div>
        </div>
        <div class="page-form__middle">
            <v-form style="width: 100%;">
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
                    <p class="main-input-label">Введите дату</p>
                    <v-text-field
                        class="main-input-field"
                        flat
                        rounded/>
                </div>
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
                    <p class="main-input-label">Введите email</p>
                    <v-text-field
                        class="main-input-field"
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
                Не хочу получать писем с акциями
            </div>
        </div>
        <div class="page-form__top">
            <div class="page-form__top__title">Я хочу поменять пароль</div>
        </div>
        <div class="page-form__middle">
            <v-form style="width: 100%;">
                <div>
                    <p class="main-input-label">Введите старый пароль</p>
                    <v-text-field
                        class="main-input-field"
                        flat
                        rounded/>
                </div>
                <div>
                    <p class="main-input-label">Введите новый пароль</p>
                    <v-text-field
                        class="main-input-field"
                        flat
                        rounded/>
                </div>
                <div>
                    <p class="main-input-label">Введите еще раз новый пароль</p>
                    <v-text-field
                        class="main-input-field"
                        flat
                        rounded/>
                </div>
            </v-form>
        </div>
        <div class="page-form__bottom">
            <v-btn dark class="checkout-button" elevation="0">
                Сохранить данные
            </v-btn>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AccountSettingsMobile",
        data() {
            return {
                rememberMe: false
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
                font-weight: 700;
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
            margin-top: 30px;
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

    .user-image {
        &__wrapper {
            display: flex;
            margin: 20px 20px 0 20px;
            column-gap: 10px;
        }

        &__no-image {
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            background-color: #fff;
            width: 80px;
            height: 80px;

            &__icon {
                color: #D2D2D2;
            }
        }

        &__text {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }
    }
</style>
