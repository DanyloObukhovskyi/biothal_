<template>
    <div>
        <agile autoplay :autoplaySpeed="5000" :navButtons="false" :speed="1000" :key="carousel.length">
            <div class="slide" v-for="(item, index) in carousel" :key="index">
                <img width="100%" :src="api + '/storage/img/carousel/' + item['name']"/>
            </div>
        </agile>
        <ProductsPaginate ref="productsPaginate" :title="categoryTitle" :is-empty-message="categoryMessage" :url="productsUrl"/>
        <div class="main-title seo-text-title">{{seoText}}</div>
        <div class="seo-text-description">
            <p>
                Хоть раз открыв каталог интернет-магазина BIOTHAL уже не захочется тратить время на походы по
                торговым центрам – каталог косметики и парфюмерии, представленный здесь, превосходит даже смелые
                ожидания и удовлетворяет любые требования. Добавьте к этому понятный интерфейс, универсальную
                систему поиска, возможность получить свой заказ на дом в удобное время и вы получите идеальный
                ресурс, который постоянно совершенствуется уже 10 лет – с 2009 года.
            </p>

            <p>Во Франции, на севере Бретани, находится заповедная территория, дикая и нетронутая природа,
                крупнейшая долина и историческое место сбора водорослей в Европе.</p>

            <p>На протяжении многих лет здесь производят косметику на основе морских ингредиентов.</p>

            <p>Именно здесь Специалисты компании Biothal в тесном сотрудничестве с известными микробиологами и
                альгологами разрабатывают уникальные формулы продуктов являющихся бесспорным лидером в области
                Спа
                услуг, ухода за кожей лица и тела. Успешное сочетание натуральных ингредиентов с современными
                технологиями позволило нам создать уникальные средства для продления молодости кожи с
                максимальным
                терапевтическим эффектом</p>

            <p>Каждый продукт Biothal представляет собой настоящий эликсир красоты и молодости, концентрат
                морской
                силы, который работает в абсолютной синергии с кожей и соответствует самым высоким мировым
                стандартам качества. Тысячи женщин уже оценили профессиональный подход марки и высокую
                эффективность
                продуктов Biothal.</p>

            <p>Водоросли - источник жизни и целебных свойств известный с древних времен, они концентрируют в
                себе
                все богатство морской воды: йод, магний, калий, железо, селен, цинк, медь, витамины и
                аминокислоты,
                передавая им свою силу детоксикации, минерализации и регенерации.</p>

            <p>Бурая водоросль ламинария, произрастающая в морских водах, обладает целым комплексом минералов и
                активных элементов, необходимых нашей коже. Экстракт ламинарии регулирует работу сальных желёз,
                способствует выводу лишней жидкости, а также оказывают дезинфицирующее действие, убивая
                болезнетворные бактерии.</p>

            <p>Высокое содержание йода способствует нормализации функции щитовидной железы, активизирует все
                виды
                обмена веществ, нормализует обмен жиров и способствует липолизу, повышает потребление кислорода
                клетками, снижает вязкость крови, повышает тонус сосудов.</p>

            <p>Экстракт морской водоросли фукус обладает целым комплексом полезных веществ, которые укрепляют и
                тонизируют кожу. Концентрат полезных элементов, содержащийся в водоросли, способствует
                регенерации
                клеток кожи за счёт стимуляции кровообращения. Фукус имеет высокое содержание йода, также
                витамин С
                и полисахариды. Его свойства благотворно влияют на кожу, восстанавливая эластичность и создавая
                защитную плёнку.</p>

            <p>Фукус содержит вещества полифенолы, обладающие антисептическим и дезинфицирующим действием.
                Водоросль высоко ценится как источник тонизирующих жиросжигающих соединений. Применяется в
                детокс-программах, обладая антицеллюлитным и тонизирующим действием.</p>

            <p>Морской латук произрастает на солнечных скалах, найти его можно на различных глубинах. Растение
                предпочитает спокойные воды на побережье Атлантического океана, в Черном море и в Тихом океане.
                Ярко-зеленую морскую водоросль морской латук, растущую на скалах, собирают только во время
                отлива.
                Растение пропускает через себя морскую воду, оставляя только самые полезные минералы и
                микроэлементы. Растет в мелководных районах, богатых минералами. В составе водоросли содержится
                большой процент магния. Также витамины Е и С. Морской латук богат кальцием, железом и
                магнием.</p>

            <p>Насыщенная хлорофиллом зеленая водоросль, действующая как увлажняющий и противовоспалительный
                компонент. Экстракт оказывает на кожу омолаживающее воздействие, придаёт эластичность и выводит
                токсины.</p>
        </div>
        <ProductCardsSetDesktop v-if="!isMobile" :title="categoryDetails.title" :message="categoryMessage" :product-data="productData"/>
        <ProductCardsSetMobile v-if="isMobile" :title="categoryDetails.title" :message="categoryMessage"
                               :product-data="productData.slice(0, 4).concat(productData.slice(8, 12))"/>
        <div class="main-title seo-text-title">{{categoryDetails.seo_title}}</div>
        <div class="seo-text-description" v-html="categoryDetails.seo_description"></div>
    </div>
</template>

<script>
    import ProductCardsSetDesktop from "../components/desktop/ProductCardsSetDesktop";
    import ProductCardsSetMobile from "../components/mobile/ProductCardsSetMobile";
    import ProductsPaginate from "@/components/ProductsPaginate";

    export default {
        name: "CategoryPage",
        components: {
            ProductsPaginate,
            ProductCardsSetDesktop,
            ProductCardsSetMobile
        },
        metaInfo() {
            return {
                title: this.categoryDetails.seo_title,
                meta: [
                    { vmid: 'description', name: 'description', content: this.categoryDetails.seo_description },
                    { vmid: 'slug', name: 'slug', content: this.categoryDetails.slug }
                ]
            }
        },
        prop: {
            category: {
                type: [Number, String],
                default: 0
            },
            subCategory: {
                type: [Number, String],
                default: 0
            },
        },
        data() {
            return {
                carousel: [],
                productData: [],
                categoryDetails: [],
                // categoryMessage: ''
                categoryTitle: '',
                categoryMessage: 'В данной категории нет товаров.',
                seoText: 'SEO-ТЕКСТ ДЛЯ КАТЕГОРИИ',
                productsUrl: null,
            }
        },
        computed: {
            route() {
                return this.$route.params;
            }
        },
        created() {
            this.productsUrl = (!this.$route.params.subCategory) ? 'category/products/' + this.$route.params.category : 'category/products/' + this.$route.params.category + '/' +  this.$route.params.subCategory;

            this.fetchCategory();
        },
        watch: {
            route: {
                deep: true,
                handler (newRoute, oldRoute) {
                    this.fetchCategory();

                    this.productsUrl = (!newRoute.subCategory) ? 'category/products/' + newRoute.category : 'category/products/' + newRoute.category + '/' +  newRoute.subCategory;
                },
            },
            productsUrl(val) {
                setTimeout(() => {
                    this.$refs.productsPaginate.getProducts();
                }, 1)
            }
        },
        methods: {
            async fetchCategory() {
                let url = (!this.$route.params.subCategory) ? 'category/' + this.$route.params.category : 'category/' + this.$route.params.category + '/' +  this.$route.params.subCategory;

                let data = await this.axios.get(url);

                this.carousel = data.data.carousel;
                this.categoryTitle =  data.data.this_category.title;
                this.productData = data.data.products.data;
                this.categoryMessage = this.productData.length ? '' :  'В данной категории нет товаров.';
                this.categoryDetails =  data.data.this_category;
            }
        }
    }
</script>

<style scoped lang="scss">

    .seo-text-description {
        padding: 20px;
        column-count: 2;
        column-gap: 30px;

        @media screen and (max-width: 600px) {
            column-count: 1;
        }
    }
</style>
