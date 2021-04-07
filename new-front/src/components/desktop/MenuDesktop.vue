<template>
  <div class="menu-wrapper">
    <v-system-bar class="menu-wrapper__system-bar default-cursor">
      <div>Бесплатная доставка от <span style="font-weight: 700">1500 грн</span></div>
      <div><img width="18" height="18" src="../../../public/package.svg"/></div>
    </v-system-bar>
    <v-app-bar class="menu-wrapper__menu">
      <img class="menu-wrapper__logo point-cursor" @click="toPage({name: 'home'})" src="../../../public/logo.svg"/>
      <div class="app-bar-menu-wrapper">
        <v-slide-group
          multiple
          show-arrows>
          <v-slide-item v-for="(item, index) in menuItemsCategory" :key="item.id">
            <v-menu v-if="item.children.length" open-on-hover offset-y>
              <template v-slot:activator="{ on, attrs, value }">
                <v-btn
                  v-bind="attrs"
                  v-on="on"
                  plain
                  @click="toPage({name: 'category-page', params:{ category: item.slug }})">
                  <span class="bar-menu__category">{{ item.title }}</span>
                  <v-icon>
                    {{ value ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}
                  </v-icon>
                </v-btn>
              </template>
              <v-list class="bar-menu__wrapper">
                <v-list-item
                  class="point-cursor bar-menu__sub-category"
                  v-for="(item, index) in item.children"
                  :key="index"
                  @click="toPage({name: 'sub-category-page', params:{ category: item.category.slug, subCategory: item.slug }})">
                  <v-list-item-title class="bar-menu__sub-category-title">
                    - {{ item.title }}
                  </v-list-item-title>
                </v-list-item>
              </v-list>
            </v-menu>
            <v-btn v-else @click="toPage({name: 'category-page', params:{ category: item.slug }})" plain>
              <span class="bar-menu__category">{{ item.title}}</span>
            </v-btn>
          </v-slide-item>
          <v-slide-item v-for="(itemInfoPage, indexInfoPage) in menuItemsInfoPage" :key="itemInfoPage.id">
            <v-menu v-if="itemInfoPage.children_article.length !== 0" open-on-hover offset-y>
              <template v-slot:activator="{ on, attrs, value }">
                <v-btn
                  v-bind="attrs"
                  v-on="on"
                  plain
                  @click="toPage({name: 'info-page', params:{ id: itemInfoPage.slug }})">
                  <span>{{ itemInfoPage.title }}</span>
                  <v-icon>
                    {{value ? 'keyboard_arrow_up' : 'keyboard_arrow_down'}}
                  </v-icon>
                </v-btn>
              </template>
              <v-list>
                <v-list-item
                  class="point-cursor"
                  v-for="(itemInfoPage, indexInfoPage) in itemInfoPage.children_article"
                  :key="indexInfoPage"
                  @click="toPage({name: 'info-page', params:{ id: itemInfoPage.attribute.slug }})">
                  <v-list-item-title>
                    {{ itemInfoPage.attribute.title }}
                  </v-list-item-title>
                </v-list-item>
              </v-list>
            </v-menu>
            <v-btn v-else @click="toPage({name: 'info-page', params:{ id: itemInfoPage.slug }})" plain>
              <span>{{ itemInfoPage.title}}</span>
            </v-btn>
          </v-slide-item>
        </v-slide-group>
      </div>
      <div class="app-bar-menu-icon">
        <v-menu offset-y>
          <template v-slot:activator="{ on, attrs, value }">
            <v-btn
              width="20"
              height="20"
              icon
              v-bind="attrs"
              v-on="on">
              <v-icon color="#000" size="18">mdi-account-outline</v-icon>
            </v-btn>
          </template>
          <v-list>
            <v-list-item
              class="point-cursor"
              v-for="(item, index) in accountMenuItems"
              :key="index"
              @click="item.click ? item.click() : toPage(item.meta.rout)">
              <v-list-item-title>
                {{ item.name }}
              </v-list-item-title>
            </v-list-item>
          </v-list>
        </v-menu>
        <v-icon color="#000" size="18" @click="toPage({name: 'favorites'})" v-if="isShowFavorite">
          mdi-heart-outline
        </v-icon>

        <v-icon color="#000" size="18" @click="$refs['Basket'].visibleModal(true)">
          mdi-briefcase-outline
        </v-icon>
        <v-badge
          v-if="products.length > 0"
          color="black"
          :content="products.length"
          overlap>
        </v-badge>
      </div>
    </v-app-bar>
    <Basket ref="Basket"/>
  </div>
</template>

<script>
  import Basket from "../Basket";
  import {mapGetters} from "vuex";

  export default {
    name: "MenuDesktop",
    components: {
      Basket
    },
    data() {
      return {
        menuItemsCategory: [],
        menuItemsInfoPage: [],
        orders: 0,
      }
    },
    computed: {
      ...mapGetters('basket', [
        'products'
      ]),
      accountMenuItems() {
        const isLogin = [
          {
            name: 'Войти',
            meta: {
              icon: 'login',
              rout: {name: 'authorization'}
            }
          },
          {
            name: 'Зарегистрироваться',
            meta: {
              icon: 'app_registration',
              rout: {name: 'registration'}
            }
          }
        ]

        const isLogout = [
          {
            name: 'Личный кабинет',
            meta: {
              icon: 'mode_edit_outline',
              rout: {name: 'account-settings'}
            }
          },
          {
            name: 'Выйти',
            meta: {
              icon: 'logout',
              rout: {name: 'home'}
            },
            click: this.logout
          }
        ]

        return this.isAuthorize ? isLogout : isLogin
      }
    },
    created() {
      this.fetchMenuData();
    },
    mounted() {
      this.test();
    },
    methods: {
      async fetchMenuData() {
        let data = await this.axios.get('menu');

        this.menuItemsCategory = data.data.categories;
        this.menuItemsInfoPage = data.data.info_categories;
      },
      test() {
        this.orders = this.$refs['Basket'].products.length
      }
    }
  }
</script>

<style scoped lang="scss">
  .menu-wrapper {
    &__system-bar {
      display: flex;
      justify-content: center;
      color: #fff;
      font-weight: normal;
      font-style: normal;
      font-size: 12px;
      line-height: 16px;
      column-gap: 5.5px;
      background-color: #000;
      height: 34px !important;
    }

    &__menu {
      height: 60px !important;
      width: 100%;
      padding: 0;
      background-color: #fff !important;
      box-shadow: 0px 0px 21px rgba(0, 0, 0, 0.05) !important;
    }

    &__logo {
      height: 38px;
      padding-left: 43px;
    }
  }

  .app-bar-menu-wrapper {
    display: flex;
    flex-direction: row;
    /*127px - width logo, 43px - padding left logo, 11px - padding icon, 18px - width icon, 43px - padding right icons*/
    width: calc(100% - 127px - 43px - 18px - 11px - 18px - 11px - 18px - 43px);
    justify-content: center;
  }

  .app-bar-menu-icon {
    padding-right: 43px;
    display: flex;
    flex-direction: row;
    column-gap: 11px;
    height: 21px;

    &:hover {
      cursor: pointer;
    }
  }

  .bar-menu {
    &__wrapper {
      padding: 0 0 6px 0 !important;
    }

    &__category {
      text-transform: none;
      font-style: normal;
      font-weight: 200;
      font-size: 13px;
      line-height: 18px;
    }

    &__sub-category {
      min-height: 24px;
      padding: 0;
      font-size: 12px;
      line-height: 24px;
    }

    &__sub-category-title {
      font-style: normal;
      font-weight: 200;
      font-size: 12px;
      line-height: 24px;
      padding: 0 54px 0 14px;
    }
  }
</style>

<style lang="scss">
  .menu-wrapper {
    & .v-toolbar__content {
      padding: 0 !important;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      width: 100%;
    }
  }

  .app-bar-menu-wrapper {
    & .v-btn__content {
      font-size: 13px;
      line-height: 18px;
      color: #000;
    }
  }

  .basket_lenght {
    margin: -2px;
  }
</style>
