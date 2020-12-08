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
                <img src="{{Storage::url('img/1.jpg')}}" height="400" class="d-block w-100"
                     alt="1" style="width:100%;">
            </div>
            <div class="carousel-item active">
                <img src="{{Storage::url('img/2.jpg')}}" height="400"
                     class="d-block w-100" alt="2" style="width:100%;">
            </div>
            <div class="carousel-item">
                <img src="{{Storage::url('img/3.jpg')}}" class="d-block w-100" height="400" alt="3"
                     style="width:100%;">
            </div>
            <div class="carousel-item">
                <img src="{{Storage::url('img/4.jpg')}}" class="d-block w-100" height="400" alt="4"
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

    <div class="content">
        <div class="col-sm-12">
            <br>
            <div class="row" id="advantages-list-front-items" style="">
                <div class="col-sm-4 amino-overlay-active">
                    <article class="item unit">
                        <div class="wrapper"><i class="fa fa-globe" aria-hidden="true"></i>
                            <div class="details"><h3 class="title" style="font-size: 19px; text-transform: none;">
                                    Доставка по всему миру.<br>По России от 4000Р БЕСПЛАТНО</h3></div>
                        </div>
                    </article>
                </div>
                <div class="col-sm-4">
                    <article class="item unit">
                        <div class="wrapper"><i class="fa fa-money" aria-hidden="true"></i>
                            <div class="details"><h3 class="title" style="font-size: 19px; text-transform: none;">
                                    Возврат средств по любой причине. <br>
                                    В течении 30 дней</h3></div>
                        </div>
                    </article>
                </div>
                <div class="col-sm-4">
                    <article class="item unit">
                        <div class="wrapper"><i class="fa fa-pagelines" aria-hidden="true"></i>
                            <div class="details"><h3 class="title" style="font-size: 19px; text-transform: none;">
                                    Водорослевый комплекс и до 99%
                                    натуральных ингредиентов в составе.</h3></div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-3"><img style="margin-bottom: 15px" src="{{Storage::url('img/face.jpg')}}"
                                               height="220"><h4>Уход за лицом</h4></div>
                    <div class="col-sm-3"><img style="margin-bottom: 15px" src="{{Storage::url('img/body.jpg')}}"
                                               height="220"><h4>Уход за телом</h4></div>
                    <div class="col-sm-3"><img style="margin-bottom: 15px" src="{{Storage::url('img/nabor.jpg')}}"
                                               height="220"><h4>Эффективные комплексы</h4></div>
                    <div class="col-sm-3"><img style="margin-bottom: 15px" src="{{Storage::url('img/shop.jpg')}}"
                                               height="220"><h4>Точки продаж</h4></div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12" style="background: #93cdf8; height: 50px"></div>
                </div>
            </div>
        </div>
        <div class="box-heading"><i><u>Бестселлеры</u></i></div>
    </div>

    {{--    <div class="container" id="app">--}}
    {{--        <Navbar></Navbar>--}}
    {{--    </div>--}}
    {{--    <div class="container">--}}
    {{--        <div class="row justify-content-center">--}}
    {{--            <div class="col-md-8">--}}
    {{--                <div class="card">--}}
    {{--                    --}}{{--                    <div class="card-header">{{ __('Dashboard') }}</div>--}}

    {{--                    <div class="card-body">--}}
    {{--                        @if (session('status'))--}}
    {{--                            <div class="alert alert-success" role="alert">--}}
    {{--                                {{ session('status') }}--}}
    {{--                            </div>--}}
    {{--                        @endif--}}

    {{--                        --}}{{--                        {{ __('You are logged in!') }}--}}
    {{--                    </div>--}}
    {{--                    @if(Auth::user())--}}
    {{--                        @if(Auth::user()->type == 'admin')--}}
    {{--                            <a href="{{route('admin.dashboard')}}"></a>--}}
    {{--                        @endif--}}
    {{--                    @endif--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    <script>--}}
    {{--        $(document).ready(function() {--}}
    {{--            $('#example').DataTable();--}}
    {{--        } );--}}
    {{--    </script>--}}

@endsection
