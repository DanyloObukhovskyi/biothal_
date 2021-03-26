<template>
    <div class="menu-wrapper">
        <v-system-bar color="#000" class="menu-wrapper__system-bar default-cursor" dark height="34">
            <div>Бесплатная доставка от <span style="font-weight: 700">1500 грн</span></div>
            <div><img width="18" height="18" src="../../../public/package.svg"/></div>
        </v-system-bar>
        <v-app-bar height="60" width="100%" class="pa-0" color="#fff">
            <v-toolbar-title class="main-toolbar-title" @click="toPage({name: 'home'})">
                <img width="127" height="38" src="../../../public/logo.svg"/>
            </v-toolbar-title>
            <div class="app-bar-menu-wrapper">
                <v-slide-group
                    multiple
                    show-arrows>
                    <v-slide-item v-for="(item, index) in menuItems" :key="index" >
                        <v-menu v-if="item.children.length" open-on-hover offset-y>
                            <template v-slot:activator="{ on, attrs, value }">
                                <v-btn
                                    v-bind="attrs"
                                    v-on="on"
                                    plain>
                                    <span @click="toPage({name: 'category-page', params:{ category: item.slug }} )">{{ item.title }}</span>
                                    <v-icon>
                                        {{value ? 'keyboard_arrow_up' : 'keyboard_arrow_down'}}
                                    </v-icon>
                                </v-btn>
                            </template>
                            <v-list>
                                <v-list-item
                                    class="point-cursor"
                                    v-for="(item, index) in item.children"
                                    :key="index">
                                    <v-list-item-title
                                        @click="toPage({name: 'sub-category-page', params:{ category: item.category.slug, subCategory: item.slug }} )">
                                        {{ item.title }}
                                    </v-list-item-title>
                                </v-list-item>
                            </v-list>
                        </v-menu>
                        <v-btn v-else @click="toPage({name: 'info-page', params:{ category: item.slug }} )" plain>
                            <span>{{ item.title}}</span>
                        </v-btn>
                    </v-slide-item>
                </v-slide-group>
            </div>
            <div class="app-bar-menu-icon">
                <v-menu offset-y>
                    <template v-slot:activator="{ on, attrs, value }">
                        <v-btn
                            width="20"
                            height="20"
                            icon
                            v-bind="attrs"
                            v-on="on">
                            <v-icon color="#000" size="18">mdi-account-outline</v-icon>
                        </v-btn>
                    </template>
                    <v-list>
                        <v-list-item
                            class="point-cursor"
                            v-for="(item, index) in accountMenuItems"
                            :key="index">
                            <v-list-item-title
                                @click="item.click ? item.click() : toPage(item.meta.rout)">
                                {{ item.name }}
                            </v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
                <v-icon color="#000" size="18" @click="toPage({name: 'favorites'})" v-if="isShowFavorite">
                    mdi-heart-outline
                </v-icon>
                <v-icon color="#000" size="18" @click="$refs['Basket'].visibleModal(true)">
                    mdi-briefcase-outline
                </v-icon>
                <v-badge
                    v-if="products.length > 0"
                    color="black"
                    :content="products.length"
                    overlap
                ></v-badge>
            </div>
        </v-app-bar>
        <Basket ref="Basket"/>
    </div>
</template>

<script>
    import Basket from "../Basket";
    import {mapGetters} from "vuex";

    export default {
        name: "MenuDesktop",
        components: {
            Basket
        },
        data() {
            return {
                // menuItems: [
                //     {
                //         name: 'Для лица',
                //         children: [
                //             {
                //                 name: 'Очищение',
                //                 meta: {
                //                     rout: {
                //                         name: 'sub-category-page',
                //                         params: {category: 'for-face', subCategory: 'cleansing'}
                //                     }
                //                 }
                //             },
                //             {
                //                 name: 'Тоники',
                //                 meta: {
                //                     rout: {
                //                         name: 'sub-category-page',
                //                         params: {category: 'for-face', subCategory: 'tonics'}
                //                     }
                //                 }
                //             },
                //             {
                //                 name: 'Кремы',
                //                 meta: {
                //                     rout: {
                //                         name: 'sub-category-page',
                //                         params: {category: 'for-face', subCategory: 'creams'}
                //                     }
                //                 }
                //             },
                //             {
                //                 name: 'Скрабы',
                //                 meta: {
                //                     rout: {
                //                         name: 'sub-category-page',
                //                         params: {category: 'for-face', subCategory: 'scrubs'}
                //                     }
                //                 }
                //             },
                //             {
                //                 name: 'Маски',
                //                 meta: {
                //                     rout: {
                //                         name: 'sub-category-page',
                //                         params: {category: 'for-face', subCategory: 'masks'}
                //                     }
                //                 }
                //             },
                //             {
                //                 name: 'Сыворотки',
                //                 meta: {
                //                     rout: {
                //                         name: 'sub-category-page',
                //                         params: {category: 'for-face', subCategory: 'serums'}
                //                     }
                //                 }
                //             }
                //         ],
                //         meta: {
                //             rout: {
                //                 name: 'category-page',
                //                 params: {category: 'for-face'}
                //             }
                //         }
                //     },
                //     {
                //         name: 'Для тела',
                //         children: [
                //             {
                //                 name: 'Гели для душа',
                //                 meta: {
                //                     rout: {
                //                         name: 'sub-category-page',
                //                         params: {
                //                             category: 'for-body',
                //                             subCategory: 'shower-gels'
                //                         }
                //                     }
                //                 }
                //             },
                //             {
                //                 name: 'Лосьоны',
                //                 meta: {
                //                     rout: {
                //                         name: 'sub-category-page',
                //                         params: {
                //                             category: 'for-body',
                //                             subCategory: 'lotions'
                //                         }
                //                     }
                //                 }
                //             },
                //             {
                //                 name: 'Кремы',
                //                 meta: {
                //                     rout: {
                //                         name: 'sub-category-page',
                //                         params: {
                //                             category: 'for-body',
                //                             subCategory: 'creams'
                //                         }
                //                     }
                //                 }
                //             },
                //             {
                //                 name: 'Масла',
                //                 meta: {
                //                     rout: {
                //                         name: 'sub-category-page',
                //                         params: {
                //                             category: 'for-body',
                //                             subCategory: 'oils'
                //                         }
                //                     }
                //                 }
                //             },
                //             {
                //                 name: 'Скрабы',
                //                 meta: {
                //                     rout: {
                //                         name: 'sub-category-page',
                //                         params: {
                //                             category: 'for-body',
                //                             subCategory: 'scrubs'
                //                         }
                //                     }
                //                 }
                //             },
                //             {
                //                 name: 'Соли для ванн',
                //                 meta: {
                //                     rout: {
                //                         name: 'sub-category-page',
                //                         params: {
                //                             category: 'for-body',
                //                             subCategory: 'bath-salts'
                //                         }
                //                     }
                //                 }
                //             },
                //             {
                //                 name: 'Массажные щетки',
                //                 meta: {
                //                     rout: {
                //                         name: 'sub-category-page',
                //                         params: {
                //                             category: 'for-body',
                //                             subCategory: 'massage-brushes'
                //                         }
                //                     }
                //                 }
                //             }
                //         ],
                //         meta: {
                //             rout: {
                //                 name: 'category-page',
                //                 params: {category: 'for-body'}
                //             }
                //         }
                //     },
                //     {
                //         name: 'Эффективные наборы',
                //         children: [],
                //         meta: {
                //             rout: {
                //                 name: 'category-page',
                //                 params: {category: 'effective-sets'}
                //             }
                //         }
                //     },
                //     {
                //         name: 'O Biothal',
                //         children: [
                //             {
                //                 name: 'Философия бренда',
                //                 meta: {
                //                     rout: {
                //                         name: 'info-page',
                //                         params: {
                //                             category: 'philosophy'
                //                         }
                //                     }
                //                 }
                //             },
                //             {
                //                 name: 'Водоросли',
                //                 meta: {
                //                     rout: {
                //                         name: 'info-page',
                //                         params: {
                //                             category: 'seaweed'
                //                         }
                //                     }
                //                 }
                //             },
                //             {
                //                 name: 'Производство',
                //                 meta: {
                //                     rout: {
                //                         name: 'info-page',
                //                         params: {
                //                             category: 'production'
                //                         }
                //                     }
                //                 }
                //             },
                //             {
                //                 name: 'Водорослевый комплекс "Algo+"',
                //                 meta: {
                //                     rout: {
                //                         name: 'info-page',
                //                         params: {
                //                             category: 'algo'
                //                         }
                //                     }
                //                 }
                //             },
                //             {
                //                 name: 'Сертификаты',
                //                 meta: {
                //                     rout: {
                //                         name: 'info-page',
                //                         params: {
                //                             category: 'certificates'
                //                         }
                //                     }
                //                 }
                //             },
                //         ],
                //         meta: {
                //             rout: {
                //                 name: 'info-page',
                //                 params: {category: 'about-us'}
                //             }
                //         }
                //     },
                //     {
                //         name: 'Стать дистрибьютером',
                //         children: [],
                //         meta: {
                //             rout: {
                //                 name: 'info-page',
                //                 params: {category: 'become-distributor'}
                //             }
                //         }
                //     }
                // ],
                menuItems: [],
                orders: 0,
            }
        },
        computed: {
            ...mapGetters('basket', [
                'products'
            ]),
            accountMenuItems() {
                const isLogin = [
                    {
                        name: 'Войти',
                        meta: {
                            icon: 'login',
                            rout: {name: 'authorization'}
                        }
                    },
                    {
                        name: 'Зарегистрироваться',
                        meta: {
                            icon: 'app_registration',
                            rout: {name: 'registration'}
                        }
                    }
                ]

                const isLogout = [
                    {
                        name: 'Личный кабинет',
                        meta: {
                            icon: 'mode_edit_outline',
                            rout: {name: 'account-settings'}
                        }
                    },
                    {
                        name: 'Выйти',
                        meta: {
                            icon: 'logout',
                            rout: {name: 'home'}
                        },
                        click: this.logout
                    }
                ]

                return this.isAuthorize ? isLogout : isLogin
            }
        },
        watch: {

        },
        created() {
            this.fetchMenuData();
        },
        mounted() {
            this.test();
        },
        methods: {
            async fetchMenuData() {
                let data = await this.axios.get('menu');

                this.menuItems = data.data.categories;
            },
            test(){
                this.orders = this.$refs['Basket'].products.length
                console.log(this.$refs['Basket'].products.length)
            }
        }
    }
</script>

<style scoped lang="scss">
    .menu-wrapper {
        &__system-bar {
            display: flex;
            justify-content: center;
            color: #fff;
            font-weight: 200;
            font-style: normal;
            font-size: 12px;
            line-height: 16.39px;
            column-gap: 5.5px;
        }
    }

    .app-bar-menu-wrapper {
        display: flex;
        flex-direction: row;
        /*127px - width logo, 43px - padding left logo, 11px - padding icon, 18px - width icon, 43px - padding right icons*/
        width: calc(100% - 127px - 43px - 18px - 11px - 18px - 11px - 18px - 43px);
        justify-content: center;
    }

    .app-bar-menu-icon {
        padding-right: 43px;
        display: flex;
        flex-direction: row;
        column-gap: 11px;
        height: 21px;

        &:hover {
            cursor: pointer;
        }
    }

    .main-toolbar-title {
        padding-left: 43px;

        &:hover {
            cursor: pointer;
        }
    }
</style>

<style lang="scss">
    .menu-wrapper {
        & .v-toolbar__content {
            padding: 0 !important;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: 100%;
        }
    }

    .app-bar-menu-wrapper {
        & .v-btn__content {
            font-size: 13px;
            line-height: 18px;
            color: #000;
        }
    }

    .basket_lenght{
        margin: -2px;
    }
</style>
