<template>
    <v-footer
        color="#fff"
        class="pa-0 footer__wrapper"
        :padless="false">
        <div class="footer__top">
            <div style="margin: 28px 0 27px 45px;">
                Узнавайте первыми о распродажах и новинках!
            </div>
            <div style="margin-right: 45px">
                <v-text-field dark color="#fff" label="Электронный адрес" style="width: 270px">
                    <v-btn icon slot="append">
                        <v-icon class="footer__top__email-icon">
                            mdi-arrow-right
                        </v-icon>
                    </v-btn>
                </v-text-field>
            </div>
        </div>
        <div class="footer__middle">

            <div class="footer__middle__block footer__middle__block__1">
                <div>
                    <img width="127" height="38" src="../../../public/logo.svg"/>
                </div>
                <div>
                    Каждый продукт Biothal представляет собой настоящий эликсир красоты и молодости, концентрат морской
                    силы, который работает в абсолютной синергии с кожей и соответствует самым высоким мировым
                    стандартам.
                </div>
            </div>
            <div class="footer__middle__block">
                <v-list dense>
                    <v-list-item-title style="font-size: 17px; font-weight: 700">Каталог</v-list-item-title>
                    <v-list-item class="list-item"
                                 @click="toPage({name: 'category-page', params: {category: 'for-face'}})">
                        <v-list-item-content>
                            - Для лица
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item class="list-item"
                                 @click="toPage({name: 'category-page', params: {category: 'for-body'}})">
                        <v-list-item-content>
                            - Для тела
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item class="list-item"
                                 @click="toPage({name: 'category-page', params: {category: 'effective-sets'}})">
                        <v-list-item-content>
                            - Эффективные наборы
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </div>
            <div class="footer__middle__block">
                <v-list dense>
                    <v-list-item-title style="font-size: 17px; font-weight: 700">О нас</v-list-item-title>
                    <v-list-item class="list-item"
                                 @click="toPage({name: 'info-page', params: {category: 'production'}})">
                        <v-list-item-content>
                            - Производство
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item class="list-item"
                                 @click="toPage({name: 'info-page', params: {category: 'philosophy'}})">
                        <v-list-item-content>
                            - Философия
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item class="list-item" @click="toPage({name: 'info-page', params: {category: 'sea'}})">
                        <v-list-item-content>
                            - Море
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item class="list-item" @click="toPage({name: 'info-page', params: {category: 'seaweed'}})">
                        <v-list-item-content>
                            - Водоросли
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </div>
            <div class="footer__middle__block">
                <v-list dense>
                    <v-list-item-title style="font-size: 17px; font-weight: 700">Мы в сетях</v-list-item-title>
                    <v-list-item class="list-item" href="https://www.facebook.com/biothal.ua/" target="_blank">
                        <v-list-item-icon>
                            <v-icon color="#000">mdi-facebook</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            Facebook
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item class="list-item"
                                 target="_blank">
                        <v-list-item-icon>
                            <v-icon color="#000">mdi-twitter</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            Twitter
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item class="list-item" href="https://www.instagram.com/biothal.cosmetics"
                                 target="_blank">
                        <v-list-item-icon>
                            <v-icon color="#000">mdi-instagram</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            Instagram
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </div>
        </div>
        <div class="footer__bottom">
            <div>
                Copyright © 2020. Все права защищены.
            </div>
            <v-spacer/>
            <div>
                Пользовательское соглашение
            </div>
        </div>
    </v-footer>
</template>

<script>
    export default {
        name: "FooterDesktop",
        data() {
            return {}
        },
        created() {
            this.fetchFooterData()
        },
        methods: {
            async fetchFooterData() {
                let data = await this.axios.get('footer');

                this.menuItems = data.data.categories;
            }
        }
    }
</script>

<style scoped lang="scss">
    .footer {

        &__wrapper {
            display: flex;
            flex-direction: column;
        }

        &__top {
            width: 100%;
            background-color: #2F7484;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
            font-size: 18px;

            &__email-icon {
                width: 10px;
                margin: 0;
                padding: 0;
            }
        }

        &__middle {
            display: flex;
            justify-content: space-between;
            width: 100%;
            padding: 60px 60px 0 60px;

            @media screen and (max-width: 991px) {
                flex-wrap: wrap;
            }

            &__block {
                width: 25%;

                &__1 {
                    margin-right: 100px;

                    @media screen and (max-width: 991px) {
                        width: 100%;
                        margin: 0 0 20px 0;
                    }

                    img {
                        @media screen and (max-width: 991px) {
                            margin-bottom: 20px;
                        }
                    }

                }
            }
        }

        &__bottom {
            display: flex;
            flex-direction: row;
            width: 100%;
            color: #9A9A9A;
            padding: 60px 60px 70px 60px;
        }
    }

    .list-item {
        font-weight: 400;
        font-size: 15px;
    }
</style>

<style lang="scss">
    .list-item {
        padding: 0 !important;

        & .v-list-item__icon {
            margin-right: 10px !important;
        }
    }
</style>
