<template>
    <div>
        <div class="order-status__title">
            Ваш заказ №{{ id }}
        </div>
        <div class="order-status__title">
            Принят, мы вам перезвоним в течении получаса
        </div>
    </div>
</template>

<script>
    export default {
        name: "OrderingStatusDesktop",
        props: {
            id: {
                type: [Number, String],
                default: 1
            },
        },
        data() {
            return {
                title: '',
                message: ''
            }
        },
        created() {
            this.fetchOrderStatus();
        },
        methods: {
            async fetchOrderStatus() {
                let data = await this.axios.get('order-status/' + this.id);

                // this.title =  data.data.title;
                // this.message = data.data.message;
            }
        }
    }
</script>

<style scoped lang="scss">
    .order-status {
        &__title {
            text-align: center;
            text-transform: uppercase;
            font-size: 34px;
            margin: 50px;

            @media screen and (max-width: 600px) {
                margin: 20px;
            }
        }

        &__content {
            &__wrapper {
                max-width: 100%;
                padding: 0 45px 45px 45px;

                @media screen and (max-width: 600px) {
                    padding: 0 20px 20px 20px;
                }
            }
        }
    }

    .page-form {

        &__wrapper {
            background-color: #fff;
            text-align: left;
        }

        &__top {
            display: flex;
            flex-direction: column;
            text-align: center;

            &__title {
                font-size: 14px;
                line-height: 19px;
                font-weight: 700;
            }
        }

        &__middle {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        &__bottom {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }
    }

    .main-input-label {
        font-weight: 200;
        font-size: 12px;
        line-height: 16px;
        color: #000;
        margin: 15px 0 0 0;
    }

    .main-input-field {
        width: 100%;
        height: 54px;
        background: #F7F7F7;
        border-radius: 2px;
    }

</style>
