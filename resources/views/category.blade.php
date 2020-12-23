@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    @include('layouts.carousel')

        @if($products_count > 0)
            <div style="padding: 25px; text-align: center">
                <h2>
                    @foreach($categoriesProducts as $products)
                        {{mb_strtoupper('Категория'.' '.($products['title']))}}
                    @endforeach
                </h2>
            </div>
        @endif
    <div class="container">
        <div class="row justify-content-center">
            @foreach($categoriesProducts as $products)
                @foreach($products['products'] as $value)
                    <div class="col-md-4 col-sm-12" style="margin-left: 20px; margin-right: 20px; margin-bottom: 20px;">
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
                @endforeach
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

