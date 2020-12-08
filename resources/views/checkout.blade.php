@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div style="padding: 35px">

    </div>

    <div class="container">
        <form>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Введите номер телефона*</label>
                        <input type="text" class="colorInput form-control" id="formGroupExampleInput" placeholder="+38(___) ___ - __ - __">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Введите имя*</label>
                        <input type="text" class="colorInput form-control" id="formGroupExampleInput2" placeholder="Имя">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Введите фамилию*</label>
                        <input type="text" class="colorInput form-control" id="formGroupExampleInput2" placeholder="Фамилия">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Выберите область*</label>
                        <input type="text" class="colorInput form-control" id="formGroupExampleInput2" placeholder="Область">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Введите город*</label>
                        <input type="text" class="colorInput form-control" id="cities" placeholder="Введите город">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2" id="checkout">Выберите отделение Новой Почты*</label>
                        <input type="text" class="colorInput form-control" id="formGroupExampleInput2" placeholder="Область">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Выберите способ оплаты*</label>
                        <select id="inputState" class="colorInput form-control">
                            <option id="getCheckout" selected>Оплата при получении</option>
                        </select>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-5">
                            <a href="/checkout"><button id="" type="submit" style="margin-top: 10px;" class="btn btn-myBuy">Оформить заказ</button></a>
                        </div>
                        <div class="col-sm-5">
                            <a href="/checkout"><button id="" type="submit" class="btn btn-link" style="padding-left: 0px!important; color:#9ea2a4; margin-top: 10px">Оформить в 1 клик</button></a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row justify-content-center verticalscroll">
                        @foreach($cart_join as $cart)
                            <div class="col-6">
                                <img style="height: auto!important; padding: 10px" class="img-fluid"
                                     src="{{Storage::url('img/tonik.png')}}">
                            </div>
                            <div style="margin-top: 10px" class="col-6">
                                <p style="margin-bottom: 40px"><b>{{$cart->name}}</b></p>
                                <span>Количество</span>
                                <div class="">
                                    <span class="minus down">-</span>
                                    <input id="valCount" type="text"
                                           style="text-align: center;width: 40px; border-color: transparent;"
                                           min="1" value="{{$cart->count}}"/>
                                    <span class="plus up">+</span>
                                </div>
                                @if((($cart->price_with_sale) != null))
                                    <s>Старая цена: {{$cart->price}} грн.</s><br>
                                    <b>Цена: {{$cart->price_with_sale}} грн.</b>
                                @endif
                                @if((($cart->price_with_sale) == null))
                                    <b>Цена: {{$cart->price}} грн.</b>
                                @endif
                                <button id="btn-del" class="btn btn-link"
                                        style="padding-left: 0px!important; color:#9ea2a4; margin-bottom: 40px"
                                        value="{{$cart->id}}">
                                    Удалить из корзины
                                </button>
                            </div>
                            @if((($cart->price_with_sale) == null))
                                <input type="hidden" value="{{$sum += (($cart->price * $cart->count))}}">
                            @endif
                            @if((($cart->price_with_sale) != null))
                                <input type="hidden" value="{{$sum_sale += (($cart->price_with_sale * $cart->count))}}">
                            @endif
                            <input type="hidden" value="{{$sumAll = (($sum + $sum_sale))}}">
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="padding: 20px">
                            @if((!empty($sumAll)))
                                <span>Стоимость товаров: {{$sumAll}} грн.</span><br>
                                <span>Стоимость доставки: {{$delivery . ' '}}грн.</span><br>
                                <span>Итого к оплате: <b>{{$sumAll + $delivery . ' '}}</b>грн.</span><br>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </form>

        <div style="margin-bottom: 35px; text-align: center">
            <h2>Рекомендуемые товары</h2>
        </div>
        <div class="row">
            @foreach($products as $value)
                @if($value['sale_id'] == null)
                    <div class="col-md-4 col-sm-12" style="margin-bottom: 20px">
                        <div class="card text-center" style="width: 18rem;">
                            <a href="product/{{$value->id}}"><img src="{{Storage::url('img/tonik.png')}}" class="card-img-top" alt="..."></a>
                            <div class="card-body">
                                <h5 class="card-title">{!!$value->name!!}</h5>
                                <p class="card-text"><b>{!!$value->price . ' '!!}грн.</b></p>
                                <button id="btn-buyHome" style="width: 150px; background-color: #2f7484; border-color: #2f7484"
                                        class="btn btn-success rounded-pill" value="{{$value->id}}">Купить
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="row" style="height: 80px; background-color: #2f7484;">
        <div class="col-md-1"></div>
        <div class="hut col-md-5">Узнавайте первыми о распродажах и новинках!</div>
        <div class="hut col-md-4">Электронный адрес</div>
        <div class="col-md-2"></div>
    </div>

    @include('layouts.footer')
@endsection

