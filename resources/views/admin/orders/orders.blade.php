@extends('admin.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{asset('css/products.css')}}">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="prod-header border container-fluid">
        <div class="row page-header">
            <div class="container-fluid col-sm-12" >
                <div class="h1-prod col-sm-1">Заказы</div>
                <div class="pull-right col-sm-3">
                    <button type="submit" id="button-shipping" form="form-order" formaction="" formtarget="_blank" data-toggle="tooltip" title="Распечатать список доставки" class="btn btn-info"><i class="fa fa-truck"></i></button>
                    <button type="submit" id="button-invoice" form="form-order" formaction="" formtarget="_blank" data-toggle="tooltip" title="Показать счет" class="btn btn-info"><i class="fa fa-print"></i></button>
                    <a href="" data-toggle="tooltip" title="Добавить" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                    <button id="but-del" type="button" data-toggle="tooltip" title="Удалить" class="btn btn-danger" onclick="confirm('Данное действие необратимо. Вы уверены?') ? $('#form-product').submit() : false;"><i class="fa fa-trash-o"></i></button>
                </div>
                <div class="col-sm-8">
                </div>
                <div class="breadcrumb col-sm-3" style="background: none">
                    <div><a href="/admin/dashboard"><i class="fa fa-home fa-lg"></i></a></div>
                    <div><a href="">/ Заказы</a></div>
                </div>

            </div>
        </div>
    </div>
    <div class="panel-heading">
        <h5 class="panel-title"><i class="fa fa-list"></i> Заказы</h5>
    </div>
    <div class="border container-fluid">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="well">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="input-order-id">№ Заказа</label>
                                <input type="text" name="filter_order_id" value="" placeholder="№ Заказа" id="input-order-id" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-customer">Клиент</label>
                                <input type="text" name="filter_customer" value="" placeholder="Клиент" id="input-customer" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="input-order-status">Статус заказа</label>
                                <select name="filter_order_status" id="input-order-status" class="form-control">
                                    <option value="*"></option>
                                    <option value="0">Пропавшие заказы</option>
                                    <option value="24">В обработке</option>
                                    <option value="18">Возврат</option>
                                    <option value="11">Дозаказ</option>
                                    <option value="21">на карту, отправлен</option>
                                    <option value="22">На карту, предзаказ</option>
                                    <option value="17">Наложка</option>
                                    <option value="20">наложка предзаказ</option>
                                    <option value="10">Недозвон 1</option>
                                    <option value="14">Недозвон 2</option>
                                    <option value="1">Новый</option>
                                    <option value="15">Ожидаем оплату</option>
                                    <option value="16">Оплачен</option>
                                    <option value="3">Отменён</option>
                                    <option value="23">Отправлен в 1С</option>
                                    <option value="19">отправлен наложка</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-total">Итого</label>
                                <input type="text" name="filter_total" value="" placeholder="Итого" id="input-total" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="input-date-added">Дата добавления</label>
                                <div class="input-group date">
                                    <input type="text" name="filter_date_added" value="" placeholder="Дата добавления" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control" />
                                    <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-date-modified">Дата изменения</label>
                                <div class="input-group date">
                                    <input type="text" name="filter_date_modified" value="" placeholder="Дата изменения" data-date-format="YYYY-MM-DD" id="input-date-modified" class="form-control" />
                                    <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
                            </div>
                            <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-filter"></i> Фильтр</button>
                        </div>
                    </div>
                </div>
                <form method="post" action="" enctype="multipart/form-data" id="form-order">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                <td class="text-right">                    <a href="" class="desc">№ Заказа</a>
                                </td>
                                <td class="text-left">                    <a href="">Клиент</a>
                                </td>
                                <td class="text-left">                    <a href="">Статус</a>
                                </td>
                                <td class="text-right">                    <a href="">Итого</a>
                                </td>
                                <td class="text-left">                    <a href="">Дата добавления</a>
                                </td>
                                <td class="text-left">                    <a href="">Дата изменения</a>
                                </td>
                                <td class="text-right">Действие</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="selected[]" value="4681" />
                                    <input type="hidden" name="shipping_code[]" value="pickup.pickup" /></td>
                                <td class="text-right">4681</td>
                                <td class="text-left">Яна Маргарян</td>
                                <td class="text-left">Отправлен в 1С</td>
                                <td class="text-right">540 грн</td>
                                <td class="text-left">28.01.2021</td>
                                <td class="text-left">28.01.2021</td>
                                <td class="text-right"><a href="/admin/orders/viewOrders" data-toggle="tooltip" title="Посмотреть" class="btn btn-info"><i class="fa fa-eye"></i></a> <a href="" data-toggle="tooltip" title="Редактировать" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
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
    <script type="text/javascript">
        $('#button-filter').on('click', function() {
            url =/*'index.php?route=sale/order&token=B9lVR0mNByKiJk1XcXngD7nQNkUU4Hs8'*/;

            var filter_order_id = $('input[name=\'filter_order_id\']').val();

            if (filter_order_id) {
                url += '&filter_order_id=' + encodeURIComponent(filter_order_id);
            }

            var filter_customer = $('input[name=\'filter_customer\']').val();

            if (filter_customer) {
                url += '&filter_customer=' + encodeURIComponent(filter_customer);
            }

            var filter_order_status = $('select[name=\'filter_order_status\']').val();

            if (filter_order_status != '*') {
                url += '&filter_order_status=' + encodeURIComponent(filter_order_status);
            }

            var filter_total = $('input[name=\'filter_total\']').val();

            if (filter_total) {
                url += '&filter_total=' + encodeURIComponent(filter_total);
            }

            var filter_date_added = $('input[name=\'filter_date_added\']').val();

            if (filter_date_added) {
                url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
            }

            var filter_date_modified = $('input[name=\'filter_date_modified\']').val();

            if (filter_date_modified) {
                url += '&filter_date_modified=' + encodeURIComponent(filter_date_modified);
            }

            location = url;
        });
        </script>
    <script type="text/javascript">
        $('input[name=\'filter_customer\']').autocomplete({
            'source': function(request, response) {
                $.ajax({
                    url: /*'index.php?route=customer/customer/autocomplete&token=B9lVR0mNByKiJk1XcXngD7nQNkUU4Hs8&filter_name='*/ +  encodeURIComponent(request),
                    dataType: 'json',
                    success: function(json) {
                        response($.map(json, function(item) {
                            return {
                                label: item['name'],
                                value: item['customer_id']
                            }
                        }));
                    }
                });
            },
            'select': function(item) {
                $('input[name=\'filter_customer\']').val(item['label']);
            }
        });
        //--></script>
    <script type="text/javascript">
        $('input[name^=\'selected\']').on('change', function() {
            $('#button-shipping, #button-invoice').prop('disabled', true);

            var selected = $('input[name^=\'selected\']:checked');

            if (selected.length) {
                $('#button-invoice').prop('disabled', false);
            }

            for (i = 0; i < selected.length; i++) {
                if ($(selected[i]).parent().find('input[name^=\'shipping_code\']').val()) {
                    $('#button-shipping').prop('disabled', false);

                    break;
                }
            }
        });

        $('#button-shipping, #button-invoice').prop('disabled', true);

        $('input[name^=\'selected\']:first').trigger('change');

        // IE and Edge fix!
        $('#button-shipping, #button-invoice').on('click', function(e) {
            $('#form-order').attr('action', this.getAttribute('formAction'));
        });

        $('#button-delete').on('click', function(e) {
            $('#form-order').attr('action', this.getAttribute('formAction'));

            if (confirm('Данное действие необратимо. Вы уверены?')) {
                $('#form-order').submit();
            } else {
                return false;
            }
        });
        </script>
    <script src="{{asset('js/products.js')}}"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
@endsection
