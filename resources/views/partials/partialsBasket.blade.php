<div class="modal-content table-container">
    <div class="modal-header">
        <div>
            <h5 class="modal-title" id="exampleModalLongTitle">
                Корзина (<span class="countAll-container">
                    {{$countAll}}
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
            <input type="hidden" value="{{$sumAll_sale}}">
            <input id="sumAll_not_sale" type="hidden" value="{{$sumAll_not_sale}}">
            <input id="sum_modal" type="hidden" value="{{$sum_modal}}">
            <input id="nova_poshta_price_delivery" type="hidden" value="{{env('NOVA_POSHTA_PRICE_DELIVERY')}}">
            @if(empty($sumAll))
                <div style="margin-left: auto;margin-right: auto; margin-bottom: 15px">
                    Скидка {{$procent_modal.' %'}}
                    срабатывает от суммы {{$sum_modal.' '}}грн
                </div>
            @endif
            @if($sumAll_sale < $sum_modal && $sumAll_sale > 0)
                <div class="sumAll_sale" style="margin-left: auto;margin-right: auto; margin-bottom: 15px">Еще <span class="sumAll_sale-container">{{$sumAll_sale}}</span>
                    грн и сработает скидка {{$procent_modal.' %'}}
                </div>
            @endif
            @if($sumAll_sale <= 0 )
                <div style="margin-left: auto;margin-right: auto; margin-bottom: 15px">Ваша
                    скидка {{$procent_modal.' %'}}</div>
            @endif
            <input type="hidden" class="progress-count">
            <div class="progress-bar">
                <div style="width: 0%"></div>
            </div>
            <div class="row justify-content-center">
                @foreach($cart_join as $cart)
                    <div class="col-6">
                        @foreach($products as $value)
                            @if($value->id == $cart->id)
                                @if(isset($value->getImage['name']))
                                    <img style="height: auto!important; padding: 10px" class="img-fluid"
                                         src="{{ Storage::url('/img/products/'.$value->getImage['name'])}}">
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div style="margin-top: 10px" class="col-6">
                        <p style="margin-bottom: 40px"><b>{{$cart->name}}</b></p>
                        <span>Количество</span>

                        <div>
                            <span id="{{$cart->id}}" class="minusik minus down">-</span>
                            <input id="valCount_{{$cart->id}}" type="text"
                                   style="text-align: center;width: 40px; border-color: transparent;"
                                   min="1" value="{{$cart->count}}"/>
                            <span id="{{$cart->id}}" class="plusik plus up">+</span>
                        </div>

                        @if((($cart->price_with_sale) != null))
                            <input class="price_{{$cart->id}}" type="hidden" value="{{$cart->price}}">
                            <input class="new_price_{{$cart->id}}" type="hidden" value="{{$cart->price_with_sale}}">
                            <s>Старая цена: <span class="old_cost_with_sale_{{$cart->id}}"> {{$cart->price * $cart->count}} </span>грн.
                            </s><br>
                            <b>Цена: <span class="price_{{$cart->id}}">{{$cart->price_with_sale * $cart->count}}</span> грн.</b>
                        @endif
                        @if((($cart->price_with_sale) == null))
                            <input class="price_{{$cart->id}}" type="hidden" value="{{$cart->price}}">
                            <input class="new_price_{{$cart->id}}" type="hidden" value="{{null}}">
                            <b>Цена:<span class="price_{{$cart->id}}">{{$cart->price * $cart->count}}</span>грн.</b>
                        @endif
                        <button class="btn-del btn btn-link"
                                style="padding-left: 0px!important; color:#9ea2a4; margin-bottom: 40px"
                                value="{{$cart->id}}">
                            Удалить из корзины
                        </button>
                    </div>
                    @if((($cart->price_with_sale) == null))
                        <input type="hidden" value="{{$sum}}">
                    @endif
                    @if((($cart->price_with_sale) != null))
                        <input type="hidden" value="{{$sum_sale}}">
                    @endif
                        <input type="hidden" value="{{$sumAll}}">
                @endforeach
            </div>
            <div class="row">
                <div class="col-sm-12">
                        <div>Стоимость товаров:
                            <span class="sumAll-container">{{$sumAll}} грн.</span>
                        </div>
                        <div>Стоимость доставки: <span class="val_nova_poshta_price">{{env('NOVA_POSHTA_PRICE_DELIVERY')}}</span> грн.</div>
                        <div>Итого к оплате:
                            <b><span class="sumAll sumAll-delivery-container">{{($sumAll + env('NOVA_POSHTA_PRICE_DELIVERY'))}}</span></b> грн.
                        </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <a href="/setCheck">
                <button id="" type="submit" style="margin-top: 10px;" class="btn btn-myBuy">Оформить заказ</button>
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

<script>
    $(document).ready(function () {
        let sumAll = $('.sumAll').html();
        let val_nova_poshta_price = $('.val_nova_poshta_price').html();
        let sum_modal = $('#sum_modal').val();
        let sumAll_not_sale = $('#sumAll_not_sale').val();
        let percent = (parseInt(sumAll_not_sale) - parseInt(val_nova_poshta_price)) * 100 /(sum_modal);
        if ((sumAll_not_sale - val_nova_poshta_price) >= sum_modal){
            $('.progress-bar').hide()
        }
        function incrementProgress(barSelector, countSelector, incrementor) {
            var bar = document.querySelectorAll(barSelector)[0].firstElementChild,
                curWidth = parseFloat(bar.style.width),
                newWidth = curWidth + incrementor;
            if (newWidth > 100) {
                newWidth = 0;
            } else if (newWidth < 0) {
                newWidth = 100;
            }
            bar.style.width = newWidth + '%';
            document.querySelectorAll(countSelector)[0].innerHTML = newWidth.toFixed(1) + '%';
        }

        function incrementProgressLoop() {
            incrementProgress('.progress-bar', '.progress-count', percent);
        }

        incrementProgressLoop();
    })
</script>
