export default {
    data() {
        return {
            isShowFavorite: false,
            api: process.env.VUE_APP_REQUEST_BASE_URL
        }
    },
    computed: {
        isMobile() {
            return screen.width <= 600
        },
        isAuthorize() {
            return this.$store.getters.getToken;
        }
    },
    methods: {
        toPage(rout) {
            if (this.$router.history.current.name !== rout.name
                || JSON.stringify(this.$router.history.current.params) !== JSON.stringify(rout.params ? rout.params : {})) {
                this.$router.push({name: rout.name, params: rout.params})
            }
        },
        logout() {
            this.$store.commit("SET_TOKEN", null);
            this.toPage({name: 'home'})
        }
    }
}
