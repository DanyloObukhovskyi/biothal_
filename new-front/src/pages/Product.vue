<template>
  <div class="base-page-wrapper product-wrapper">

    <div class="breadcrumb">
      Роут / Роут / Еще роут / Крем для твоего личика
    </div>

    <div class="block-product-base-info">
      <img :src="productData.find(e => e.id === product_id).img" alt="" class="block-product-base-info__image">

      <div class="block-product-base-info__info">
        <div class="info-title">
          <span class="info-title__title">Увлажняющая маска для лица Апельсин Бергамот</span>
          <span class="info-title__subtitle">Orange Bergamot Hydra Mask</span>
        </div>

        <div class="info-rating">
          <v-rating
            class="info-rating__rating"
            :color="variables.basecolor"
            background-color="#000"
            hover
            length="5"
            size="12.59"
            :value="5">
          </v-rating>
          <span class="info-rating__comment">5 отзывов</span>
        </div>

        <div class="info-price">
          <span class="info-price__price">633 грн</span>
          <span class="info-price__discount">1265 грн</span>
          <p class="info-price__in-stock">В наличии</p>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import variables from '@/styles/main.scss'


export default {
  name: "Product",
  props: {
    product_id: {
      type: [Number, String],
      default: 1
    },
  },
  computed: {
    name() {
      return this.data;
    }
  },
  data() {
    return {
      variables,
      productData: [
        {
          id: 1,
          img: 'public/product-images/product-images.svg'
        },
        {
          id: 2,
          img: '../../public/product-images/product-images.svg'
        },
        {
          id: 3,
          img: '../../public/product-images/product-images.svg'
        },
        {
          id: 4,
          img: '../../public/product-images/product-images.svg'
        },
        {
          id: 5,
          img: '../../public/product-images/product-images.svg'
        },
        {
          id: 6,
          img: '../../public/product-images/product-images.svg'
        }
      ]
    }
  },
}
</script>

<style lang="scss" scoped>

.block-product-base-info {
  width: 100%;
  display: flex;
  gap: 30px;

  &__image {
    width: 50%;
    height: 380px;
  }

  &__info {
    width: 50%;
    display: flex;
    flex-direction: column;
    row-gap: 9px;
  }
}

.info {

  &-title {
    display: flex;
    flex-direction: column;
    font-size: 18px;

    &__title {
      font-weight: 700;
    }

    &__subtitle {
    }

  }

  &-rating {
    display: flex;
    align-items: center;

    &__comment {
      font-size: 12px;
    }

  }

  &-price {

    &__price {
      font-weight: 800;
      font-size: 24px;
      line-height: 32px;
    }

    &__discount {
      margin-left: 5px;
      font-size: 15px;
      text-decoration: line-through;
    }

  }
}

</style>
