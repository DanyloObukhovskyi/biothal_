<template>
    <div>
        <agile class="agile-slider" autoplay :autoplaySpeed="5000" :navButtons="false" :speed="1000" :key="carousel.length">
            <div class="slide" v-for="(item, index) in carousel" :key="index">
                <img width="100%" :src="api + '/storage/img/carousel/' + item['name']"/>
            </div>
        </agile>
        <div class="info-page__title">
            {{article.title || 'Статья еще не добавлена'}}
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
                article: [],
                carousel: []
            }
        },
        metaInfo() {
            return {
                title: this.article.meta_title,
                meta: [
                    { vmid: 'description', name: 'description', content: this.article.meta_description },
                    { vmid: 'keywords', name: 'keywords', content: this.article.meta_keywords },
                    { vmid: 'slug', name: 'slug', content: this.article.slug }
                ]
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
                this.carousel = data.data.carousel;
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
            margin: 50px 50px 0 50px;

            @media screen and (max-width: 600px) {
                margin: 20px;
            }
        }

        &__content {
            &__wrapper {
                max-width: 100%;
                padding: 0 45px 45px 45px !important;

                @media screen and (max-width: 600px) {
                    padding: 0 20px 20px 20px !important;
                }
            }
        }
    }

    .agile-slider {
        padding: 0 !important;
    }
</style>
