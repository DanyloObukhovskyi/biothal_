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
            <div style="padding: 35px; text-align: center; word-break: break-all">
                <h2>ВСЕ ПОТРЕБНОСТИ {{mb_strtoupper(($this_accessory['title']))}}</h2>
            </div>
    <div class="container">
        <div class="row justify-content-center" style="vertical-align: middle">
            @foreach($accessoryParentProducts as $products)
              <div class="col-md-4 col-sm-12" style="width: auto">
                  {{mb_strtoupper('Потребность'.' '.($products['title']))}}
                  @foreach($products['products'] as $value)
                      <div class="col-md-4 col-sm-12" style="margin-bottom: 20px">
                          <div class="card text-center" style="width: 9rem;">
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

    <div class="row" style="height: 80px; background-color: #2f7484;">
        <div class="col-md-2"></div>
        <div class="hut col-md-4">Узнавайте первыми о распродажах и новинках!</div>
        <div class="hut col-md-4">Электронный адрес</div>
        <div class="col-md-2"></div>
    </div>
    @include('layouts.footer')

@endsection

