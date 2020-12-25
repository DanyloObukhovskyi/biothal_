<link href="{{ asset('css/cart.css') }}" rel="stylesheet">
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light">
        <div id="logo" class="row col-sm-3">
            <a class="navbar-brand" href="/">
                <img id="logo_img" class="img-fluid" style="margin-left: 30px; margin-right: auto; width: 7em"
                     src="{{Storage::url('img/new-logo.png')}}" width="127"></a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span id="navtreeline" class="navbar-toggler-icon"></span>
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
                                <a class="dropdown-item" style="margin-top: 10px" href="/category/{{$value['id']}}"
                                   id="categories_{{$value['id']}}"><b>{{$value['title']}}</b></a>
                                @foreach($categories as $child)
                                    @if($child['parent_id'] == $value['id'] )
                                        <a class="dropdown-item"
                                           href="/category/{{$child['parent_id']. '/'. $child['id']}}"
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
                    <div class="dropdown-menu" style="column-count: 2" aria-labelledby="navbarDropdownMenuLink">
                        @foreach($accessories as $value)
                            @if($value['parent_id'] == null)
                                <div style="display: flex; flex-direction: column;">
                                    <div>
                                        <a class="dropdown-item" style="margin-top: 10px; margin-bottom: 15px"
                                           href="/accessory/{{$value['id']}}"
                                           id="accessories_{{$value['id']}}"><b>{{$value['title']}}</b></a>
                                    </div>
                                    @foreach($accessories as $child)
                                        @if($child['parent_id'] == $value['id'] )
                                            <div>
                                                <a class="dropdown-item"
                                                   href="/accessory/{{$child['parent_id']. '/'. $child['id']}}"
                                                   id="accessories_{{$child['id']}}">{{$child['title']}}</a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
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

        <div class="col-sm-2" id="icons" style="display: flex; justify-content: space-evenly">
            <svg data-toggle="modal" data-target="#exampleModal" width="1.2em" height="1.2em" viewBox="0 0 16 16"
                 class="bi bi-person" fill="currentColor"
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

        <!-- Modal1 -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Личный кабинет</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="row justify-content-center modal-body">
                        <div class="btn-group-vertical">
                            @if ((Auth::check() == false))
                                <a href="{{route('login')}}">
                                    <button style="margin-bottom: 15px; width: 200px" type="button"
                                            class="btn btn-info">
                                        Войти
                                    </button>
                                </a>
                                <a href="{{route('register')}}">
                                    <button style="margin-bottom: 15px; width: 200px" type="button"
                                            class="btn btn-info">
                                        Зарегистрироваться
                                    </button>
                                </a>
                            @endif
                                @if(Auth::user())
                                    @if(Auth::user()->type == 'admin')
                                        <a href="{{route('admin.dashboard')}}">
                                            <button style="margin-bottom: 15px; width: 200px" type="button"
                                                    class="btn btn-info">
                                                Admin Panel
                                            </button>
                                        </a>
                                    @endif
                                @endif
                                @if (Auth::check())
                                <a href="{{route('logout')}}">
                                    <button style="margin-bottom: 15px; width: 200px" type="button"
                                            class="btn btn-info">
                                        Выйти
                                    </button>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal2 -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLongTitle"
             aria-hidden="true">
            <div style="margin-right: 0px!important; margin-top: 0px!important;" class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Корзина ({{$countAll}})</h5>
                        <button type="button" class="close" style="margin-right: 5px" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" style="margin-right: 30px;">
                        <div class="container">
                            <input type="hidden" value="{{$sumAll_sale = 2000-$sumAll}}">
                            @if(empty($sumAll))
                                <div style="margin-left: auto;margin-right: auto; margin-bottom: 15px">Скидка 50% срабатывает от суммы 2000грн</div>
                            @endif
                                @if($sumAll_sale < 2000 && $sumAll_sale > 0)
                            <div style="margin-left: auto;margin-right: auto; margin-bottom: 15px">Еще {{$sumAll_sale}}
                                    грн и сработает скидка 50%</div>
                            @endif
                            @if($sumAll_sale <= 0 )
                                <div style="margin-left: auto;margin-right: auto; margin-bottom: 15px">Ваша скидка 50%</div>
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
                                                <img style="height: auto!important; padding: 10px" class="img-fluid"
                                                     src="{{ asset('/img/'.$value->getImage['name'])}}">
                                            @endif
                                        @endforeach
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
                                        <input type="hidden" value="{{$sum}}">
                                    @endif
                                    @if((($cart->price_with_sale) != null))
                                        <input type="hidden"
                                               value="{{$sum_sale}}">
                                    @endif
                                    <input type="hidden" value="{{$sumAll}}">
                                @endforeach
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    @if((!empty($sumAll)) && ($sumAll_sale > 0))
                                        <div>Стоимость товаров: <span>{{$sumAll}} грн.</span></div>
                                        <div>Стоимость доставки: <span>{{$delivery . ' '}}грн.</span></div>
                                        <div>Итого к оплате: <b><span class="sumAll">{{$sumAll + $delivery . ' '}}</span></b>грн.</div>

                                    @elseif((!empty($sumAll)) && ($sumAll_sale <= 0))
                                        <div>Стоимость товаров: <span>{{$sumAll/2}} грн.</span></div>
                                        <div>Стоимость доставки: <span>{{$delivery . ' '}}грн.</span></div>
                                        <div>Итого к оплате: <b><span class="sumAll">{{$sumAll/2 + $delivery . ' '}}</span></b>грн.</div>
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
                            <div class="col-md-6 " style="text-align: center; margin-top: 20px; margin-bottom: 20px;">Рекомендуемые товары
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5" style="padding-right: 10px">
                                @foreach($product_sale as $value)
                                    <div style="margin-bottom: 20px">
                                        @foreach($products as $val)
                                            @if($val->id == $value->id)
                                                <div class="text-center" style="width: 12rem;">
                                                    <a href="product/{{$value->id}}">
                                                        <img src="
                                                        @if(isset($value->getImage['name']))
                                                        {{ asset('/img/'.$value->getImage['name'])}}
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
                            <div class="col-5">
                                @foreach($product_price as $value)
                                    <div style="margin-bottom: 20px">
                                        @foreach($products as $val)
                                            @if($val->id == $value->id)
                                                <div class="text-center" style="width: 12rem;">
                                                    <a href="product/{{$value->id}}"><img class="img-fluid"
                                                      @if(isset($value->getImage['name']))
                                                      src="{{ asset('/img/'.$value->getImage['name'])}}"></a>
                                                      @endif
                                                    @endif
                                                    @endforeach
                                                    <div class="card-body">
                                                        <span>{!!$value->name!!}</span>
                                                        <span
                                                            style="color: red"><s>{!!$value->price . ' '!!}</s>грн.</span>
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
            </div>
        </div>
    </nav>

<script>
    $(document).ready(function () {
        let sumAll = $('.sumAll').html();
        let percent = (+sumAll)*100/2000;
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
