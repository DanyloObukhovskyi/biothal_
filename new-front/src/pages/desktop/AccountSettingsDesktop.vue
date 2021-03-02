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
                                <div>
                                    Алина Борикорна
                                </div>
                                <div>
                                    Выйти
                                    <v-icon>logout</v-icon>
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
                <BankCards v-if="changeItem === 1"/>
                <OrderList v-if="changeItem === 2"/>
                <GroupDiscountParticipants v-if="changeItem === 3"/>
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
            BankCards,
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
                        text: 'Банковские карты',
                    },
                    {
                        text: 'Список заказов',
                    },
                    {
                        text: 'Участники групповой скидки',
                    },
                ],
                changeItem: 0
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
