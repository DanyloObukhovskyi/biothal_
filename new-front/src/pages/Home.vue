<template>
    <div class="home-wrapper">
        <agile autoplay :autoplaySpeed="5000" :navButtons="false" :speed="1000" :key="carousel.length">
            <div class="slide" v-for="(item, index) in carousel" :key="index">
                <img width="100%" :src="api + '/storage/img/carousel/' + item['name']"/>
            </div>
        </agile>
        <div>
            <ProductCardsSet v-if="!isMobile" title="Подарки и скидки" :product-data="productData" :isShowStock="true"/>
            <ProductCardsSetMobile v-if="isMobile" title="Подарки и скидки"
                                   :product-data="productData.slice(0, 4)"/>
        </div>

        <div class="category-card__wrapper">
            <div class="category-card__inner">
                <CategoryCard class="category-card__block"/>
                <CategoryCard class="category-card__block"/>
            </div>
        </div>

        <div class="gifts-and-discounts-content">
            <ProductCardsSet v-if="!isMobile" title="Бестселлеры" :product-data="best_seller"/>
            <ProductCardsSetMobile v-if="isMobile" title="Бестселлеры"
                                   :product-data="best_seller.slice(0, 4)"/>
        </div>
        <div class="description-biothal">
            <p class="main-title">Интернет-магазин Biothal</p>
            <div class="description-biothal__inner">
                <div v-if="isMobile" class="description-biothal__text">
                    <p>
                        Хоть раз открыв каталог интернет-магазина BIOTHAL уже не захочется тратить время на походы по
                        торговым центрам – каталог косметики и парфюмерии, представленный здесь, превосходит даже смелые
                        ожидания и удовлетворяет любые требования. Добавьте к этому понятный интерфейс, универсальную
                        систему поиска, возможность получить свой заказ на дом в удобное время и вы получите идеальный
                        ресурс, который постоянно совершенствуется уже 10 лет – с 2009 года.
                    </p>
                    <p @click="isShowDescription = true" v-show="!isShowDescription" style="font-weight: 700">
                        Читать далее
                    </p>
                </div>
                <div v-show="!isMobile || isShowDescription" class="description-biothal__text"
                     style="padding-right: 30px">
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
                </div>
                <div v-show="!isMobile || isShowDescription" class="description-biothal__text">
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
                <div v-if="isMobile" class="description-biothal__text">
                    <p @click="isShowDescription = false" v-show="isShowDescription" style="font-weight: 700">
                        Показать меньше
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { VueAgile } from 'vue-agile';
    import ProductCard from "../components/desktop/productCards/ProductCard";
    import CategoryCard from "../components/CategoryCard";
    import ProductCardsSet from "../components/desktop/ProductCardsSetDesktop";
    import ProductCardsSetMobile from "../components/mobile/ProductCardsSetMobile";

    export default {
        name: "Home",
        components: {
            agile: VueAgile,
            ProductCard,
            CategoryCard,
            ProductCardsSet,
            ProductCardsSetMobile
        },
        data() {
            return {
                best_seller: [],
                productData: [],
                carousel: [],
                isShowDescription: false
            }
        },
        mounted() {
            this.getProductData();
        },
        methods: {
            async getProductData() {
                let data = await this.axios.get('home');

                this.carousel = data.data.carousel;
                this.productData = data.data.products.data;
                this.best_seller = data.data.best_seller.data;
            }
        }
    }
</script>

<style scoped lang="scss">

    .category-card {
        &__wrapper {
            display: flex;
            flex-direction: row;
            width: 100%;
            justify-content: center;
        }

        &__inner {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: 90%;
            @media screen and (max-width: 600px) {
                flex-direction: column;
                row-gap: 20px
            }
        }

        &__block {
            width: 49%;
            height: 160px;
            @media screen and (max-width: 600px) {
                width: 100%;
            }
        }
    }

    .slider-wrapper {
        width: 100%;
    }

    .home-wrapper {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .description-biothal {
        text-align: center;
        padding: 20px 20px 20px 20px;
        background-color: #F7F7F7;

        &__text {
            width: 50%;
            font-weight: 200;
            font-size: 14px;
            text-align: left;

            @media screen and (max-width: 600px) {
                width: 100%;
            }
        }

        &__inner {
            display: flex;
            flex-direction: row;
            width: 100%;

            @media screen and (max-width: 600px) {
                flex-direction: column;
            }
        }
    }

    .container {
        display: flex;
        flex-direction: row;
        justify-content: center;
    }
</style>
