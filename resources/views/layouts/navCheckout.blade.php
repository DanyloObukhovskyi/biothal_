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
            <div>
                 @include('partials.partialsBasket')
            </div>
        </div>
    </div>
</nav>
<script>
    $(document).ready(function () {
        let sumAll = $('.sumAll').html();
        let sum_modal = $('#sum_modal').val();
        let percent = parseInt(sumAll) * 100 /(sum_modal);
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
