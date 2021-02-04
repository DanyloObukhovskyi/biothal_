<template>
    <div class="menu-wrapper">
        <v-system-bar color="#000" class="menu-wrapper__system-bar" dark height="34">
            <div>Бесплатная доставка от 1500 грн <img width="18" height="18" src="../../public/package.svg"/></div>
        </v-system-bar>
        <v-app-bar height="60" class="pa-0" color="#fff">
            <v-toolbar-title style="padding-left: 43px"><img width="127" height="38" src="../../public/logo.svg"/></v-toolbar-title>
            <div class="app-bar-menu-wrapper">
                <v-btn-toggle group>
                    <v-btn value="recent" plain>
                        <span>Для лица</span>
                    </v-btn>
                    <v-btn value="favorites" plain>
                        <span>Для тела</span>
                    </v-btn>
                    <v-btn value="nearby" plain>
                        <span>Эффективные наборы</span>
                    </v-btn>
                    <v-btn value="nearby" plain>
                        <span>O Biothal</span>
                    </v-btn>
                    <v-btn value="nearby" plain>
                        <span>Стать дистрибьютером</span>
                    </v-btn>
                </v-btn-toggle>
            </div>
            <v-spacer/>
            <div>
                <v-icon color="#000" size="18">mdi-heart-outline</v-icon>
                <v-icon color="#000" size="18">mdi-account-outline</v-icon>
                <v-icon color="#000" size="18">mdi-briefcase-outline</v-icon>
            </div>
        </v-app-bar>
    </div>
</template>

<script>
    export default {
        name: "Menu",
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
            font-weight: 700;
            font-style: normal;
            font-size: 12px;
            line-height: 16.39px;
        }
    }

    .app-bar-menu-wrapper {
        display: flex;
        flex-direction: row;
        width: 100%;
        justify-content: center;
    }
</style>

<style lang="scss">
    .menu-wrapper {
        & .v-toolbar__content {
            padding: 0 !important;
        }
    }
</style>
