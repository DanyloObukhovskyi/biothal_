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
            if (this.$router.history.current.name !== rout.name) {
                this.$router.push({name: rout.name, params: rout.params})
            }
        }
    }
}
