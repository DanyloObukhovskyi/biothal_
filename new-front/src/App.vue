<template>
    <div id="app">
        <router-view/>
        <notifications />
    </div>
</template>

<script>

    export default {
        name: 'App',
        created() {
            this.checkUser()
        },
        methods:{
            async checkUser(){
                try {
                    const token = this.$store.getters.getToken;
                    if(token){
                        let data = await this.axios.post('checkUser', {

                        },  {
                            headers: {
                                'Authorization': `Bearer ${token}`
                            }
                        });
                        if(data){
                            let exist = data.data.exist
                            if(!exist){
                                await this.$store.dispatch('LOGIN', null);
                                return false;
                            }
                        } else {
                            await this.$store.dispatch('LOGIN', null);
                        }
                        return true;
                    } else {
                        return false;
                    }
                } catch (e) {
                    await this.$store.dispatch('LOGIN', null);
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
