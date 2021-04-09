<template>
    <div class="product" @mouseover="isFavoritesShow = true" @mouseleave="isFavoritesShow = false">
        <div class="product__sale" v-if="isShowStock">
          <span>{{ -dataCard.get_sale.percent }}%</span>
        </div>
        <img class="product__image"
             @click="toPage({name: 'product', params: {id: dataCard['id']}})"
             :src="this.api+'/storage/img/products/' + dataCard['image']['name']"
             :alt="dataCard['image']['name']"/>
        <div class="product__description">
            <div @click="toPage({name: 'product', params: {id: dataCard['id']}})" class="product__description__text">
                {{ dataCard['product_description']['name'] }}
            </div>
            <div class="product__description__price default-cursor">{{ dataCard['price'] }} грн</div>
        </div>
        <div>
            <v-btn v-if="dataCard.stock_status_id !== 2" :disabled="dataCard.stock_status_id === 3"
                   class="product__button white--text" elevation="0" @click="addToCart">
                {{ dataCard.stock_status_id === 3 ? 'Нет в наличии' : 'Купить'}}
            </v-btn>
            <v-btn v-else class="product__button white--text" :disabled="dataCard.stock_status_id === 3"
                   :color="variables.basecolor" elevation="0"
                   @click="preOrder">
                Предзаказ
            </v-btn>
        </div>
        <v-snackbar
            v-model="showMessage"
            v-bind="snackbar">
            Товар добавлен в корзину
        </v-snackbar>

        <PreOrderOneClickModal ref="PreOrderOneClickModal" :data-card="dataCard" :name="name" :phone="phone" :user_id="user_id"/>

    </div>
</template>

<script>
    import {mapActions} from "vuex";
    import PreOrderOneClickModal from "../../PreOrderOneClickModal.vue";

    export default {
        name: "ProductCardMobile",
        components: {
            PreOrderOneClickModal
        },
        props: {
            dataCard: {
                type: Object,
                stock_status_id: ''
            },
            isShowStock: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                isFavorites: false,
                isFavoritesShow: false,
                showMessage: false,
                snackbar: {
                    right: true,
                    color: 'green',
                    timeout: 900,
                    multiLine: true
                },
                name: '',
                phone: '',
                user_id: ''
            }
        },
        methods: {
            ...mapActions('basket', {
                addProduct: 'ADD_PRODUCT'
            }),
            addToCart() {
                this.showMessage = true;
                const product = this.dataCard;
                product.quantity = 1;

                this.addProduct(product)
            },
            preOrder() {
                this.getProfile();
                this.$refs['PreOrderOneClickModal'].visible = true;
            },
            async getProfile() {
                await this.checkUserIsValid()
                try {
                    const token = this.$store.getters.getToken;
                    if (token) {
                        let data = await this.axios.post('profile', {}, {
                            headers: {
                                'Authorization': `Bearer ${token}`
                            }
                        });

                        if (data) {
                            let user = data.data.user;
                            this.name = user.name;
                            this.phone = user.phone_number;
                            this.user_id = user.id;
                        }
                    }
                } catch (e) {
                    this.errorMessagesValidation(e);
                }
            },
            async checkUserIsValid() {
                try {
                    const token = this.$store.getters.getToken;
                    if (token) {
                        let data = await this.axios.post('checkUser', {}, {
                            headers: {
                                'Authorization': `Bearer ${token}`
                            }
                        });
                        if (data) {
                            let exist = data.data.exist
                            if (!exist) {
                                await this.$store.dispatch('LOGIN', null);
                                return false;
                            }
                        } else {
                            await this.$store.dispatch('LOGIN', null);
                        }
                        return true;
                    } else {
                        return false;
                    }
                } catch (e) {
                    await this.$store.dispatch('LOGIN', null);
                    this.errorMessagesValidation(e);
                }
            }
        }
    }
</script>

<style scoped lang="scss">

    .product {
        background-color: #fff;
        text-align: center;
        display: flex;
        flex-direction: column;
        padding: 0 10px 10px 10px;
        row-gap: 10px;
        position: relative;
        border-radius: 2px;
        overflow: hidden;

        &:hover {
            box-shadow: 0 0 33px #f2f2f2;

            & .product__button[disabled] {
                background-color: #909090 !important;
            }

            & .product__button {
                background-color: #000 !important;
            }
        }

        &__sale {
            vertical-align: middle;
            color: #fff;
            background-color: #000;
            border-radius: 50%;
            width: 33px;
            height: 33px;
            position: absolute;
            left: 1px;
            top: 0;
            display: flex;
            justify-content: center;
            align-items: center;

          & > span {
            font-weight: 400;
            font-size: 9px;
            line-height: 12px;
          }
        }

        &__image {
            width: 100%;
        }

        &__description {
            display: flex;
            flex-direction: column;
            row-gap: 10px;
            font-size: 10px;
            font-weight: 400;
            line-height: 14px;


            &__text {
                min-height: 30px;
                font-weight: 700;

                &:hover {
                    cursor: pointer;
                }
            }

            &__price {
                font-style: normal;
                font-weight: 800;
                font-size: 18px;
                line-height: 25px;
            }
        }

        &__button {
            border-radius: 50px;
            width: 100px;
            height: 28px;
            text-transform: none;
            background-color: #2F7484 !important;

            &.v-btn--disabled {
                font-size: 11px !important;
            }
        }
    }
</style>
