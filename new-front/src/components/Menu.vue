<template>
    <div class="menu-wrapper">
        <v-system-bar color="#000" class="menu-wrapper__system-bar default-cursor" dark height="34">
            <div>Бесплатная доставка от <span style="font-weight: 700">1500 грн</span></div>
            <div><img width="18" height="18" src="../../public/package.svg"/></div>
        </v-system-bar>
        <v-app-bar height="60" width="100%" class="pa-0" color="#fff">
            <v-toolbar-title class="main-toolbar-title" @click="toPage({name: 'home'})">
                <img width="127" height="38" src="../../public/logo.svg"/>
            </v-toolbar-title>
            <div class="app-bar-menu-wrapper">
                <v-btn-toggle group>
                    <v-btn @click="toPage({name: 'for-face'})"
                           value="forFace" plain>
                        <span>Для лица</span>
                    </v-btn>
                    <v-btn @click="toPage({name: 'for-body'})"
                           value="forBody" plain>
                        <span>Для тела</span>
                    </v-btn>
                    <v-btn @click="toPage({name: 'effective-sets'})"
                           value="effectiveSets" plain>
                        <span>Эффективные наборы</span>
                    </v-btn>
                    <v-btn @click="toPage({name: 'about-us'})"
                           value="aboutBiothal" plain>
                        <span>O Biothal</span>
                    </v-btn>
                    <v-btn @click="toPage({name: 'become-distributor'})"
                           value="becomeDistributor" plain>
                        <span>Стать дистрибьютером</span>
                    </v-btn>
                </v-btn-toggle>
            </div>
            <div class="app-bar-menu-icon">
                <v-icon color="#000" size="18">mdi-heart-outline</v-icon>
                <v-icon color="#000" size="18">mdi-account-outline</v-icon>
                <v-icon color="#000" size="18" @click="$refs['Basket'].visibleModal(true)">
                    mdi-briefcase-outline
                </v-icon>
            </div>
        </v-app-bar>
        <Basket ref="Basket"/>
    </div>
</template>

<script>
    import Basket from "./Basket";

    export default {
        name: "Menu",
        components: {
            Basket
        },
        data() {
            return {
                value: null
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
        width: 826px;
        justify-content: center;
    }

    .app-bar-menu-icon {
        padding-right: 43px;
        display: flex;
        flex-direction: row;
        column-gap: 11px;

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
</style>
