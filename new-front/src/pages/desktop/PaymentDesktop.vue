<template>
    <div class="ordering__wrapper">
        <div class="ordering__content">
            <div class="ordering__middle">
                <iframe
                    id="paymentFrame"
                    scrolling="no"
                    :src="paymentUrl"
                    allowpaymentrequest
                    frameborder="0"></iframe>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

export default {
    name: "PaymentDesktop",
    props: ['paymentUrl'],
    computed: {
        ...mapGetters('basket', [
            'products',
            'globalSales',
            'currentGlobalSales',
            'nextGlobalSales',
            'linear',
            'productsSum',
            'productsSumWithSales'
        ])
    },
    methods: {
        ...mapActions('basket', {
            deleteProduct: 'DELETE_PRODUCT',
            clearCart: 'CLEAR_ALL_CART'
        }),
        clearCartProducts() {
            this.clearCart()
        },
        iframeURLChange(iframe, callback) {
            var lastDispatched = null;

            var dispatchChange = function () {
                var newHref = iframe.contentWindow.location.href;

                if (newHref !== lastDispatched) {
                    callback(newHref);
                    lastDispatched = newHref;
                }
            };

            var unloadHandler = function () {
                // Timeout needed because the URL changes immediately after
                // the `unload` event is dispatched.
                setTimeout(dispatchChange, 0);
            };

            function attachUnload() {
                // Remove the unloadHandler in case it was already attached.
                // Otherwise, there will be two handlers, which is unnecessary.
                iframe.contentWindow.removeEventListener("unload", unloadHandler);
                iframe.contentWindow.addEventListener("unload", unloadHandler);
            }

            iframe.addEventListener("load", function () {
                attachUnload();

                // Just in case the change wasn't dispatched during the unload event...
                dispatchChange();
            });

            attachUnload();
        }

    },
    mounted() {
        this.$loading(true)
        this.iframeURLChange(document.getElementById("paymentFrame"), function (newURL) {
            if (newURL !== 'about:blank') {
                window.location.href = newURL
            }
        });

        setTimeout(
            function () {
                this.$loading(false)
            }.bind(this),
            2000
        );
        this.clearCartProducts();
    }
}
</script>

<style scoped lang="scss">
.ordering__middle {
    margin: 100px;
    justify-content: center;
    display: flex;

    iframe {
        height: 1200px;
    }
}
</style>
