<template>
    <div class="menu-wrapper">
        <v-app-bar app height="75" style="width: 100%; padding-left: 20px; padding-right: 20px" color="#fff"
                   ref="app-bar">
            <v-app-bar-nav-icon @click.stop="menuVisible = !menuVisible"></v-app-bar-nav-icon>
            <v-toolbar-title class="main-toolbar-title" @click="toPage({name: 'home'})">
                <img width="108" height="32" src="../../../public/logo.svg"/>
            </v-toolbar-title>
            <div class="app-bar-menu-icon">
                <v-icon color="#000" size="18" @click="toPage({name: 'account-settings'})">
                    mdi-account-outline
                </v-icon>
                <v-icon color="#000" size="18" @click="$refs['Basket'].visibleModal(true)">
                    mdi-briefcase-outline
                </v-icon>
            </div>
        </v-app-bar>

        <v-navigation-drawer
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
                        :style="`background-color: ${item.meta['background-color']}; color: ${item.meta['color']}`"
                        :expand-icon="showIconItemMenu(item)"
                        @click="toPageMenu(item)">
                        {{item.name}}
                    </v-expansion-panel-header>
                    <v-expansion-panel-content class="inner-list">
                        <v-divider/>
                        <v-expansion-panels v-if="item.children ? item.children.length : false" accordion>
                            <v-expansion-panel
                                readonly
                                v-for="(item,index) in item.children"
                                :key="index">
                                <v-expansion-panel-header expand-icon="">
                                    {{item.name}}
                                </v-expansion-panel-header>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
        </v-navigation-drawer>

        <Basket ref="Basket"/>
    </div>
</template>

<script>
    import Basket from "../Basket";

    export default {
        name: "MenuMobile",
        components: {
            Basket
        },
        data() {
            return {
                value: null,
                menuVisible: false,
                menuItems: [
                    {
                        name: 'Для лица',
                        children: [
                            {name: 'Что-то еще 1'},
                            {name: 'Что-то еще 2'}
                        ],
                        meta: {
                            color: '#000',
                            'background-color': '#fff',
                            rout: 'for-face'
                        }
                    },
                    {
                        name: 'Для тела',
                        children: [
                            {name: 'Что-то еще 1'},
                            {name: 'Что-то еще 2'}
                        ],
                        meta: {
                            color: '#000',
                            'background-color': '#fff',
                            rout: 'for-body'
                        }
                    },
                    {
                        name: 'Гели для душа',
                        children: [],
                        meta: {
                            color: '#000',
                            'background-color': '#fff',
                            rout: 'for-body'
                        }
                    },
                    {
                        name: 'Лосьоны',
                        children: [],
                        meta: {
                            color: '#000',
                            'background-color': '#fff',
                            rout: 'for-body'
                        }
                    },
                    {
                        name: 'Кремы',
                        children: [],
                        meta: {
                            color: '#000',
                            'background-color': '#fff',
                            rout: 'for-body'
                        }
                    },
                    {
                        name: 'Масла',
                        children: [],
                        meta: {
                            color: '#000',
                            'background-color': '#fff',
                            rout: 'for-body'
                        }
                    },
                    {
                        name: 'Скрабы',
                        children: [],
                        meta: {
                            color: '#000',
                            'background-color': '#fff',
                            rout: 'for-body'
                        }
                    },
                    {
                        name: 'Соли для ванн',
                        children: [],
                        meta: {
                            color: '#000',
                            'background-color': '#fff',
                            rout: 'for-body'
                        }
                    },
                    {
                        name: 'Массажные щетки',
                        children: [],
                        meta: {
                            color: '#000',
                            'background-color': '#fff',
                            rout: 'for-body'
                        }
                    },
                    {
                        name: 'Эффективные наборы',
                        children: [],
                        meta: {
                            color: '#000',
                            'background-color': '#fff',
                            rout: 'effective-sets'
                        }
                    },
                    {
                        name: 'О компании',
                        children: [
                            {name: 'Что-то еще 1'},
                            {name: 'Что-то еще 2'}
                        ],
                        meta: {
                            color: '#000',
                            'background-color': '#fff',
                            rout: 'about-us'
                        }
                    },
                    {
                        name: 'Стать дистрибьютером',
                        children: [],
                        meta: {
                            color: '#fff',
                            'background-color': '#2F7484',
                            rout: 'about-us'
                        }
                    }
                ],
                marginTopNavigation: 0,
            }
        },
        mounted() {
            this.marginTopNavigation = this.$refs['app-bar']?.styles.height
        },
        methods: {
            showIconItemMenu(item) {
                const res = item.children ? item.children.length ? 'east' : '' : 'east'
                return res
            },
            toPageMenu(item) {
                if (!item.children?.length) {
                    if(item.meta?.rout) {
                        this.toPage({name: item.meta.rout})
                    }
                }
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
