<template>
    <v-app>
        <Menu/>
        <v-main app>
            <router-view/>
        </v-main>
        <Footer/>
    </v-app>
</template>

<script>
    import Menu from "../components/Menu";
    import Footer from "../components/Footer";

    export default {
        name: "Dashboard",
        components: {
            Menu,
            Footer
        }
    }
</script>

<style scoped>

</style>
