export default {
    data() {
        return {}
    },
    methods: {
        toPage(rout) {
            if (this.$router.history.current.name !== rout.name) {
                this.$router.push({name: rout.name, params: rout.params})
            }
        }
    }
}
