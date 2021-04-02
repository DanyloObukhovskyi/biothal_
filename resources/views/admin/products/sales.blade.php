@extends('admin.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{asset('css/products.css')}}">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <style>
        .input-group {
            display: flex;
        }
    </style>
@endsection

@section('content')
    <div class="modal hide" id="add_sales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="example_modal_label">Добавить скидку</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Название скидки</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Название скидки" id="title_add"
                               aria-label="Category name" aria-describedby="basic-addon1" name="title_add"
                               autocomplete="off">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="start_date_add">Дата начала скидки</label>
                        </div>
                        <input type="date" class="form-control" placeholder="Введите дату начала скидки" id="start_date_add" name="start_date_add">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="end_date_add">Дата окончания скидки</label>
                        </div>
                        <input type="date" class="form-control" placeholder="Введите дату начала скидки" id="end_date_add" name="end_date_add">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="procent_add">Процент скидки</label>
                        </div>
                        <input type="number" class="form-control" placeholder="Введите процент скидки" min="1"
                               max="9999" id="procent_add" name="procent_add">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="add_sale" class="btn btn-primary">Добавить</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="change_sales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="example_modal_label">Изменить категорию</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Название скидки</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Название скидки" id="title_edit"
                               aria-label="Category name" aria-describedby="basic-addon1" name="title_edit"
                               autocomplete="off">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="start_date_edit">Дата начала скидки</label>
                        </div>
                        <input type="date" class="form-control" placeholder="Введите дату начала скидки" id="start_date_edit" name="start_date_edit">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="end_date_edit">Дата окончания скидки</label>
                        </div>
                        <input type="date" class="form-control" placeholder="Введите дату начала скидки" id="end_date_edit" name="end_date_edit">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="procent_edit">Процент скидки</label>
                        </div>
                        <input type="number" class="form-control" placeholder="Введите процент скидки" min="1"
                               max="9999" id="procent_edit" name="procent_edit">
                    </div>
                </div>
                <input type="hidden" name="category_hidden_id" id="sale_hidden_id" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="b_change_sale">Изменить</button>
                </div>
            </div>
        </div>
    </div>

    <div class="prod-header border container-fluid">
        <div class="row page-header">
            <div class="container-fluid col-sm-12" >
                <div class="row">
                    <div class="h1-prod col-sm-6"><i class="fa fa-list"></i> Скидки</div>
                    <div class="pull-right col-sm-6">
                        <a href="javascript" data-target="#add_sales" data-toggle="modal" title="Добавить" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                        <button id="delete_sale" type="button" data-toggle="tooltip" title="Удалить" class="btn btn-danger">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </div>
                    <div class="breadcrumb col-sm-12 pull-left" style="background: none">
                        <div><a href="/admin/dashboard"><i class="fa fa-home fa-lg"></i></a></div>
                        <div style="margin-right: 5px">/ </div>
                        <div><a href=""> Скидки</a></div>
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
                    @if($sales == null)
                        <p>Скидки отсутствуют ¯\_(ツ)_/¯</p>
                    @else
                        <div class="container-fluid m-2">
                            <table class="table" id="sales_table" style="width:100%">
                                <thead class="text-center">
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Название скидки</th>
                                    <th scope="col">Дата начала скидки</th>
                                    <th scope="col">Дата окончания скидки</th>
                                    <th scope="col">Процент скидки %</th>
                                    <th scope="col">Редактировать</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        $('.summernote').summernote();
    </script>
    <script src="{{asset('js/categories.js')}}"></script>
    <script>
        $(function () {
            var table = $('#sales_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/admin/products/discountList",
                columns: [
                    {"data": "number", "name": "id"},
                    {"data": "title", "name": "title"},
                    {"data": "first_date", "name": "first_date"},
                    {"data": "last_date", "name": "last_date"},
                    {"data": "percent", "name": "percent"},
                    // {"data": "is_demand", "name": "is_demand"},
                    {"data": 'action', "orderable": false, "searchable": false},
                ],
                select: {
                    style: 'multi',
                    selector: 'td:not(:last-child)'
                },
            });

            $(document).on("click", "#b_change_sale", function () {
                let title = $('#title_edit').val();
                let start_date = $('#start_date_edit').val();
                let end_date = $('#end_date_edit').val();
                let procent = $('#procent_edit').val();
                let id = $("#sale_hidden_id").val();

                $.ajax({
                    url: '/admin/products/editSale',
                    method: 'POST',
                    data: {
                        "title": title,
                        "first_date": start_date,
                        "last_date": end_date,
                        "percent": procent,
                        "id": id
                    },
                    error: function (xhr, status, error) {
                        var errors = xhr.responseJSON.errors, errorMessage = "";
                        $.each(errors, function (index, value) {
                            $.each(value, function (key, message) {
                                errorMessage += message + " ";
                            })
                        })
                        Swal.fire({
                            icon: 'error',
                            title: errorMessage,
                            showConfirmButton: true,
                        })
                    },
                    success: function (resp) {

                        // Меняем категорию
                        if (resp['message']) {
                            $('#change_sales').modal('hide');
                            $('.modal-backdrop').remove();
                            table.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: resp['message'],
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    }
                })
            });

            // Добавление скидок
            $(document).on("click", '#add_sale', function () {
                let title = $('#title_add').val();
                let start_date = $('#start_date_add').val();
                let end_date = $('#end_date_add').val();
                let procent = $('#procent_add').val();


                $.ajax({
                    url: '/admin/products/addSale',
                    method: 'POST',
                    data: {
                        "title": title,
                        "first_date": start_date,
                        "last_date": end_date,
                        "percent": procent
                    },
                    error: function (xhr, status, error) {
                        var errors = xhr.responseJSON.errors, errorMessage = "";
                        $.each(errors, function (index, value) {
                            $.each(value, function (key, message) {
                                errorMessage += message + " ";
                            })
                        })
                        Swal.fire({
                            icon: 'error',
                            title: errorMessage,
                            showConfirmButton: true,
                        })
                    },
                    success: function (resp) {
                        if (resp['message']) {
                            $('#add_sales').modal('hide');
                            $('.modal-backdrop').remove();
                            table.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: resp['message'],
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            window.location.replace("/admin/products/sales");
                        }
                    }
                });
            })

            $(document).on("click", "[id^=sales_change]", function () {
                let id = $(this).data('id');
                let title = $(this).data('title');
                let start_date = $(this).data('start_date');
                let end_date = $(this).data('end_date');
                let percent = $(this).data('percent');

                $("#title_edit").val(title); // Title
                $("#sale_hidden_id").val(id);     // Id
                $("#start_date_edit").val(start_date);
                $("#end_date_edit").val(end_date);
                $("#procent_edit").val(percent);
            })


            $(document).on("click", "#delete_sale", function () {
                var data = table.rows({selected: true}).data(), arr = [], count = table.rows({selected: true}).count();
                if (count !== 0) {
                    for (var i = 0; i < count; i++) {
                        arr[i] = data[i]['id'];
                    }
                }
                $.ajax({
                    url: '/admin/products/deleteSale',
                    method: 'POST',
                    data: {"checked": arr, "status": 0},
                    error: function (xhr, status, error) {
                        var errors = xhr.responseJSON.errors, errorMessage = "";
                        console.log(errors);
                        $.each(errors, function (index, value) {
                            $.each(value, function (key, message) {
                                errorMessage += message + " ";
                            })
                        })
                        Swal.fire({
                            icon: 'error',
                            title: errorMessage,
                            showConfirmButton: true,
                        })
                    },
                    success: function (resp) {
                        // Если родительская категория не выбрана, удаляем выбранные категории
                        if (resp['accepted']) {
                            table.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: resp['accepted'],
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                        if (resp['warning']) {
                            // Если роительская категория выбрана, уточняем у пользователя уверен ли он в своем выборе
                            Swal.fire({
                                title: resp['warning']['title'],
                                text: resp['warning']['text'],
                                showDenyButton: true,
                                showCancelButton: false,
                                confirmButtonText: 'Удалить',
                                denyButtonText: 'Отмена'
                            }).then((result) => {
                                // Если уверен, удаляем
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: '/admin/products/deleteSale',
                                        method: 'POST',
                                        data: {"checked": arr, "status": 1},
                                        success: function (ret) {
                                            if (ret['status']) {
                                                if (ret['accepted']) {
                                                    table.ajax.reload();
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: ret['accepted'],
                                                        showConfirmButton: false,
                                                        timer: 1500
                                                    });
                                                }
                                                if (ret['error']) {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: resp['error'],
                                                        timer: 1700,
                                                        showConfirmButton: false,
                                                    })
                                                }
                                            } else {
                                                window.location.replace("/admin/products/sales");
                                            }
                                        }
                                    })
                                    // Если нет, отменяем
                                } else if (result.isDenied) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Скидки не удалены',
                                        timer: 1300,
                                        showConfirmButton: false,
                                    })
                                }
                            })
                        }
                        if (resp['error']) {
                            Swal.fire({
                                icon: 'error',
                                title: resp['error'],
                                timer: 1700,
                                showConfirmButton: false,
                            })
                        }
                    }
                })
            })
        });
    </script>
@endsection
