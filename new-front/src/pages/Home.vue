<template>
    <div class="home-wrapper">
        <div class="slider-wrapper">
            <img width="100%" src="../../public/slider.svg"/>
        </div>
        <div class="gifts-and-discounts-content">
            <div class="gifts-and-discounts-wrapper">
                <div class="main-title">Подарки и скидки</div>
                <div class="gifts-and-discounts-wrapper__product">
                    <ProductCard class="product-card" v-for="item in productData" :key="item.id" :data-card="item" :is-show-stock="true"/>
                </div>
            </div>
        </div>
        <div style="display: flex; flex-direction: row; width: 100%; justify-content: center">
            <div style="display: flex;flex-direction: row; justify-content: space-between; width: 90%">
                <CategoryCard style="width: 49%"/>
                <CategoryCard style="width: 49%"/>
            </div>
        </div>
        <div class="gifts-and-discounts-content">
            <div class="gifts-and-discounts-wrapper">
                <div class="main-title">Бестселлеры</div>
                <div class="gifts-and-discounts-wrapper__product">
                    <ProductCard class="product-card" v-for="item in productData" :key="item.id" :data-card="item"/>
                </div>
            </div>
        </div>
        <div class="description-biothal">
            <div class="main-title">Интернет-магазин Biothal</div>
            <div style="display: flex; flex-direction: row; width: 100%">
                <div class="description-biothal__text" style="padding-right: 30px">
                    <p>Во Франции, на севере Бретани, находится заповедная территория, дикая и нетронутая природа,
                        крупнейшая долина и историческое место сбора водорослей в Европе.</p>

                    <p>На протяжении многих лет здесь производят косметику на основе морских ингредиентов.</p>

                    <p>Именно здесь Специалисты компании Biothal в тесном сотрудничестве с известными микробиологами и
                    альгологами разрабатывают уникальные формулы продуктов являющихся бесспорным лидером в области Спа
                    услуг, ухода за кожей лица и тела. Успешное сочетание натуральных ингредиентов с современными
                    технологиями позволило нам создать уникальные средства для продления молодости кожи с максимальным
                        терапевтическим эффектом</p>

                    <p>Каждый продукт Biothal представляет собой настоящий эликсир красоты и молодости, концентрат морской
                    силы, который работает в абсолютной синергии с кожей и соответствует самым высоким мировым
                    стандартам качества. Тысячи женщин уже оценили профессиональный подход марки и высокую эффективность
                        продуктов Biothal.</p>

                    <p>Водоросли - источник жизни и целебных свойств известный с древних времен, они концентрируют в себе
                    все богатство морской воды: йод, магний, калий, железо, селен, цинк, медь, витамины и аминокислоты,
                        передавая им свою силу детоксикации, минерализации и регенерации.</p>

                    <p>Бурая водоросль ламинария, произрастающая в морских водах, обладает целым комплексом минералов и
                    активных элементов, необходимых нашей коже. Экстракт ламинарии регулирует работу сальных желёз,
                    способствует выводу лишней жидкости, а также оказывают дезинфицирующее действие, убивая
                        болезнетворные бактерии.</p>
                </div>
                <div class="description-biothal__text">
                    <p>Высокое содержание йода способствует нормализации функции щитовидной железы, активизирует все виды
                    обмена веществ, нормализует обмен жиров и способствует липолизу, повышает потребление кислорода
                        клетками, снижает вязкость крови, повышает тонус сосудов.</p>

                    <p>Экстракт морской водоросли фукус обладает целым комплексом полезных веществ, которые укрепляют и
                    тонизируют кожу. Концентрат полезных элементов, содержащийся в водоросли, способствует регенерации
                    клеток кожи за счёт стимуляции кровообращения. Фукус имеет высокое содержание йода, также витамин С
                    и полисахариды. Его свойства благотворно влияют на кожу, восстанавливая эластичность и создавая
                        защитную плёнку.</p>

                    <p>Фукус содержит вещества полифенолы, обладающие антисептическим и дезинфицирующим действием.
                    Водоросль высоко ценится как источник тонизирующих жиросжигающих соединений. Применяется в
                        детокс-программах, обладая антицеллюлитным и тонизирующим действием.</p>

                    <p>Морской латук произрастает на солнечных скалах, найти его можно на различных глубинах. Растение
                    предпочитает спокойные воды на побережье Атлантического океана, в Черном море и в Тихом океане.
                    Ярко-зеленую морскую водоросль морской латук, растущую на скалах, собирают только во время отлива.
                    Растение пропускает через себя морскую воду, оставляя только самые полезные минералы и
                    микроэлементы. Растет в мелководных районах, богатых минералами. В составе водоросли содержится
                        большой процент магния. Также витамины Е и С. Морской латук богат кальцием, железом и магнием.</p>

                    <p>Насыщенная хлорофиллом зеленая водоросль, действующая как увлажняющий и противовоспалительный
                    компонент. Экстракт оказывает на кожу омолаживающее воздействие, придаёт эластичность и выводит
                        токсины.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ProductCard from "../components/ProductCard";
    import CategoryCard from "../components/CategoryCard";

    export default {
        name: "Home",
        components: {
            ProductCard,
            CategoryCard
        },
        data() {
            return {
                productData: [
                    {
                        id: 1,
                        img: '../../../public/product-images/product-images.svg'
                    },
                    {
                        id: 2,
                        img: '../public/product-images/product-images.svg'
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
        }
    }
</script>

<style scoped lang="scss">
    .product-card {
        width: 30%;
    }

    .gifts-and-discounts-content {
        margin-bottom: 40px;
        display: flex;
        flex-direction: row;
        justify-content: center;
    }

    .gifts-and-discounts-wrapper {
        width: 90%;
        display: flex;
        flex-direction: column;
        text-align: center;

        &__product {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-around;
            row-gap: 40px;
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
        padding: 0 45px 45px 45px;

        &__text {
            width: 50%;
            font-weight: 200;
            font-size: 14px;
            text-align: left;
        }
    }










    .container {
        display: flex;
        flex-direction: row;
        justify-content: center;
    }

    .main-title {
        font-weight: 200;
        font-size: 34px;
        line-height: 46px;
        margin: 40px;
        text-transform: uppercase;
    }
</style>
