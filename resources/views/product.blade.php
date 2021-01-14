@extends('layouts.app')

@section('content')
    @include('layouts.nav')

    <div style="padding: 35px">
        {{--        --}}
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @foreach($products as $value)
                    @if($value['id'] == $id)
                        @if(isset($value->getImage['name']))
                        <div class="card text-center" style="width: 18rem; margin-left: auto; margin-right: auto">
                            <img class="img-fluid card-img-top" src="{{ Storage::url('/img/products/'.$value->getImage['name'])}}">
                        </div>
                        @endif
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h5 class="card-title">{!!$value->name!!}</h5>
{{--                    <div class="rating-mini">--}}
{{--                        <span class="active"></span>--}}
{{--                        <span class="active"></span>--}}
{{--                        <span class="active"></span>--}}
{{--                        <span class="active"></span>--}}
{{--                        <span></span>--}}
{{--                        7 отзывов--}}
{{--                    </div>--}}
                    <p class="card-title">{!!$value->meta_keywords!!}</p>
                    <div class="row">
                        <h4 style="margin-right: 0px; margin-left: 15px; margin-bottom: 0"><b>{!!$value->price_with_sale!!} грн</b></h4>
                        <p style="margin-left: 15px; margin-bottom: 0; margin-top:3px"><s>{!!$value->price!!}</s> грн</p>
                    </div>
                    <span style="font-size: 11px; margin-top: 0px; color:#87c8d7">В наличии</span>
                    <p>Количество</p>
                    <div class="amount">
                        <span class="down">-</span>
                        <input id="count_products" type="text" style="width: 40px; border-color: transparent" min="1" value="1"/>
                        <span class="plus up">+</span>
                    </div>
                    <button id="btn-buy" type="submit" class="btn btn-myBuy">Купить</button>
                    <input href="#" class="btn btn-myCall" placeholder="+38(___) ___ - __ - __"/>
                    <a class="add_click col-sm-1">Оформить товар в 1 клик</a>
                    <input type="hidden" id="product_id" value="{{$value->id}}" />
                </div>
            </div>
            @endif
            @endforeach
        </div>
        <div class="row" style="margin-top: 40px">
            <div class="col-sm-2"></div>
            <div class="col-sm-2">
                <button type="button" style="color: #000000" class="btn btn-link tablinks"
                        onclick="openTabs(event, 'desc')">Описание
                </button>
            </div>
            <div id="" class="col-sm-2">
                <button type="button" style="color: #000000" class="btn btn-link tablinks"
                        onclick="openTabs(event, 'composition')">Состав
                </button>
            </div>
            <div id="" class="col-sm-2">
                <button type="button" style="color: #000000" class="btn btn-link tablinks"
                        onclick="openTabs(event, 'application')">Применение
                </button>
            </div>
            <div id="" class="col-sm-2">
                <button type="button" style="color: #000000" class="btn btn-link tablinks"
                        onclick="openTabs(event, 'reviews')">Отзывы
                </button>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <div class="row" style="margin-top: 20px">
        </div>
    </div>
    <div class="container">
        @foreach($products as $value)
            @if($value['id'] == $id)
                <div id="desc" class="tabcontent">
                    <p>{!!$value->description!!}</p>
                </div>
                <div id="composition" class="tabcontent">
                    <p>{!!$value->composition!!}</p>
                </div>
                <div id="application" class="tabcontent">
                    <p>{!!$value->meta_description!!}</p>
                </div>
                <div id="reviews" class="tabcontent">
                    <p>Здесь будут отзывы</p>
                </div>
            @endif
        @endforeach
    </div>

    @include('layouts.footer')
@endsection

