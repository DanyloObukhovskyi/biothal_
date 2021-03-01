export default {
    data() {
        return {}
    },
    computed: {
        isMobile() {
            return screen.width <= 600
        }
    },
    methods: {
        toPage(rout) {
            if (this.$router.history.current.name !== rout.name
                || JSON.stringify(this.$router.history.current.params) !== JSON.stringify(rout.params ? rout.params : {})) {
                this.$router.push({name: rout.name, params: rout.params})
            }
        }
    }
}
