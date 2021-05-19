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
        },
        created() {
            (function(d, w, s) {
                var widgetHash = 'mr4swiw83bp19edxoqs5', gcw = d.createElement(s); gcw.type = 'text/javascript'; gcw.async = true;
                gcw.src = '//widgets.binotel.com/getcall/widgets/'+ widgetHash +'.js';
                var sn = d.getElementsByTagName(s)[0]; sn.parentNode.insertBefore(gcw, sn);
            })(document, window, 'script');
        }
    }
</script>

<style scoped lang="scss">
</style>
