<template>
    <div class="group-discount-participants__wrapper">
        <div class="group-discount-participants__title">Участники групповой скидки</div>
        <div v-for="(item, index) in participants" :key="index">
            <v-simple-table>
                <template v-slot:default>
                    <tbody>
                    <tr>
                        <td class="text-left">ID</td>
                        <td class="text-right">{{item.id}}</td>
                    </tr>
                    <tr>
                        <td class="text-left">Имя Фамилия</td>
                        <td class="text-right">{{item.name}}</td>
                    </tr>
                    <tr>
                        <td class="text-left">{{item.money}}</td>
                        <td class="text-right">0 грн</td>
                    </tr>
                    </tbody>
                </template>
            </v-simple-table>
        </div>
        <div>
            <v-btn dark class="checkout-button" elevation="0">
                Добавить друга
            </v-btn>
        </div>
    </div>
</template>

<script>
    export default {
        name: "GroupDiscountParticipantsMobile",
        data() {
            return {
                participants: [
                    {
                        id: 1,
                        name: 'Вы',
                        money: '0 грн'
                    },
                    {
                        id: 2,
                        name: 'Не ты',
                        money: '10 грн'
                    }
                ]
            }
        }
    }
</script>

<style scoped lang="scss">
    .group-discount-participants {
        &__wrapper {
            display: flex;
            flex-direction: column;
            background-color: #f7f7f7;
            height: 100%;
            text-align: center;
            row-gap: 20px;
            padding: 20px;
        }

        &__title {
            font-weight: 700;
        }
    }

    .text-left {
        text-align: left;
    }

    .text-right {
        text-align: right;
    }
</style>
