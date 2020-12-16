@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class=""></li>
            <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="2" class=""></li>
            <li data-target="#myCarousel" data-slide-to="3" class=""></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item">
                <img class="img-fluid" src="{{Storage::url('img/1.jpg')}}" height="400" class="d-block w-100"
                     alt="1" style="width:100%;">
            </div>
            <div class="carousel-item active">
                <img class="img-fluid" src="{{Storage::url('img/2.jpg')}}" height="400"
                     class="d-block w-100" alt="2" style="width:100%;">
            </div>
            <div class="carousel-item">
                <img class="img-fluid" src="{{Storage::url('img/3.jpg')}}" class="d-block w-100" height="400" alt="3"
                     style="width:100%;">
            </div>
            <div class="carousel-item">
                <img class="img-fluid" src="{{Storage::url('img/4.jpg')}}" class="d-block w-100" height="400" alt="4"
                     style="width:100%;">
            </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
        @if($count_sale_product > 0)
            <div style="padding: 35px; text-align: center">
                <h2>ПОДАРКИ И СКИДКИ</h2>
            </div>
        @endif
    <div class="container">
        <div class="row justify-content-center">
            @foreach($products as $value)
                @if($value['sale_id'] != null)
                    <div class="col-md-4 col-sm-12" style="margin-bottom: 20px">
                        <div class="card text-center" style="width: 18rem;">
                            <a href="/product/{{$value->id}}"><img class="img-fluid card-img-top" src = "{{ asset('/img/'.$value->getImage['name'])}}"></a>
                            <div class="card-body">
                                <h5 class="card-title">{!!$value->name!!}</h5>
                                <p class="card-text"><s>{!!$value->price . ' '!!}</s>грн.</p>
                                <p class="card-text"><b>{!!$value->price_with_sale . ' '!!}грн.</b></p>
                                <button id="btn-buyHome" style="width: 150px; background-color: #2f7484; border-color: #2f7484"
                                        class="btn btn-success rounded-pill" value="{{$value->id}}">Купить
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6"><img class="img-fluid" style="margin-top: 30px"
                                           src="{{Storage::url('img/lico.png')}}"
                                           height="250"></div>
                <div class="col-md-6"><img class="img-fluid" style="margin-top: 30px"
                                           src="{{Storage::url('img/telo.png')}}"
                                           height="250"></div>
            </div>
        </div>

        <div style="padding: 35px; text-align: center">
            <h2>БЕСТСЕЛЛЕРЫ</h2>
        </div>
        <div class="row">
            @foreach($products as $value)
                @if($value['sale_id'] == null)
                    <div class="col-md-4 col-sm-12" style="margin-bottom: 20px">
                        <div class="card text-center" style="">
                            <a href="product/{{$value->id}}"><img style="" src="{{ asset('/img/'.$value->getImage['name'])}}"
                                                                  class="card-img-top img-fluid"></a>
                            <div class="card-body">
                                <h5 class="card-title">{!!$value->name!!}</h5>
                                <p class="card-text"><b>{!!$value->price . ' '!!}грн.</b></p>
                                <button id="btn-buyHome" style="width: 150px; background-color: #2f7484; border-color: #2f7484"
                                        class="btn btn-success rounded-pill" value="{{$value->id}}">Купить
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div style="padding: 35px; text-align: center">
        <h2>ИНТЕРНЕТ-МАГАЗИН BIOTHAL</h2>
    </div>
    <div class="container">
        <div class="row" style="text-align: justify">
            <div class="col-md-1"></div>
            <div class="col-md-5" style="padding: 10px">
                <p>Во Франции, на севере Бретани, находится заповедная территория, дикая и нетронутая природа, крупнейшая
                    долина и историческое место сбора водорослей в Европе.</p>
                <p>На протяжении многих лет здесь производят косметику на основе морских ингредиентов.</p>
                <p>Именно здесь Специалисты компании Biothal в тесном сотрудничестве с известными микробиологами и
                    альгологами разрабатывают уникальные формулы продуктов являющихся бесспорным лидером в области Спа
                    услуг, ухода за кожей лица и тела. Успешное сочетание натуральных ингредиентов с современными
                    технологиями позволило нам создать уникальные средства для продления молодости кожи с максимальным
                    терапевтическим эффектом.</p>
                <p>Каждый продукт Biothal представляет собой настоящий эликсир красоты и молодости, концентрат морской силы,
                    который работает в абсолютной синергии с кожей и соответствует самым высоким мировым стандартам
                    качества. Тысячи женщин уже оценили профессиональный подход марки и высокую эффективность продуктов
                    Biothal.</p>
                <p>Водоросли - источник жизни и целебных свойств известный с древних времен, они концентрируют в себе все
                    богатство морской воды: йод, магний, калий, железо, селен, цинк, медь, витамины и аминокислоты,
                    передавая им свою силу детоксикации, минерализации и регенерации.</p>
                <p>Бурая водоросль ламинария, произрастающая в морских водах, обладает целым комплексом минералов и активных
                    элементов, необходимых нашей коже. Экстракт ламинарии регулирует работу сальных желёз, способствует
                    выводу лишней жидкости, а также оказывают дезинфицирующее действие, убивая болезнетворные бактерии.</p>
            </div>
            <div class="col-md-5">
                <p>Высокое содержание йода способствует нормализации функции щитовидной железы, активизирует все виды обмена
                    веществ, нормализует обмен жиров и способствует липолизу, повышает потребление кислорода клетками,
                    снижает вязкость крови, повышает тонус сосудов.</p>
                <p>Экстракт морской водоросли фукус обладает целым комплексом полезных веществ, которые укрепляют и
                    тонизируют кожу. Концентрат полезных элементов, содержащийся в водоросли, способствует регенерации
                    клеток кожи за счёт стимуляции кровообращения. Фукус имеет высокое содержание йода, также витамин С и
                    полисахариды. Его свойства благотворно влияют на кожу, восстанавливая эластичность и создавая защитную
                    плёнку.</p>
                <p>Фукус содержит вещества полифенолы, обладающие антисептическим и дезинфицирующим действием. Водоросль
                    высоко ценится как источник тонизирующих жиросжигающих соединений. Применяется в детокс-программах,
                    обладая антицеллюлитным и тонизирующим действием.
                <p>Морской латук произрастает на солнечных скалах, найти его можно на различных глубинах. Растение
                    предпочитает спокойные воды на побережье Атлантического океана, в Черном море и в Тихом океане.
                    Ярко-зеленую морскую водоросль морской латук, растущую на скалах, собирают только во время отлива.
                    Растение пропускает через себя морскую воду, оставляя только самые полезные минералы и микроэлементы.
                    Растет в мелководных районах, богатых минералами. В составе водоросли содержится большой процент магния.
                    Также витамины Е и С. Морской латук богат кальцием, железом и магнием.</p>
                <p>Насыщенная хлорофиллом зеленая водоросль, действующая как увлажняющий и противовоспалительный компонент.
                    Экстракт оказывает на кожу омолаживающее воздействие, придаёт эластичность и выводит токсины.</p>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

    <div class="row" style="height: 80px; background-color: #2f7484;">
        <div class="col-md-2"></div>
        <div class="hut col-md-4">Узнавайте первыми о распродажах и новинках!</div>
        <div class="hut col-md-4">Электронный адрес</div>
        <div class="col-md-2"></div>
    </div>
    @include('layouts.footer')

    {{--                    <div class="card-body">--}}
    {{--                        @if (session('status'))--}}
    {{--                            <div class="alert alert-success" role="alert">--}}
    {{--                                {{ session('status') }}--}}
    {{--                            </div>--}}
    {{--                        @endif--}}
    {{--                    </div>--}}
    {{--                    @if(Auth::user())--}}
    {{--                        @if(Auth::user()->type == 'admin')--}}
    {{--                            <a href="{{route('admin.dashboard')}}"></a>--}}
    {{--                        @endif--}}
    {{--                    @endif--}}
    {{--                </div>--}}
@endsection

