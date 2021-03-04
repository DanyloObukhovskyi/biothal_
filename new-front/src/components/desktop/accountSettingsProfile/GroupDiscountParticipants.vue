<template>
    <div class="group-discount-participants__wrapper">
        <v-simple-table style="width: 100%">
            <template v-slot:default>
                <thead>
                <tr>
                    <th class="text-left">
                        ID
                    </th>
                    <th class="text-left">
                        Имя Фамилия
                    </th>
                    <th class="text-left">
                        Сколько накопил для группы
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="text-left"
                    v-for="(item, index) in participants" :key="index">
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.money }}</td>
                </tr>
                </tbody>
            </template>
        </v-simple-table>
        <v-btn dark class="checkout-button" elevation="0">
            Добавить друга
        </v-btn>
    </div>
</template>

<script>
    export default {
        name: "GroupDiscountParticipants",
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
            background-color: #fff;
            justify-content: flex-end;
            align-items: flex-end;
            text-align: center;
            row-gap: 20px;
            padding: 0 20px 20px 20px;
        }
    }

    .text-left {
        text-align: left;
    }

    .text-right {
        text-align: right;
    }

    .checkout-button {
        max-width: 190px;
        width: 100%;
    }

    .v-data-table__wrapper {

        & th {
            color: #000 !important;
        }
    }
</style>
