@extends('admin.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{asset('css/products.css')}}">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
    <style>
        .table-responsive {
            overflow-x: inherit;
        }
        .input-group {
            display: flex;
        }
    </style>
@endsection

@section('content')
    <div class="prod-header border container-fluid">
        <div class="row page-header">
            <div class="container-fluid col-sm-12" >
                <div class="row">
                    <div class="h1-prod col-sm-6"><i class="fa fa-list"></i> Товары</div>
                    <div class="pull-right col-sm-6">
                        <a href="{{ route('admin.products.createProd') }}" data-toggle="tooltip" title="Добавить" class="btn btn-primary"><i class="fa fa-plus"></i></a>
{{--                        <button type="submit" form="form-product" formaction="" data-toggle="tooltip" title="Копировать" class="btn btn-default"><i class="fa fa-copy"></i></button>--}}
                        <button id="but-del" type="button" data-toggle="tooltip" title="Удалить" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                    </div>
                    <div class="breadcrumb col-sm-12" style="background: none">
                        <div><a href="/admin/dashboard"><i class="fa fa-home fa-lg"></i></a></div>
                        <div style="margin-right: 5px">/ </div>
                        <div><a href="{{route('admin.products.pageNew')}}"> Товары</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="border container-fluid" style="padding-left: 0;
        padding-right: 0;">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="well">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="input-name">Название товара</label>
                                    <input type="text" value="@if(!empty(request()->input('title_product'))) {{request()->input('title_product')}} @endif" placeholder="Название товара"
                                           id="input-title-product" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="input-status">Статус</label>
                                    <select name="filter_status" id="input-status" class="form-control">
                                        <option value=""> Вибирите статус</option>
                                        @foreach(config('products.products_statuses') as
                                            $product_status_key => $product_status)
                                            <option value="{{$product_status_key}}"
                                            @if(request()->input('status') !== null && request()->input('status') == $product_status_key) selected @endif>{{$product_status}}</option>
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
                            <div class="col-sm-1" >
                                <button type="button" id="button-sales" data-toggle="modal" data-target="#choice_your_sale_modal"  class="btn btn-danger pull-right" style="margin-right: 6px;"><i
                                        class="fa fa-percent"></i> Скидки
                                </button>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" id="button-global-sales" class="btn btn-dark pull-right"> <a style="color:white" href="{{route('admin.products.salesGlobal')}}"><i
                                            class="fa fa-percent"></i> Глобальная скидка</a>
                                </button>
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
                                                <input type="checkbox" name="selected[]" value=" {{ $product['id'] }}"/>
                                            </td>
                                            <td class="text-center">
                                                <img
                                                    src=" {{ !empty($product['image']['name']) ? Storage::disk('public')->url('storage/img/products/'. $product['image']['name']) : 'https://biothal.com.ua/image/cache/no_image-100x100.png'}}"
                                                    alt="" class="img-thumbnail" style="height: 150px;"/>
                                            </td>
                                            <td class="text-left"> {{ $product['product_description']['name'] }}</td>
                                            <td class="text-right">
                                                @if(!empty($product['price_with_sale']))
                                                    {{ceil($product['price_with_sale'])}}
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
                                                @if(!empty($product['price_with_sale']))
                                                    <button type="button" id="delete_sale" data-id="{{ $product['id'] }}" class="btn btn-dark" data-title="tooltip"
                                                            data-placement="top">Очистить скидки
                                                    </button>
                                                @endif
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

    <div class="modal hide bd-example-modal-lg" id="choice_your_sale_modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Присвоить скидку</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <select class="custom-select" id="select_sale_name" name="sale_name">
                            @if($sales != null)
                                <option value="NoValue">Выберите скидку</option>
                                @foreach($sales as $sale)
                                    <option value="{{$sale->id}}">{{$sale->title}}</option>
                                @endforeach
                            @else
                                <option value="NoValue">Скидок нет</option>
                            @endif
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="" id="sale_first_date_prev" disabled/>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="" id="sale_last_date_prev" disabled/>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="" id="sale_percent_prev" disabled/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="b_confirm_your_sales" class="btn btn-warning">Выбрать скидку</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_global_sale" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         style="margin-top: 10%" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="example_modal_label">Введите глобальную сумму скидки и процент</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Введите
                                сумму</span>
                            </div>
                            <input type="number" min="1" class="form-control"
                                   style="font-weight: bold; background: #F7F7F7;" id="sum_modal">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Введите
                                процент</span>
                            </div>
                            <input type="number" min="1" max="100" class="form-control"
                                   style="font-weight: bold; background: #F7F7F7;" id="procent_modal">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                            <span rel="/globalsale" id="global_sale" type="submit"
                                  style="margin-top: 10px; width: 225px; padding: 10px" class="btn btn-success btn-myBuy">Добавить глобальную скидку</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

@section('script')
    <script src="{{asset('js/products.js')}}"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script>

        $('#input-title-product').on('keyup', function (e) {
          var text = $('#input-title-product').val();
          var url = new URL($("#filter-href").attr("href"));
          var searchParams = new URLSearchParams(url.search);
          if(text != '') {
            searchParams.set("title_product", text);
          } else {
            searchParams.delete("title_product");
          }
          $("#filter-href").attr("href", url.origin + url.pathname + "?" + searchParams.toString());
        })

        $('#input-status').change(function () {
            var status = $(this).val();
            var url = new URL($("#filter-href").attr("href"));
            var searchParams = new URLSearchParams(url.search);

            if(status != '') {
              searchParams.set("status", status);
            } else {
              searchParams.delete("status");
            }
            $("#filter-href").attr("href", url.origin + url.pathname + "?" + searchParams.toString());
        })

        $('#but-del').click(function () {
            if(confirm('Данное действие необратимо. Вы уверены?')) {
                var products_id = [];
                $.each($("input[name='selected[]']:checked"), function () {
                    products_id.push($(this).val());
                })
                $.ajax({
                    url: 'deleteProd',
                    type:"POST",
                    data: {ids:  JSON.stringify(products_id)},
                    success: function (response) {
                        location.reload();
                    }
                })
            }

        })
    </script>
@endsection
