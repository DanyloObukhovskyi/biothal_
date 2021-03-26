<template>
    <div>
        <div class="slider-wrapper" v-if="!isMobile">
            <img width="100%" src="../../../public/slider.svg"/>
        </div>
        <div class="info-page__title">
            {{article.title || 'Статья еще не была добавлена'}}
        </div>
        <div class="info-page__content__wrapper" v-html="article.description">
        </div>
    </div>
</template>

<script>
    export default {
        name: "InfoPage",
        data() {
            return {
                title: '',
                article: []
            }
        },
        computed: {
            route() {
                return this.$route.params;
            }
        },
        watch: {
            route: {
                deep: true,
                handler (newRoute, oldRoute) {
                    this.fetchInfoPage();
                },
            }
        },
        created() {
            this.fetchInfoPage();
        },
        methods: {
            async fetchInfoPage() {
                let data = await this.axios.get('info-page/' + this.$route.params.id);

                this.article =  data.data.article;
                this.title =  this.$route.params.id;
            }
        }
    }
</script>

<style scoped lang="scss">

    .info-page {
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
                padding: 0 45px 45px 45px;

                @media screen and (max-width: 600px) {
                    padding: 0 20px 20px 20px;
                }
            }
        }

        .slider-wrapper {
            width: 100%;
        }
    }
</style>
