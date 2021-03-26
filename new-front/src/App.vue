<template>
    <div id="app">
        <router-view/>
        <notifications />
    </div>
</template>

<script>

    export default {
        name: 'App',
        mounted() {
            this.checkUser()
        },
        methods:{
            async checkUser(){
                try {
                    let data = await this.axios.post('checkUser');
                    if(data){
                        let login = data.data.login
                        try {
                            await this.$store.dispatch('LOGIN', login);
                        } catch (e) {
                            console.log(e)
                        }
                    }
                } catch (e) {
                    this.errorMessagesValidation(e);
                }
            }
        }
    }
</script>

<style lang="scss">

    .base-page-wrapper {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .default-cursor {
        cursor: default;
    }

    div::-webkit-scrollbar-track
    {
        color: #EAEAEA;
        border-radius: 10px;
    }

    div::-webkit-scrollbar
    {
        width: 7px;

        @media screen and (max-width: 600px) {
            display: none;
        }
    }

    div::-webkit-scrollbar-thumb
    {
        border-radius: 10px;
        background-color: #EAEAEA;
    }
</style>
