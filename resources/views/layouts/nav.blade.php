<link href="{{ asset('css/cart.css') }}" rel="stylesheet">

<nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="row col-sm-3">
        <a class="navbar-brand" href="/"><img class="img-fluid" style="margin-left: 30px" src="{{Storage::url('img/new-logo.png')}}"
                                              width="127"></a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse col-sm-7" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Категории
                </a>
                <div class="dropdown-menu" style="column-count: 2" aria-labelledby="navbarDropdownMenuLink">
                    @foreach($categories as $value)
                        @if($value['parent_id'] == null)
                            <a class="dropdown-item" style="margin-top: 10px" href=""
                               id="categories_{{$value['id']}}"><b>{{$value['title']}}</b></a>
                            @foreach($categories as $child)
                                @if($child['parent_id'] == $value['id'] )
                                    <a class="dropdown-item" href=""
                                       id="categories_{{$child['id']}}">{{$child['title']}}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Потребности
                </a>
                <div class="dropdown-menu" style="column-count: auto" aria-labelledby="navbarDropdownMenuLink">
                    @foreach($accessories as $value)
                        @if($value['parent_id'] == null)
                            <a class="dropdown-item" style="margin-top: 10px" href=""
                               id="categories_{{$value['id']}}"><b>{{$value['title']}}</b></a>
                            @foreach($accessories as $child)
                                @if($child['parent_id'] == $value['id'] )
                                    <a class="dropdown-item" href=""
                                       id="categories_{{$child['id']}}">{{$child['title']}}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Эффективные наборы</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><b>Стать дистрибьютером</b></a>
            </li>
        </ul>
    </div>

    <div class="col-sm-2" style="display: flex; justify-content: space-evenly">
        <svg data-toggle="modal" data-target="#exampleModal" width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor"
             xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
        </svg>
        <!-- Button trigger modal -->
        <span class="badge badge-light">
        <svg data-toggle="modal" data-target="#exampleModalLong" width="1.2em" height="1.2em" viewBox="0 0 16 16"
             class="bi bi-bag" fill="currentColor"
             xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M8 1a2.5 2.5 0 0 0-2.5 2.5V4h5v-.5A2.5 2.5 0 0 0 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5H2z"/>
        </svg>
            @if(count($cart_prod_count) != null)
                {{$countAll}}
            @endif
        </span>
    </div>

    <!-- Modal2 -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div style="margin-right: 0px!important; margin-top: 0px!important;" class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Корзина ({{$countAll}})</h5>
                    <button type="button" class="close" style="margin-right: 5px" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            @foreach($cart_join as $cart)
                                <div class="col-6">
{{--                                    @foreach($cart_image as $image)--}}
{{--                                        @dd($cart_image)--}}
                                    <img style="height: auto!important; padding: 10px" class="img-fluid"
                                         src="{{Storage::url('img/tonik.png')}}">
{{--                                    @endforeach--}}

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
                            <div class="col-sm-12">
                                @if((!empty($sumAll)))
                                <span>Стоимость товаров: {{$sumAll}} грн.</span><br>
                                <span>Стоимость доставки: {{$delivery . ' '}}грн.</span><br>
                                <span>Итого к оплате: <b>{{$sumAll + $delivery . ' '}}</b>грн.</span><br>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <a href="/setCheck"><button id="" type="submit" style="margin-top: 10px;" class="btn btn-myBuy">Оформить заказ</button></a>
                    </div>
                    @endif
                    <div class="row justify-content-center">
                        <div class="col-md-6 " style="margin-top: 20px; margin-bottom: 20px;">Рекомендуемые товары</div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-5">
                            @foreach($product_sale as $value)
{{--                                @if($value['sale_id'] == null)--}}
                                    <div style="margin-bottom: 20px">
                                        <div class="text-center" style="width: 12rem;">
                                            <a href="product/{{$value->id}}"><img
                                                    src="{{Storage::url('img/tonik.png')}}"
                                                    class="img-fluid" alt="..."></a>
                                            <div class="card-body">
                                                <span class="card-title">{!!$value->name!!}</span>
                                                <p class="card-text"><b>{!!$value->price . ' '!!}грн.</b></p>
                                                <button id="btn-buyHome"
                                                        style="width: auto; background-color: #2f7484; border-color: #2f7484"
                                                        class="btn btn-success rounded-pill" value="{{$value->id}}">
                                                    Добавить
                                                </button>
                                            </div>
                                        </div>
                                    </div>
{{--                                @endif--}}
                            @endforeach
                        </div>

                        <div class="col-5">
                            @foreach($product_price as $value)
{{--                                @if($value['sale_id'] != null)--}}
                                    <div style="margin-bottom: 20px">
                                        <div class="text-center" style="width: 12rem;">
                                            <a href="product/{{$value->id}}"><img class="img-fluid"
                                                                                  src="{{Storage::url('img/tonik.png')}}"></a>
                                            <div class="card-body">
                                                <span>{!!$value->name!!}</span>
                                                <span style="color: red"><s>{!!$value->price . ' '!!}</s>грн.</span>
                                                <p><b>{!!$value->price_with_sale . ' '!!}грн.</b></p>
                                                <button id="btn-buyHome"
                                                        style="width: auto; background-color: #2f7484; border-color: #2f7484"
                                                        class="btn btn-success rounded-pill" value="{{$value->id}}">
                                                    Добавить
                                                </button>
                                            </div>
                                        </div>
                                    </div>
{{--                                @endif--}}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>


