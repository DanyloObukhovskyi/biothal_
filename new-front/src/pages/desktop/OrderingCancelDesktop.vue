<template>
    <div>
        <div class="order-status__title">
            Ваш заказ № token
        </div>
        <div class="order-status__content">
            Пожалуйста, ожидайте звонка оператора для
            <br>уточнения деталей заказа и условий доставки.
            <br>Call - центр работает по будням: <b>10:00 — 17:00.</b>
            <br>Суббота / Воскресенье: <b>Выходной.</b>
            <br>Остались вопросы? <br>Звони <b>+38 (068) 888-12-08</b>
            <br>Или пиши нам в instagram <a class="text-decoration-none" href="https://www.instagram.com/biothal.ua/"><b>@biothal.ua</b></a>
        </div>
        <div class="button">
            <v-btn dark class="order-status__button" elevation="0">
                На главную
            </v-btn>
        </div>

    </div>
</template>

<script>
    export default {
        name: "OrderingCancelDesktop",
        props: {
            token: {
                type: [Number, String],
                default: 1
            },
        },
    }
</script>

<style scoped>

</style>
