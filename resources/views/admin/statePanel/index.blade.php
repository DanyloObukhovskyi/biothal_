@extends('admin.layouts.app')

@section('content')
    {{--  MODAL  --}}
    <div class="modal hide bd-example-modal-lg" id="state_panel_modal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="change_shop_cart">
                        <div class="form-row mb-3">
                            <div class="form-group col-md-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Дата заказа</span>
                                    </div>
                                    <input type="text" class="form-control" id="date" placeholder="Дата"
                                           name="attribute_title">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Статус</span>
                                    </div>
                                    <select class="custom-select" id="status" name="status">
                                        @foreach($statuses as $key => $status)
                                            <option value="{{$key}}">{{$status}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Стоимость всех товаров</span>
                            </div>
                            <input type="text" class="form-control" id="full_price" placeholder="Полная стоимость"
                                   name="attribute_title">
                        </div>
                    </div>
                    <div class="container-fluid m-2">
                        <table class="table" id="products_state_panel_table">
                            <thead class="text-center">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Изображение</th>
                                <th scope="col">Название товара</th>
                                <th scope="col">Количество</th>
                                <th scope="col">Скидка</th>
                                <th scope="col">Цена</th>
                                <th scope="col">Цена * Количество</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="b_change_shopping_cart" data-id=""
                            class="btn btn-warning position-relative">
                        Внести изменения
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{--  PAGE  --}}
    <div class="container-fluid m-2">
        <table class="table">
            <thead class="text-center">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Номер Заказа</th>
                <th scope="col">Статус заказа</th>
                <th scope="col">ФИО</th>
                <th scope="col">Дата заказа</th>
                <th scope="col">Товары</th>
                <th scope="col">Full Price</th>
                <th scope="col">Редактировать</th>
            </tr>
            </thead>
            <tbody class="text-center">
            <tr>
                <td scope="row">1</td>
                <td scope="row">2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>кнопка</td>
            </tr>
            </tbody>
        </table>
        <div class="container">
            <table class="table" id="state_panel_table">
                <thead class="text-center">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Дата заказа</th>
                    <th scope="col">Полная стоимость</th>
                    <th scope="col">Редактировать</th>
                    <th scope="col">Товары</th>
                </tr>
                </thead>
                <tbody class="text-center">
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('js/statePanel.js')}}"></script>
@endsection
