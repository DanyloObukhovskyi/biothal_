<template>
    <div class="order-list__wrapper">
        <div v-if="isOrders" class="default-text__wrapper">
            <div class="default-text__title">
                Список заказов
            </div>
            <div>
                Скоро здесь будет куча ваших заказов, а вместе с их количеством будет расти и ваша скидка ;)
            </div>
        </div>
        <div v-else>

        </div>
    </div>
</template>

<script>
    export default {
        name: "OrderListMobile",
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
            height: 100%;
            background-color: #f7f7f7;
            padding: 20px;
        }
    }
</style>
