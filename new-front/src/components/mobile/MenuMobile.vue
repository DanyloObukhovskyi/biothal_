<template>
  <div class="menu-wrapper">
    <v-app-bar app height="75" style="width: 100%; padding-left: 20px; padding-right: 20px" color="#fff"
               ref="app-bar">
      <v-app-bar-nav-icon @click.stop="menuVisible = !menuVisible"></v-app-bar-nav-icon>
      <v-toolbar-title class="main-toolbar-title" @click="toPage({name: 'home'})">
        <img width="108" height="32" src="../../../public/logo-biothal.svg"/>
      </v-toolbar-title>
      <div class="app-bar-menu-icon">
        <v-icon color="#000" size="18"
                @click="$refs['AccountMenuMobile'].visible = true">
          mdi-account-outline
        </v-icon>

        <v-badge
          v-if="products.length > 0"
          color="black"
          :content="products.length">

          <v-icon color="#000" size="18" @click="$refs['Basket'].visibleModal(true)">
            mdi-briefcase-outline
          </v-icon>

        </v-badge>

        <v-icon v-else color="#000" size="18" @click="$refs['Basket'].visibleModal(true)">
          mdi-briefcase-outline
        </v-icon>
      </div>
    </v-app-bar>

    <v-navigation-drawer
      style="height: auto"
      app
      v-model="menuVisible"
      absolute
      clipped
      width="100%">
      <div :style="`height: ${marginTopNavigation}`"/>
      <v-expansion-panels accordion>
        <v-expansion-panel
          v-for="(item,index) in menuItemsCategory"
          :key="index"
          :readonly="item.children ? !item.children.length : true">
          <v-expansion-panel-header
            :expand-icon="showIconItemMenu(item)">
                        <span @click="toPage({name: 'category-page', params:{ category: item.slug }} )">
                            {{ item.title }}
                        </span>
          </v-expansion-panel-header>
          <v-expansion-panel-content class="inner-list">
            <v-divider/>
            <v-expansion-panels v-if="item.children ? item.children.length : false" accordion>
              <v-expansion-panel
                readonly
                v-for="(item,index) in item.children"
                :key="index">
                <v-expansion-panel-header
                  @click="toPage({name: 'sub-category-page', params:{ category: item.category.slug, subCategory: item.slug }} )"
                  expand-icon="">
                  - {{ item.title }}
                </v-expansion-panel-header>
              </v-expansion-panel>
            </v-expansion-panels>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>


      <v-expansion-panels accordion>
        <v-expansion-panel
          v-for="(item,index) in menuItemsInfoPage"
          :key="index"
          :readonly="item.children_article ? !item.children_article.length : true">
          <v-expansion-panel-header
            :expand-icon="showIconItemInfoPageMenu(item)">
                        <span @click="toPage({name: 'info-page', params:{ id: item.slug }} )">
                            {{ item.title }}
                        </span>
          </v-expansion-panel-header>
          <v-expansion-panel-content class="inner-list">
            <v-divider/>
            <v-expansion-panels v-if="item.children_article ? item.children_article.length : false" accordion>
              <v-expansion-panel
                readonly
                v-for="(item,index) in item.children_article"
                :key="index">
                <v-expansion-panel-header
                  @click="toPage({name: 'info-page', params:{ id: item.attribute.slug }} )"
                  expand-icon="">
                  - {{ item.attribute.title }}
                </v-expansion-panel-header>
              </v-expansion-panel>
            </v-expansion-panels>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
      <v-expansion-panels accordion>
        <v-expansion-panel
            readonly>
            <v-expansion-panel-header
                expand-icon="">
                <span @click="toPage({name: 'distributor'} )">
                   Стать дистрибьютором
                </span>
            </v-expansion-panel-header>
        </v-expansion-panel>
    </v-expansion-panels>
    </v-navigation-drawer>

    <AccountMenuMobile ref="AccountMenuMobile"/>
    <Basket ref="Basket"/>
  </div>
</template>

<script>
import Basket from "../Basket";
import AccountMenuMobile from "./AccountMenuMobile";
import {mapGetters} from "vuex";

export default {
  name: "MenuMobile",
  components: {
    Basket,
    AccountMenuMobile
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
  data() {
    return {
      value: null,
      menuVisible: false,
      menuItemsCategory: [],
      menuItemsInfoPage: [],
      marginTopNavigation: 0,
    }
  },
  mounted() {
    this.fetchMenuData();
    this.marginTopNavigation = this.$refs['app-bar']?.styles.height

    const _this = this;
    const onScroll = function(){
      return _this.marginTopNavigation = (+document.scrollingElement.scrollTop) + (+_this.$refs['app-bar']?.height) + 'px'
    };
    onScroll();
    document.addEventListener('scroll', onScroll);
    this.$on('hook:beforeDestroy', () => document.removeEventListener('scroll', onScroll));
  },
  methods: {
    showIconItemMenu(item) {
      return item.children ? item.children.length ? 'east' : '' : 'east'
    },
    showIconItemInfoPageMenu(item) {
      return item.children_article ? item.children_article.length ? 'east' : '' : 'east'
    },
    async fetchMenuData() {
      let data = await this.axios.get('menu');

      this.menuItemsCategory = data.data.categories;
      this.menuItemsInfoPage = data.data.info_categories;
    }
  }
}
</script>

<style scoped lang="scss">


.app-bar-menu-icon {
  display: flex;
  column-gap: 6px;
}


</style>

<style lang="scss">

.inner-list {
  & .v-expansion-panel-content__wrap {
    padding: 0;
  }

  & .v-expansion-panel:before {
    box-shadow: none !important;
  }

  & .v-expansion-panel-header {
    padding-left: 55px;
  }
}
</style>

<style lang="scss" scoped>

.main-toolbar-title {
  padding: 0 !important;
}

</style>
