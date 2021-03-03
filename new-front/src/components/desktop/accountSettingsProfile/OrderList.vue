<template>
    <div class="order-list__wrapper">
        <div v-if="isOrders">
            Скоро здесь будет куча ваших заказов, а вместе с их количеством будет расти и ваша скидка ;)
        </div>
        <div v-else>

        </div>
    </div>
</template>

<script>
    export default {
        name: "OrderList",
        data() {
            return {
                isOrders: true
            }
        }
    }
</script>

<style scoped lang="scss">
    .order-list {
        &__wrapper {
            background-color: #fff;
            padding: 20px;
            max-width: 480px;
            width: 100%;
            margin: auto;
        }
    }
</style>
