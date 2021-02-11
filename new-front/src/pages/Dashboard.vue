<template>
    <v-app>
        <MenuDesktop v-if="!isMobile"/>
        <MenuMobile v-if="isMobile"/>
        <v-main app>
            <router-view/>
        </v-main>
        <FooterDesktop v-if="!isMobile"/>
        <FooterMobile v-if="isMobile"/>
    </v-app>
</template>

<script>
    import MenuDesktop from "../components/desktop/MenuDesktop";
    import FooterDesktop from "../components/desktop/FooterDesktop";
    import MenuMobile from "../components/mobile/MenuMobile";
    import FooterMobile from "../components/mobile/FooterMobile";

    export default {
        name: "Dashboard",
        components: {
            MenuDesktop,
            FooterDesktop,
            MenuMobile,
            FooterMobile
        }
    }
</script>

<style scoped lang="scss">
</style>
