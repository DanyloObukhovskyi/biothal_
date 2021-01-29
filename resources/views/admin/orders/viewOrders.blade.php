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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> Заказ</h3>
                    </div>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td style="width: 1%;"><button data-toggle="tooltip" title="Магазин" class="btn btn-info btn-xs"><i class="fa fa-shopping-cart fa-fw"></i></button></td>
                            <td><a href="https://3.140.132.208/" target="_blank">Biothal</a></td>
                        </tr>
                        <tr>
                            <td><button data-toggle="tooltip" title="Дата добавления" class="btn btn-info btn-xs"><i class="fa fa-calendar fa-fw"></i></button></td>
                            <td>28.01.2021</td>
                        </tr>
                        <tr>
                            <td><button data-toggle="tooltip" title="Способ оплаты" class="btn btn-info btn-xs"><i class="fa fa-credit-card fa-fw"></i></button></td>
                            <td>Оплата при получении</td>
                        </tr>
                        <tr>
                            <td><button data-toggle="tooltip" title="Способ доставки" class="btn btn-info btn-xs"><i class="fa fa-truck fa-fw"></i></button></td>
                            <td>Самовывоз из магазина</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user"></i> Клиент</h3>
                    </div>
                    <table class="table">
                        <tr>
                            <td style="width: 1%;"><button data-toggle="tooltip" title="Клиент" class="btn btn-info btn-xs"><i class="fa fa-user fa-fw"></i></button></td>
                            <td>                Яна Маргарян                </td>
                        </tr>
                        <tr>
                            <td><button data-toggle="tooltip" title="Группа клиентов" class="btn btn-info btn-xs"><i class="fa fa-group fa-fw"></i></button></td>
                            <td>Default</td>
                        </tr>
                        <tr>
                            <td><button data-toggle="tooltip" title="E-Mail" class="btn btn-info btn-xs"><i class="fa fa-envelope-o fa-fw"></i></button></td>
                            <td><a href="mailto:nomail@biothal.com.ua">nomail@biothal.com.ua</a></td>
                        </tr>
                        <tr>
                            <td><button data-toggle="tooltip" title="Телефон" class="btn btn-info btn-xs"><i class="fa fa-phone fa-fw"></i></button></td>
                            <td>+38(050)148-38-25</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-cog"></i> Опции</h3>
                    </div>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Счет</td>
                            <td id="invoice" class="text-right"></td>
                            <td style="width: 1%;" class="text-center">                  <button id="button-invoice" data-loading-text="Загрузка..." data-toggle="tooltip" title="Генерировать" class="btn btn-success btn-xs"><i class="fa fa-cog"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>Бонусные баллы</td>
                            <td class="text-right">0</td>
                            <td class="text-center">                  <button disabled="disabled" class="btn btn-success btn-xs"><i class="fa fa-plus-circle"></i></button>
                            </td>
                            <!-- NeoSeo Exchange 1c - begin -->
                        <tr>
                            <td>Выгрузить заказ в 1С:</td>
                            <td class="text-right"  colspan="2">
                                <input type="checkbox" id="order_export_exchange1c_status" name="order_export_exchange1c_status"  value="1" id="input-override" />
                            </td>
                        </tr>
                        <!-- NeoSeo Exchange 1c - end -->
                        </tr>
                        <tr>
                            <td>Партнер                  </td>
                            <td class="text-right">0 грн</td>
                            <td class="text-center">                  <button disabled="disabled" class="btn btn-success btn-xs"><i class="fa fa-plus-circle"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-info-circle"></i> Детали заказа № 4681</h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td style="width: 50%;" class="text-left">Адрес плательщика</td>
                        <td style="width: 50%;" class="text-left">Адрес доставки</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-left">Яна Маргарян<br />Отделение №111 (до 30 кг): ул. Драгомирова, 17<br />Киев<br />Киевская область</td>
                        <td class="text-left">Яна Маргарян<br />Отделение №111 (до 30 кг): ул. Драгомирова, 17<br />Киев<br />Киевская область</td>
                    </tr>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td class="text-left">Товар</td>
                        <td class="text-left">Модель</td>
                        <td class="text-right">Количество</td>
                        <td class="text-right">Цена за единицу</td>
                        <td class="text-right">Итого</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-left"><a href="">Соляной скраб для тела Водоросли Глина</a>
                        </td>
                        <td class="text-left">Соляной скраб для тела Водоросли Глина</td>
                        <td class="text-right">1</td>
                        <td class="text-right">540 грн</td>
                        <td class="text-right">540 грн</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">Стоимость товаров</td>
                        <td class="text-right">540 грн</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">Самовывоз из магазина</td>
                        <td class="text-right">0 грн</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">Всего к оплате</td>
                        <td class="text-right">540 грн</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-comment-o"></i> История заказа</h3>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-history" data-toggle="tab">История</a></li>
                    <li><a href="#tab-additional" data-toggle="tab">Дополнительно</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-history">
                        <div id="history"></div>
                        <br />
                        <fieldset>
                            <legend>Добавить в историю</legend>
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-order-status">Статус заказа</label>
                                    <div class="col-sm-10">
                                        <select name="order_status_id" id="input-order-status" class="form-control">
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
                                            <option value="23" selected="selected">Отправлен в 1С</option>
                                            <option value="19">отправлен наложка</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-override"><span data-toggle="tooltip" title="Если заказ заблокирован системой Защиты от мошенников, то устанавливая крыж, можно установить свой статус заказа, не зависимо от системы защиты.">Переопределить</span></label>
                                    <div class="col-sm-10">
                                        <input type="checkbox" name="override" value="1" id="input-override" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-notify">Уведомить покупателя</label>
                                    <div class="col-sm-10">
                                        <input type="checkbox" name="notify" value="1" id="input-notify" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-comment">Комментарий</label>
                                    <div class="col-sm-10">
                                        <textarea name="comment" rows="8" id="input-comment" class="form-control"></textarea>
                                    </div>
                                </div>
                            </form>
                        </fieldset>
                        <div class="text-right">
                            <button id="button-history" data-loading-text="Загрузка..." class="btn btn-primary"><i class="fa fa-plus-circle"></i> Добавить</button>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-additional">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td colspan="2">Browser</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>IP адрес</td>
                                    <td>128.124.116.30</td>
                                </tr>
                                <tr>
                                    <td>User Agent</td>
                                    <td>Mozilla/5.0 (iPhone; CPU iPhone OS 14_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0.2 Mobile/15E148 Safari/604.1</td>
                                </tr>
                                <tr>
                                    <td>Язык</td>
                                    <td>ru</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
