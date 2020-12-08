<a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
</a>

<nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
        <div class="sidebar-brand">
            <a href="{{route('admin.logout')}}"><i class="fas fa-sign-out-alt"></i> Выйти</a>
            <div id="close-sidebar">
                <i class="fas fa-times"></i>
            </div>
        </div>
        <div class="sidebar-header">
            <div class="user-pic">
                <img class="img-responsive img-rounded"
                     src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
                     alt="User picture">
            </div>
            <div class="user-info">
          <span class="user-name">
              {{Auth::user()->name}}
          </span>
                <span class="user-role">Administrator <p class="fa fa-eye"></p></span>
                <span class="user-status">
            <i class="fa fa-circle"></i>
            <span>Online</span>
          </span>
            </div>
        </div>
        <!-- sidebar-header  -->
        <div class="sidebar-search">
            <div>
                <div class="input-group">
                    <input type="text" class="form-control search-menu" placeholder="Поиск...">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="fa fa-search" aria-hidden="true"></i>
                      </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- sidebar-search  -->
        <div class="sidebar-menu">
            <ul>
                <li class="header-menu">
                    <span>General</span>
                </li>
                <li class="{{@checkIsActive('admin.statePanel.page')}}">
                    <a href="{{route('admin.statePanel.page')}}">
                        <i class="fa fa-tachometer-alt"></i>
                        <span>Панель состояния</span>
                    </a>
                </li>
                <li class="{{@checkIsActive('admin.categories.page')}}">
                    <a href="{{route('admin.categories.page')}}">
                        <i class="fas fa-sitemap"></i>
                        <span>Категории</span>
                    </a>
                </li>
                <li class="{{@checkIsActive('admin.accessories.page')}}">
                    <a href="{{route('admin.accessories.page')}}">
                        <i class="far fa-gem"></i>
                        <span>Потребности</span>
                    </a>
                </li>
                <li class="{{@checkIsActive('admin.products.page')}}">
                    <a href="{{route('admin.products.page')}}">
                        <i class="fa fa-shopping-cart"></i>
                        <span>Товары</span>
                    </a>
                </li>
{{--                <li class="sidebar-dropdown">--}}
{{--                    <a href="#">--}}
{{--                        <i class="fa fa-shopping-cart"></i>--}}
{{--                        <span>Товары</span>--}}
{{--                        <span class="badge badge-pill badge-danger">3</span>--}}
{{--                    </a>--}}
{{--                    <div class="sidebar-submenu">--}}
{{--                        <ul>--}}
{{--                            <li {{@checkIsActive('admin.products.page')}}>--}}
{{--                                <a href="{{route('admin.products.page')}}">--}}
{{--                                    <i class="fas fa-boxes"></i>--}}
{{--                                    <span>Добавление</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i class="fas fa-dumpster"></i>--}}
{{--                                    <span>Удаление</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i class="fas fa-wrench"></i>--}}
{{--                                    <span>Редактирование товаров</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}
                <li class="{{@checkIsActive('admin.images.page')}}">
                    <a href="{{route('admin.images.page')}}">
                        <i class="fas fa-camera"></i>
                        <span>Галерея</span>
                    </a>
                </li>
{{--                <li class="{{@checkIsActive('test')}}">--}}
{{--                    <a href="{{route('test')}}">--}}
{{--                        <i class="fa fa-warning"></i>--}}
{{--                        <span>Тестовая рума</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

                {{--                <li class="sidebar-dropdown">--}}
                {{--                    <a href="#">--}}
                {{--                        <i class="far fa-gem"></i>--}}
                {{--                        <span>Components</span>--}}
                {{--                    </a>--}}
                {{--                    <div class="sidebar-submenu">--}}
                {{--                        <ul>--}}
                {{--                            <li>--}}
                {{--                                <a href="#">General</a>--}}
                {{--                            </li>--}}
                {{--                            <li>--}}
                {{--                                <a href="#">Panels</a>--}}
                {{--                            </li>--}}
                {{--                            <li>--}}
                {{--                                <a href="#">Tables</a>--}}
                {{--                            </li>--}}
                {{--                            <li>--}}
                {{--                                <a href="#">Icons</a>--}}
                {{--                            </li>--}}
                {{--                            <li>--}}
                {{--                                <a href="#">Forms</a>--}}
                {{--                            </li>--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                </li>--}}
                {{--                <li class="sidebar-dropdown">--}}
                {{--                    <a href="#">--}}
                {{--                        <i class="fa fa-chart-line"></i>--}}
                {{--                        <span>Charts</span>--}}
                {{--                    </a>--}}
                {{--                    <div class="sidebar-submenu">--}}
                {{--                        <ul>--}}
                {{--                            <li>--}}
                {{--                                <a href="#">Pie chart</a>--}}
                {{--                            </li>--}}
                {{--                            <li>--}}
                {{--                                <a href="#">Line chart</a>--}}
                {{--                            </li>--}}
                {{--                            <li>--}}
                {{--                                <a href="#">Bar chart</a>--}}
                {{--                            </li>--}}
                {{--                            <li>--}}
                {{--                                <a href="#">Histogram</a>--}}
                {{--                            </li>--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                </li>--}}
                {{--                <li class="sidebar-dropdown">--}}
                {{--                    <a href="#">--}}
                {{--                        <i class="fa fa-globe"></i>--}}
                {{--                        <span>Maps</span>--}}
                {{--                    <div class="sidebar-submenu">--}}
                {{--                        <ul>--}}
                {{--                            <li>--}}
                {{--                                <a href="#">Google maps</a>--}}
                {{--                            </li>--}}
                {{--                            <li>--}}
                {{--                                <a href="#">Open street map</a>--}}
                {{--                            </li>--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                </li>--}}
            </ul>
        </div>
    </div>
</nav>
