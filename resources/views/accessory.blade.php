@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    @include('layouts.carousel')

        @if($products_count_accessories > 0)
            <div style="padding: 35px; text-align: center">
                <h2>
                    @foreach($accessoriesProducts as $products)
                        {{mb_strtoupper('Потребность'.' '.($products['title']))}}
                    @endforeach
                </h2>
            </div>
        @endif
    <div class="container">
        <div class="row justify-content-center">
            @foreach($accessoriesProducts as $products)
                @foreach($products['products'] as $value)
                    <div class="col-md-4 col-sm-12" style="margin-bottom: 20px">
                        <div class="card text-center" style="width: 18rem;">
                            <a href="/product/{{$value->id}}"><img class="img-fluid card-img-top" src = "{{ Storage::url('/img/products/'.$value->getImage['name'])}}"></a>
                            <div class="card-body">
                                <h5 class="card-title">{!!$value->name!!}</h5>
                                <p class="card-text"><s>{!!$value->price . ' '!!}</s>грн.</p>
                                <p class="card-text"><b>{!!$value->price_with_sale . ' '!!}грн.</b></p>
                                <button id="btn-buyHome" style="width: 150px; background-color: #2f7484; border-color: #2f7484"
                                        class="btn btn-success rounded-pill btn-buy-item" value="{{$value->id}}">Купить
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

