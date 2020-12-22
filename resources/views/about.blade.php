@extends('layouts.app')

@section('content')
    @include('layouts.nav')

    <div>
        <img class="img-fluid myHeight d-block w-100" src="{{Storage::url('img/fil.jpg')}}" height="250" alt="1"
             style="width:100%;">
    </div>

    <div class="container">
        <div style="padding-top: 25px; text-align: center">
            <h2>ИНТЕРНЕТ-МАГАЗИН BIOTHAL</h2>
        </div>
        <div class="row" style="text-align: justify; padding: 10px">
            <div class="col-md-1"></div>
            <div style="padding: 10px;">
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
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
    </div>


    @include('layouts.footer')
@endsection

