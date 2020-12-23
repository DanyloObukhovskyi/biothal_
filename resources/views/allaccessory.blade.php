@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    @include('layouts.carousel')
            <div style="padding: 35px; text-align: center; word-break: break-all">
                <h2>ВСЕ ПОТРЕБНОСТИ {{mb_strtoupper(($this_accessory['title']))}}</h2>
            </div>
            @foreach($accessoryParentProducts as $products)
                <div class="container">
                    <div class="row justify-content-center">
                <div style="text-align: center; margin-bottom: 10px">
                    <div style="">{{mb_strtoupper('Потребность'.' '.($products['title']))}}</div>
                    <div style="margin-left: 20px">
                        @foreach($products['products'] as $value)
                            <div class="card text-center" style="display:inline-flex; min-width: 9rem; margin-right: 20px; margin-bottom: 20px">
                                <a href="/product/{{$value->id}}"><img class="img-fluid card-img-top" src = "{{ asset('/img/'.$value->getImage['name'])}}"></a>
                                <div class="card-body">
                                    <h5 class="card-title">{!!$value->name!!}</h5>
                                    <p class="card-text"><s>{!!$value->price . ' '!!}</s>грн.</p>
                                    <p class="card-text"><b>{!!$value->price_with_sale . ' '!!}грн.</b></p>
                                    <button id="btn-buyHome" style="width: auto; background-color: #2f7484; border-color: #2f7484"
                                            class="btn btn-success rounded-pill" value="{{$value->id}}">Купить
                                    </button>
                                </div>
                            </div>
                    </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    <div class="container">
        <div class="row" style="text-align: justify">
            <div class="col-md-1"></div>
            <div class="col-md-1"></div>
        </div>
    </div>

    @include('layouts.footer')

@endsection

