<template>
    <div class="account-settings__wrapper">
        <div class="account-settings__title">
            Мой профиль
        </div>
        <div class="account-settings__content__wrapper">
            <div style="width: calc(100% / 3)">
                <v-navigation-drawer style="height: auto; margin: auto" permanent>
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title style="display: flex; justify-content: space-between">
                                <div class="default-cursor">
                                    {{ profile.name + ' ' + profile.sur_name }}
                                </div>
                                <div class="point-cursor account-settings__logout" @click="logout">
                                    Выйти
                                    <v-icon size="12">logout</v-icon>
                                </div>
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-divider/>
                    <v-list>
                        <v-list-item-group v-model="changeItem">
                            <v-list-item
                                v-for="(item, i) in items"
                                :key="i">
                                <v-list-item-content>
                                    <v-list-item-title style="text-align: left" v-text="item.text"/>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list-item-group>
                    </v-list>
                </v-navigation-drawer>
            </div>
            <div style="width: calc((100% / 3) * 2)">
                <OrderList v-if="changeItem === 1"/>
                <GroupDiscountParticipants v-if="changeItem === 2"/>
                <AccountProfile v-if="changeItem === 0"/>
            </div>
        </div>
    </div>
</template>

<script>
    import AccountProfile from "../../components/desktop/accountSettingsProfile/AccountProfile";
    import BankCards from "../../components/desktop/accountSettingsProfile/BankCards";
    import OrderList from "../../components/desktop/accountSettingsProfile/OrderList";
    import GroupDiscountParticipants from "../../components/desktop/accountSettingsProfile/GroupDiscountParticipants";

    export default {
        name: "AccountSettingsDesktop",
        components: {
            AccountProfile,
            OrderList,
            GroupDiscountParticipants
        },
        data() {
            return {
                rememberMe: false,

                items: [
                    {
                        text: 'Личные данные',
                    },
                    {
                        text: 'Список заказов',
                    },
                    {
                        text: 'Участники групповой скидки',
                    },
                ],
                changeItem: 0,
                profile: {
                    name: '',
                    sur_name: '',
                    date: '',
                    email: '',
                    phone_number: '',
                    email_receive: {
                        is_receive: 0
                    },
                    image_id: null,
                    image:{
                        name: ''
                    }
                },
                orderList: {}
            }
        },
        created(){
            this.checkUserIsValid()
            this.isValid()
            this.getProfile()
        },
        methods: {
            async getProfile(){
                await this.checkUserIsValid()
                try {
                    this.$loading(true)
                    const token = this.$store.getters.getToken;
                    if(token){
                        let data = await this.axios.post('profile', {

                        },  {
                            headers: {
                                'Authorization': `Bearer ${token}`
                            }
                        });
                        if(data){
                            this.profile = data.data.user
                            this.orderList = data.data.orderList

                        }
                    }
                    this.$loading(false)
                } catch (e) {
                    this.$loading(false)
                    this.errorMessagesValidation(e);
                }
            },
            async isValid(){
                await this.checkUserIsValid()
                const token = this.$store.getters.getToken;
                if(!token){
                    this.toPage({name: 'AuthorizationMobile'})
                }
            },
            async checkUserIsValid(){
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
                                this.toPage({name: 'AuthorizationMobile'})
                                return false;
                            }
                        } else {
                            await this.$store.dispatch('LOGIN', null);
                            this.toPage({name: 'AuthorizationMobile'})
                        }
                        return true;
                    } else {
                        return false;
                    }
                } catch (e) {
                    await this.$store.dispatch('LOGIN', null);
                    this.toPage({name: 'AuthorizationMobile'})
                    this.errorMessagesValidation(e);
                }
            }
        }
    }
</script>

<style scoped lang="scss">
    .account-settings {
        &__wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            text-align: center;
            padding: 20px;
        }

        &__title {
            font-size: 18px;
            font-weight: 200;
            line-height: 25px;
            letter-spacing: 0em;
            margin: 0 20px 20px 20px;
        }

        &__logout {
            font-size: 12px;
            display: flex;
            column-gap: 4px;
            align-items: center;
            justify-content: center;
        }

        &__content {
            &__wrapper {
                display: flex;
                width: 100%;
            }
        }
    }
</style>

<style lang="scss">

    .account-settings__wrapper {
        .v-navigation-drawer__content {
            background-color: #F7F7F7;
        }

        .v-list-item--active {
            background-color: #2F7484;

            & .v-list-item__content {
                color: #fff;
            }
        }

        .v-navigation-drawer__border {
            display: none;
        }
    }
</style>
