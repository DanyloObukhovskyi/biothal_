@extends('admin.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{asset('css/products.css')}}">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="prod-header border container-fluid">
            <div class="row page-header">
                <div class="container-fluid col-sm-12" >
                    <div class="h1-prod col-sm-1">Товары</div>
                    <div class="pull-right col-sm-3">
                        <a href="" data-toggle="tooltip" title="Добавить" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                        <button type="submit" form="form-product" formaction="" data-toggle="tooltip" title="Копировать" class="btn btn-default"><i class="fa fa-copy"></i></button>
                        <button id="but-del" type="button" data-toggle="tooltip" title="Удалить" class="btn btn-danger" onclick="confirm('Данное действие необратимо. Вы уверены?') ? $('#form-product').submit() : false;"><i class="fa fa-trash-o"></i></button>
                    </div>
                    <div class="col-sm-8">
                    </div>
                    <div class="breadcrumb col-sm-3">
                        <div><a href="/admin/dashboard"><i class="fa fa-home fa-lg"></i></a></div>
                        <div><a href="">/ Товары</a></div>
                    </div>

                </div>
            </div>
    </div>
    <div class="panel-heading">
        <h5 class="panel-title"><i class="fa fa-list"></i> Товары</h5>
    </div>
    <div class="border container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="well">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="input-name">Название товара</label>
                                    <input type="text" name="filter_name" value="" placeholder="Название товара"
                                           id="input-name" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="input-model">Модель</label>
                                    <input type="text" name="filter_model" value="" placeholder="Модель"
                                           id="input-model" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="input-price">Цена</label>
                                    <input type="text" name="filter_price" value="" placeholder="Цена" id="input-price"
                                           class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="input-quantity">Количество</label>
                                    <input type="text" name="filter_quantity" value="" placeholder="Количество"
                                           id="input-quantity" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="input-status">Статус</label>
                                    <select name="filter_status" id="input-status" class="form-control">
                                        <option value="*"></option>
                                        <option value="1">Включено</option>
                                        <option value="0">Отключено</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="input-image">Изображение товара</label>
                                    <select name="filter_image" id="input-image" class="form-control">
                                        <option value="*"></option>
                                        <option value="1">Включено</option>
                                        <option value="0">Отключено</option>
                                    </select>
                                </div>
                                <button type="button" id="button-filter" class="btn btn-primary pull-right"><i
                                        class="fa fa-filter"></i> Фильтр
                                </button>
                            </div>
                        </div>
                    </div>

                    <form action="" method="post" enctype="multipart/form-data" id="form-product">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr class="tr-thead">
                                    <td style="width: 1px;" class="text-center">
                                        <input type="checkbox"
                                               onclick="$('input[name*=\'selected\']').prop('checked', this.checked);"/>
                                    </td>
                                    <td class="text-center">Изображения</td>
                                    <td class="text-left">Название товара</td>
                                    <td class="text-left">Название</td>
                                    <td class="text-right">Цена на сайте</td>
                                    <td class="text-right">Количество</td>
                                    <td class="text-left">Статус</td>
                                    <td class="text-right">Действие</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="selected[]" value="132"/>
                                    </td>
                                    <td class="text-center">
                                        <img
                                            src="https://biothal.com.ua/image/cache/catalog/maska-dlja-lica-konoplja-vodorosli-40x40.jpg"
                                            alt=" Очищающая маска для лица Конопля Водоросли" class="img-thumbnail"/>
                                    </td>
                                    <td class="text-left"> Очищающая маска для лица Конопля Водоросли</td>
                                    <td class="text-left"> Очищающая маска для лица Конопля Водоросли</td>
                                    <td class="text-right"> 759</td>
                                    <td class="text-right">
                                        <span class="label label-success">26</span>
                                    </td>
                                    <td class="text-left">Включено</td>
                                    <td class="text-right">
                                        <a href="changeNewProd" data-toggle="tooltip" title="Редактировать" class="btn btn-primary"><i
                                                class="fa fa-pencil"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="selected[]" value="154"/>
                                    </td>
                                    <td class="text-center">
                                        <img src="https://biothal.com.ua/image/cache/catalog/Nabor/sovtelo1-40x40.jpg"
                                             alt=" Программа Совершенное тело" class="img-thumbnail"/>
                                    </td>
                                    <td class="text-left"> Программа Совершенное тело</td>
                                    <td class="text-left"> Программа Совершенное тело</td>
                                    <td class="text-right"> 1230</td>
                                    <td class="text-right">
                                        <span class="label label-success">75</span>
                                    </td>
                                    <td class="text-left">Отключено</td>
                                    <td class="text-right"><a href="" data-toggle="tooltip" title="Редактировать"
                                                              class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    @endsection

@section('script')
    <script src="{{asset('js/products.js')}}"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
@endsection
