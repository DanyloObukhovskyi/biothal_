<template>
  <div class="product-card__wrapper">
    <div class="product-card__wrapper-content">
      <div class="product-card__title" v-if="isShowTitle">{{ title }}</div>

      <p v-if="isShowMessage && message">{{ message }}</p>

      <agile v-if="withSlider" :infinite="true" :key="productData.length" :slidesToShow="3" :autoplay="true"
             :autoplaySpeed="5000"
             :speed="1500" :navButtons="false" :pauseOnHover="true" :pauseOnDotsHover="true">

        <div class="slide" v-for="item in productData" :key="item.id">
            <ProductCard
              v-if="typeSet === 'product'"
              class="product-card__content"
              :data-card="item"
              :is-show-stock="item.sale_id !== null"/>
        </div>
      </agile>

      <div class="product-card__content" v-else-if="typeSet === 'product'">
            <ProductCard class="product-card__item-three"
                       v-for="item in productData"
                       :key="item.id"
                       :data-card="item"
                       :is-show-stock="item.sale_id !== null"/>
          </div>

      <div class="product-card__content" v-if="typeSet === 'basket'">
        <ProductCardBasket v-for="item in productData"
                           @delete="$emit('delete', item.id)"
                           :key="item.id"
                           :is-show-stock="item.sale_id !== null"
                           :data-card="item"/>
      </div>

      <div class="product-card__content" v-if="typeSet === 'basket-menu'">
        <ProductCardBasketMenu class="product-card__item-two"
                               v-for="item in productData"
                               :key="item.id"
                               :data-card="item"
                               :is-show-stock="item.sale_id !== null"/>
      </div>

    </div>
  </div>
</template>

<script>
import ProductCard from "./productCards/ProductCard";
import ProductCardBasket from "./productCards/ProductCardBasket";
import ProductCardBasketMenu from "./productCards/ProductCardBasketMenu";
import {VueAgile} from "vue-agile";

export default {
  name: "ProductCardsSetDesktop",
  components: {
    agile: VueAgile,
    ProductCard,
    ProductCardBasket,
    ProductCardBasketMenu
  },
  props: {
    isShowTitle: {
      type: Boolean,
      default: true
    },
    title: {
      type: String,
      default: ''
    },
    isShowMessage: {
      type: Boolean,
      default: true
    },
    message: {
      type: String,
      default: ''
    },
    typeSet: {
      type: String,
      default: 'product'
    },
    withSlider: {
      type: Boolean,
      default: false
    },
    productData: {
      type: Array
    },
    isShowStock: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {}
  },
  methods: {}
}
</script>

<style scoped lang="scss">
.product-card {

  &__wrapper {
    margin-bottom: 40px;
    display: flex;
    flex-direction: row;
    justify-content: center;
  }

  &__wrapper-content {
    width: 90%;
    display: flex;
    flex-direction: column;
    text-align: center;
  }

  &__title {
    text-align: center;
    font-weight: 200;
    font-size: 34px;
    line-height: 46px;
    margin: 40px;
    text-transform: uppercase;
  }

  &__content {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    row-gap: 40px;
    column-gap: 30px;
    align-items: flex-end;
  }

  &__item-three {
    width: 30%;
    display: inline-table;
    @media screen and (max-width: 991px) {
      width: 50%;
    }
  }

  &__item-two {
    width: 50%;
  }
}

.slide {

}
</style>
