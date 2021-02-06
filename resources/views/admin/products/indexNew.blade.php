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
                                           id="input-title-product" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="input-status">Статус</label>
                                    <select name="filter_status" id="input-status" class="form-control">
                                        <option value="*"> Вибирите статус</option>
                                        @foreach(config('products.products_statuses') as
                                            $product_status_key => $product_status)
                                            <option value="{{$product_status_key}}">{{$product_status}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" id="button-filter" class="btn btn-primary pull-right">
                                    <a href="{{route('admin.products.pageNew')}}" id="filter-href" style="color: #ffffff !important;">
                                        <i class="fa fa-filter"></i> Фильтр
                                    </a>
                                </button>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" id="button-sales" class="btn btn-danger pull-right"><i
                                        class="fa fa-percent"></i> Скидки
                                </button>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" id="button-global-sales" class="btn btn-dark pull-right"><i
                                        class="fa fa-percent"></i> Глобальная скидка
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
                                    <td class="text-right">Цена на сайте</td>
                                    <td class="text-right">Количество</td>
                                    <td class="text-left">Статус</td>
                                    <td class="text-right">Действие</td>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach($products as $product_key => $product)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" name="selected[]" value="{{$product['id']}}"/>
                                            </td>
                                            <td class="text-center">
                                                <img
                                                    src="https://biothal.com.ua/image/cache/catalog/maska-dlja-lica-konoplja-vodorosli-40x40.jpg"
                                                    alt=" Очищающая маска для лица Конопля Водоросли" class="img-thumbnail"/>
                                            </td>
                                            <td class="text-left"> {{$product['product_description']['name']}}</td>
                                            <td class="text-right">
                                                @if(!empty($product['price_with_sale']))
                                                    {{$product['price_with_sale']}}
                                                @else
                                                    {{$product['price']}}
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <span class="label label-success">{{$product['quantity']}}</span>
                                            </td>
                                            <td class="text-left">{{config('products.products_statuses')[$product['status']]}}</td>
                                            <td class="text-right">
                                                <a href="{{route('admin.products.changeNewProd', ['id' => $product['id']])}}" data-toggle="tooltip" title="Редактировать" class="btn btn-primary">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
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
    <script>
        $('#input-title-product').on('keyup', function (e) {
            if(e.key === 'Enter') {
                var text = $('#input-title-product').val();
                var url = new URL($("#filter-href").attr("href"));
                var searchParams = new URLSearchParams(url.search);
                searchParams.set("title_product", JSON.stringify(text));
                $("#filter-href").attr("href", url.origin + url.pathname + "?" + searchParams.toString());
            }
        })

        $('#input-status').change(function () {
            var status = $(this).val();
            var url = new URL($("#filter-href").attr("href"));
            var searchParams = new URLSearchParams(url.search);
            searchParams.set("status", JSON.stringify(status));
            $("#filter-href").attr("href", url.origin + url.pathname + "?" + searchParams.toString());
        })
    </script>
@endsection
