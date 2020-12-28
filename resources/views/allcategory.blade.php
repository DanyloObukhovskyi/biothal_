@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    @include('layouts.carousel')

    <div style="padding: 35px; text-align: center">
        <h2>ВСЕ КАТЕГОРИИ {{mb_strtoupper(($this_category['title']))}}</h2>
    </div>
    <div class="container">
    @foreach($categoryParentProducts as $products)
             <div>
                <div class="row justify-content-center">
                    {{mb_strtoupper('Категория'.' '.($products['title']))}}
                </div>
                    @foreach($products['products'] as $value)
                        <div class="card text-center"
                             style="display:inline-block; width: 17rem; margin: 1.5em 1.5em 1.5em 1em">
                            <a href="/product/{{$value->id}}"><img class="img-fluid" style="width: 9em"
                                                                   src="{{ Storage::url('/img/products/'.$value->getImage['name'])}}"></a>
                            <div class="card-body" style="display: block">
                                <h5 class="card-title">{!!$value->name!!}</h5>
                                <p class="card-text"><s>{!!$value->price . ' '!!}</s>грн.</p>
                                <p class="card-text"><b>{!!$value->price_with_sale . ' '!!}грн.</b></p>
                                <button id="btn-buyHome"
                                        style="min-width: 7em; background-color: #2f7484; border-color: #2f7484"
                                        class="btn btn-success rounded-pill" value="{{$value->id}}">Купить
                                </button>
                            </div>
                        </div>
                @endforeach
            </div>
            @endforeach
        </div>

        <div class="container">
            <div class="row" style="text-align: justify">
                <div class="col-md-1"></div>
                <div class="col-md-1"></div>
            </div>
        </div>

        @include('layouts.footer')

@endsection

