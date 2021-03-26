<template>
    <div class="menu-wrapper">
        <v-app-bar app height="75" style="width: 100%; padding-left: 20px; padding-right: 20px" color="#fff"
                   ref="app-bar">
            <v-app-bar-nav-icon @click.stop="menuVisible = !menuVisible"></v-app-bar-nav-icon>
            <v-toolbar-title class="main-toolbar-title" @click="toPage({name: 'home'})">
                <img width="108" height="32" src="../../../public/logo.svg"/>
            </v-toolbar-title>
            <div class="app-bar-menu-icon">
                <v-icon color="#000" size="18"
                        @click="$refs['AccountMenuMobile'].visible = true">
                    mdi-account-outline
                </v-icon>
                <v-icon color="#000" size="18" @click="$refs['Basket'].visibleModal(true)">
                    mdi-briefcase-outline
                </v-icon>
            </div>
        </v-app-bar>

        <v-navigation-drawer
            style="height: auto"
            app
            v-model="menuVisible"
            absolute
            clipped
            width="100%">
            <div :style="`height: ${marginTopNavigation}`"/>
            <v-expansion-panels accordion>
                <v-expansion-panel
                    v-for="(item,index) in menuItems"
                    :key="index"
                    :readonly="item.children ? !item.children.length : true">
                    <v-expansion-panel-header
                        :expand-icon="showIconItemMenu(item)">
                        <span @click="toPage({name: 'category-page', params:{ category: item.slug }} )">
                            {{ item.title }}
                        </span>
                    </v-expansion-panel-header>
                    <v-expansion-panel-content class="inner-list">
                        <v-divider/>
                        <v-expansion-panels v-if="item.children ? item.children.length : false" accordion>
                            <v-expansion-panel
                                readonly
                                v-for="(item,index) in item.children"
                                :key="index">
                                <v-expansion-panel-header
                                    @click="toPage({name: 'sub-category-page', params:{ category: item.category.slug, subCategory: item.slug }} )"
                                    expand-icon="">
                                    - {{ item.title }}
                                </v-expansion-panel-header>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
        </v-navigation-drawer>

        <AccountMenuMobile ref="AccountMenuMobile"/>
        <Basket ref="Basket"/>
    </div>
</template>

<script>
import Basket from "../Basket";
import AccountMenuMobile from "./AccountMenuMobile";
import {mapGetters} from "vuex";

export default {
    name: "MenuMobile",
    components: {
        Basket,
        AccountMenuMobile
    },
    computed: {
        ...mapGetters('basket', [
            'products'
        ])
    },
    data() {
        return {
            value: null,
            menuVisible: false,
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
            //             color: '#000',
            //             'background-color': '#fff',
            //             rout: {
            //                 name: 'category-page',
            //                 params: {
            //                     category: 'for-face'
            //                 }
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
            //             color: '#000',
            //             'background-color': '#fff',
            //             rout: {
            //                 name: 'category-page',
            //                 params: {
            //                     category: 'for-body'
            //                 }
            //             }
            //         }
            //     },
            //     {
            //         name: 'Эффективные наборы',
            //         children: [],
            //         meta: {
            //             color: '#000',
            //             'background-color': '#fff',
            //             rout: {
            //                 name: 'info-page',
            //                 params: {
            //                     category: 'effective-sets'
            //                 }
            //             }
            //         }
            //     },
            //     {
            //         name: 'Оплата и доставка',
            //         children: [],
            //         meta: {
            //             color: '#000',
            //             'background-color': '#fff',
            //             rout: {
            //                 name: 'info-page',
            //                 params: {
            //                     category: 'payment-and-delivery'
            //                 }
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
            //             color: '#000',
            //             'background-color': '#fff',
            //             rout: {
            //                 name: 'info-page',
            //                 params: {
            //                     category: 'about-us'
            //                 }
            //             }
            //         }
            //     },
            //     {
            //         name: 'Стать дистрибьютером',
            //         children: [],
            //         meta: {
            //             color: '#fff',
            //             'background-color': '#2F7484',
            //             rout: {
            //                 name: 'info-page',
            //                 params: {
            //                     category: 'become-distributor'
            //                 }
            //             }
            //         }
            //     }
            // ],
            menuItems: [],
            marginTopNavigation: 0,
        }
    },
    mounted() {
        this.fetchMenuData();
        this.marginTopNavigation = this.$refs['app-bar']?.styles.height
    },
    methods: {
        showIconItemMenu(item) {
            const res = item.children ? item.children.length ? 'east' : '' : 'east'
            return res
        },
        // toPageMenu(item) {
        //     if (!item.children?.length) {
        //         if (item.meta?.rout) {
        //             this.toPage({name: item.meta.rout.name, params: item.meta.rout.params})
        //         }
        //     }
        // },
        async fetchMenuData() {
            let data = await this.axios.get('menu');

            this.menuItems = data.data.categories;
        }
    }
}
</script>

<style scoped lang="scss">

</style>

<style lang="scss">

.inner-list {
    & .v-expansion-panel-content__wrap {
        padding: 0;
    }

    & .v-expansion-panel:before {
        box-shadow: none !important;
    }

    & .v-expansion-panel-header {
        padding-left: 55px;
    }
}
</style>
