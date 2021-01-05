@foreach($global_sale as $global_value)
@endforeach
<div class="modal-content">
    <div class="modal-header">

        <div class="table-container">
            <h5 class="modal-title" id="exampleModalLongTitle">
                Корзина (<span class="countAll-container">
                      @include('partials.part.partBasket')
                </span>)
            </h5>
        </div>

        <button type="button" class="close" style="margin-right: 5px" data-dismiss="modal"
                aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body" style="margin-right: 30px;">
        <div class="container">
            <input type="hidden" value="{{$sumAll_sale = ($global_value->sum_modal)-$sumAll}}">
            @if(empty($sumAll))
                <div style="margin-left: auto;margin-right: auto; margin-bottom: 15px">
                    Скидка {{$global_value->procent_modal.' %'}}
                    срабатывает от суммы {{$global_value->sum_modal.' '}}грн
                </div>
            @endif
            @if($sumAll_sale < $global_value->sum_modal && $sumAll_sale > 0)
                <div style="margin-left: auto;margin-right: auto; margin-bottom: 15px">Еще {{$sumAll_sale}}
                    грн и сработает скидка {{$global_value->procent_modal.' %'}}
                </div>
            @endif
            @if($sumAll_sale <= 0 )
                <div style="margin-left: auto;margin-right: auto; margin-bottom: 15px">Ваша
                    скидка {{$global_value->procent_modal.' %'}}</div>
            @endif
            <input type="hidden" class="progress-count">
            <div class="progress-bar">
                <div style="width: 0%"></div>
            </div>
            <div class="row justify-content-center table-container">
                @include('partials.part.partBasket2')
            </div>
            <div class="row">
                <div class="col-sm-12">
                    @if((!empty($sumAll)) && ($sumAll_sale > 0))
                        <div>Стоимость товаров: <span>{{$sumAll}} грн.</span></div>
                        <div>Стоимость доставки: <span>{{$delivery . ' '}}грн.</span></div>
                        <div>Итого к оплате: <b><span
                                    class="sumAll">{{$sumAll + $delivery . ' '}}</span></b>грн.
                        </div>

                    @elseif((!empty($sumAll)) && ($sumAll_sale <= 0))
                        <div>Стоимость товаров: <span>{{$sumAll/2}} грн.</span></div>
                        <div>Стоимость доставки: <span>{{$delivery . ' '}}грн.</span></div>
                        <div>Итого к оплате: <b><span class="sumAll">{{$sumAll/2 + $delivery . ' '}}</span></b>грн.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <a href="/setCheck">
                <button id="" type="submit" style="margin-top: 10px;" class="btn btn-myBuy">Оформить
                    заказ
                </button>
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 " style="text-align: center; margin-top: 20px; margin-bottom: 20px;">
                Рекомендуемые товары
            </div>
        </div>
        <div class="row">
            <div class="my_height" style="padding-right: 10px">
                @foreach($product_sale as $value)
                    <div style="margin-bottom: 20px">
                        @foreach($products as $val)
                            @if($val->id == $value->id)
                                <div class="text-center" style="max-width: 12rem;">
                                    <a href="product/{{$value->id}}">
                                        <img src="
                                                        @if(isset($value->getImage['name']))
                                        {{ Storage::url('/img/products/'.$value->getImage['name'])}}
                                        @endif                                         "
                                             class="img-fluid" alt="...">
                                    </a>
                                    @endif
                                    @endforeach
                                    <div class="card-body">
                                        <span class="card-title">{!!$value->name!!}</span>
                                        <p class="card-text"><b>{!!$value->price . ' '!!}грн.</b></p>
                                        <button id="btn-buyHome"
                                                style="width: auto; background-color: #2f7484; border-color: #2f7484"
                                                class="btn btn-success rounded-pill"
                                                value="{{$value->id}}">
                                            Добавить
                                        </button>
                                    </div>
                                </div>
                    </div>
                @endforeach
            </div>
            <div class="my_height2">
                @foreach($product_price as $value)
                    <div style="margin-bottom: 20px">
                        @foreach($products as $val)
                            @if($val->id == $value->id)
                                <div class="text-center" style="max-width: 12rem;">
                                    <a href="product/{{$value->id}}"><img class="img-fluid"
                                                                          @if(isset($value->getImage['name']))
                                                                          src="{{ Storage::url('/img/products/'.$value->getImage['name'])}}"></a>
                                    @endif
                                    @endif
                                    @endforeach
                                    <div class="card-body">
                                        <span>{!!$value->name!!}</span><br>
                                        <span
                                            style="color: red"><s>{!!$value->price . ' '!!}</s>грн.</span><br>
                                        <p><b>{!!$value->price_with_sale . ' '!!}грн.</b></p>
                                        <button id="btn-buyHome"
                                                style="width: auto; background-color: #2f7484; border-color: #2f7484"
                                                class="btn btn-success rounded-pill"
                                                value="{{$value->id}}">
                                            Добавить
                                        </button>
                                    </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
