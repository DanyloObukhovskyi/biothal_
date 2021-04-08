<template>
    <div class="order-list__wrapper">
        <v-data-table
            :headers="orderListHeaders"
            :items="orderList"
            :single-expand="true"
            :expanded.sync="expanded"
            item-key="id"
            class="elevation-1"
            :hide-default-footer="!orderList.length"
            :hide-default-header="!orderList.length"
            :footer-props="{
                'items-per-page-text':'Заказов на странице',
            }">
            <template v-if="orderList.length" v-slot:top>
                <v-toolbar flat>
                    <v-spacer></v-spacer>
                    <v-toolbar-title>Список заказов</v-toolbar-title>
                    <v-spacer></v-spacer>
                </v-toolbar>
            </template>
            <template v-if="orderList.length" slot="body.append">
                <tr>
                    <th class="title">Сумма заказов</th><th></th><th></th>
                    <th class="title">{{ sumField('total_sum') }}</th>
                </tr>
            </template>
            <template slot="no-data">
                <div class="title">
                    Список заказов пуст
                </div>
            </template>
        </v-data-table>
    </div>
</template>

<script>
    export default {
        name: "OrderList",
        data() {
            return {
                isOrders: true,
                expanded: [],
                singleExpand: false,
                orderListHeaders: [
                    {
                        text: 'Номер заказа',
                        align: 'start',
                        sortable: false,
                        value: 'id',
                    },
                    { text: 'Тип оплаты', sortable: false, value: 'order_type.title' },
                    { text: 'Статус', sortable: false, value: 'order_status.name' },
                    { text: 'Сумма (грн)', sortable: false, value: 'total_sum' },
                ],
                orderList: [
                    {
                        id: '',
                        order_status: {
                            name: ''
                        },
                        order_type: {
                            title: ''
                        },
                        total_sum: '',
                        // products: {
                        //     attr: {
                        //         image: {
                        //             name: ''
                        //         }
                        //     },
                        //     is_sales: '',
                        //     price: '',
                        //     price_with_sales: '',
                        //     quantity: ''
                        // }
                    }
                ]
            }
        },
        mounted() {
            this.fetchOrderList();
        },
        watch: {
            route: {
                deep: true,
                handler (newRoute, oldRoute) {
                    this.fetchOrderList();
                }
            },
        },
        methods: {
            async fetchOrderList() {
                this.orderList = await this.$parent.orderList;

                this.orderList.map(function(value, key) {
                    if (value.order_status.name === 'active') {
                        value.order_status.name = 'В обработке';
                    } else if (value.order_status.name === 'payment_process'){
                        value.order_status.name = 'В процессе оплаты';
                    } else if (value.order_status.name === 'shipping_process'){
                        value.order_status.name = 'Отправленна получателю';
                    } else if (value.order_status.name === 'finish'){
                        value.order_status.name = 'Получена';
                    } else if (value.order_status.name === 'pre_order'){
                        value.order_status.name = 'Предзаказ';
                    }

                    if (value.order_type === null) {
                        value.order_type = {title: 'Не выбрано'};
                    }
                });
            },
            sumField(key) {
                return (this.orderList.reduce((a, b) => +a + (+b[key] || 0), 0)).toFixed(2)
            }
        }
    }
</script>

<style scoped lang="scss">
    .order-list {
        &__wrapper {
            background-color: #fff;
            padding: 0 20px 20px 20px;
            width: 90%;
        }
    }
</style>
