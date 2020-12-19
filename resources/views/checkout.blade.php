@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <style>
        .icon {
            display: inline-block; /* Строчно-блочный элемент */
            position: relative; /* Относительное позиционирование */
        }
        .icon:hover::after {
            content: attr(data-title); /* Выводим текст */
            position: absolute; /* Абсолютное позиционирование */
            left: auto; top: auto; /* Положение подсказки */
            z-index: 1; /* Отображаем подсказку поверх других элементов */
            background: rgba(255,255,230,0.9); /* Полупрозрачный цвет фона */
            font-family: Arial, sans-serif; /* Гарнитура шрифта */
            font-size: 13px; /* Размер текста подсказки */
            padding: 5px 10px; /* Поля */
            border: 1px solid #333; /* Параметры рамки */
            width: 18em;
            text-align: center;

        }
        * {
            margin: 0;
            padding: 0;
        }
        .pulse {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 1.3em;
            height: 1em;
            color:gray;
            background: white;
            border-radius: 50%;
            animation: radial-pulse 3s infinite;
        }
        .wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes radial-pulse {
            0% {
                box-shadow: 0 0 0 0px rgba(0, 0, 0, 0.5);
            }

            100% {
                box-shadow: 0 0 0 40px rgba(0, 0, 0, 0);
            }
        }
    </style>
    <div style="padding: 35px">
    </div>
    <div class="container">
        <form>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Введите номер телефона*</label>
                        <input type="text" value="" class="colorInput form-control" id="phone"
                               placeholder="+38(___) ___ - __ - __">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Введите имя*</label>
                        <input type="text" value="" class="colorInput form-control" id="name" placeholder="Имя">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Введите фамилию*</label>
                        <input type="text" class="colorInput form-control" id="LastName" placeholder="Фамилия">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Выберите область*</label>
                        <select id="region" class="colorInput form-control">
                            @foreach($region as $key => $reg)
                                <option @if($key === 0) selected disabled value="" @else value="{{$reg['id']}}" @endif">
                                {{$reg['region']}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Введите город*</label>
                        <input type="text" class="colorInput form-control" id="cities" placeholder="Введите город">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Выберите отделение Новой Почты*</label>
                        <select id="department" class="colorInput form-control">
                            <option selected value="">Отделение</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Выберите способ оплаты*</label>
                        <select id="payment" class="colorInput form-control">
                            <option id="" selected>Оплата при доставке курьером Новой Почты</option>
                            <option id="" selected>Оплата при получении в отделении Новой Почты</option>
                        </select>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-10">
                                <label for="formGroupExampleInput2">Не нужно перезванивать мне для подтверждения
                                    заказа</label>
                            </div>
                            <div class="checkbox col-sm-1">
                                <input type="checkbox" name="not_call" id="not_call_0" >
                            </div>
                            <div class="col-sm-1 wrapper">
                               <p class="icon pulse" data-title="В случае выбора этой опции, ваш заказ будет сформирован и отправлен без звонка менеджера.
                                Пожалуйста, проверьте внимательно все ли данные внесены корректно!">
                                   <svg  width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd"
                                             d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                       <path
                                           d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                                       <circle cx="8" cy="4.5" r="1"/>
                                   </svg>
                               </p>
                            </div>

                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-5">
                            <span rel="/check" id="check" type="submit" style="margin-top: 10px; padding: 10px"
                                  class="btn btn-myBuy">Оформить заказ</span>
                        </div>
                        <div class="col-sm-5">
                            <span data-toggle="modal" data-target="#modalOneClick" class="btn btn-link"
                                  style="color:#9ea2a4; margin-top: 10px; padding: 10px">Оформить в 1 клик</span></div>
                    </div>
                </div>
                <div class="col">
                    <div class="row justify-content-center verticalscroll">
                        @foreach($cart_join as $cart)
                            @foreach($products as $value)
                                @if($value->id == $cart->id)
                                    <div class="col-6">
                                        <img style="padding: 10px" class=""
                                             src="{{ asset('/img/'.$value->getImage['name'])}}">
                                    </div>
                                @endif
                            @endforeach
                            <div class="col-6">
                                <div style="margin-top: 10px" class="">
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

        <!-- Modal -->
        <div class="modal fade" id="modalOneClick" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             style="margin-top: 10%" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form>
                            <div class="row justify-content-center" style="margin-top: 10px">
                                <p><b>Оформить заказ в 1 клик</b></p>
                                <p align="center">Наш менеджер свяжется с вами в течении<br>
                                    30 минут в рабочее время
                                <p>
                                <p></p>
                            </div>
                            <div class="container">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Введите имя</label>
                                    <input type="text" class="form-control"
                                           style="font-weight: bold; background: #F7F7F7;" id="nameModal">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-phone" class="col-form-label">Введите номер телефона</label>
                                    <input type="text" class="form-control"
                                           style="font-weight: bold; background: #F7F7F7;" id="phoneModal">
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <span rel="/checkModalOneClick" id="checkModalOneClick" type="submit"
                                      style="margin-top: 10px; width: 225px; padding: 10px" class="btn btn-myBuy">Оформить быстрый заказ</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-bottom: 35px; text-align: center">
            <h2>Рекомендуемые товары</h2>
        </div>
        <div class="row">
            @foreach($products as $value)
                @if($value['sale_id'] == null)
                    <div class="col-md-4 col-sm-12" style="margin-bottom: 20px">
                        <div class="card text-center" style="width: 18rem;">
                            <a href="product/{{$value->id}}"><img src="{{ asset('/img/'.$value->getImage['name'])}}"
                                                                  class="card-img-top"></a>
                            <div class="card-body">
                                <h5 class="card-title">{!!$value->name!!}</h5>
                                <p class="card-text"><b>{!!$value->price . ' '!!}грн.</b></p>
                                <button id="btn-buyHome"
                                        style="width: 150px; background-color: #2f7484; border-color: #2f7484"
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

