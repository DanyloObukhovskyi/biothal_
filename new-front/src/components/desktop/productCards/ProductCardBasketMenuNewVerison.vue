<template>
  <div class="product-basket__wrapper">
    <img class="product-basket__image" height="150" width="150"
         :src="dataCard.image ? this.image_uri + dataCard.image.name : ''"
         :alt="dataCard.image ? dataCard.image.name : ''"/>
    <div class="product-basket__text">
      <div class="product-basket__text__title" @click="toPage({name: 'product', params: {id: dataCard.id}})">
        {{ dataCard.product_description.name }}
      </div>
      <div class="product-basket__position-bottom">
        <div class="product-basket__text__price">{{ isShowStock ? dataCard.price_with_sale : dataCard.price }} грн</div>
        <v-btn dark class="product__button" elevation="0" @click="addToCart">
          Добавить
        </v-btn>
      </div>
    </div>
  </div>
</template>

<script>

import {mapActions} from "vuex";

export default {
  name: "ProductCardBasketMenuNewVersion",
  props: {
    dataCard: {
      type: Object,
      default: () => {
      }
    },
    isShowStock: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    ...mapActions('basket', {
      addProduct: 'ADD_PRODUCT'
    }),
    addToCart() {
      const product = this.dataCard;
      product.quantity = (product.minimum !== 0) ? product.minimum : 1;

      this.addProduct(product)
    },
  }
}
</script>

<style scoped lang="scss">

.product-basket {

  &__wrapper {
    display: flex;
    text-align: center;
    flex-direction: column;
    align-items: center;
    width: 160px;
    background-color: white;

    &:hover {
      box-shadow: 0 0 33px #f2f2f2;
    }
  }

  &__image {
    max-width: 100%;
  }

  &__text {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    font-size: 11px;
    align-items: center;
    height: 100%;
    padding: 7px 11px 11px 11px;

    &__title {
      font-weight: 400;
      font-size: 12px;
      line-height: 16px;
      display: flex;
      align-items: center;
      height: 100%;
    }

    &__price {
      font-weight: 700;
      font-size: 13px;
      line-height: 18px;
      margin-top: 3px;
    }

    &__delete-basket {
      color: #C2C2C2;

      &:hover {
        cursor: pointer;
        text-decoration: underline;
      }
    }
  }
}

input[type=number] {
  &::-webkit-inner-spin-button {
    -webkit-appearance: none;
  }

  text-align: center;
}

.main-icon-btn {
  &:hover {
    cursor: pointer;
  }
}

.product__button {
  border-radius: 50px;
  height: 28px !important;
  background-color: #2F7484 !important;
  text-transform: none !important;

  font-weight: 700;
  font-size: 11px;
  line-height: 15px;
  width: 100px;

  margin-top: 7px;
}
</style>
