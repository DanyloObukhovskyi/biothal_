@extends('admin.layouts.app')

@section('content')
    <div class="modal hide" id="add_categ" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="example_modal_label">Добавить категорию</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3" id="tastingo">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="padre_category_select">Родительская
                                категория</label>
                        </div>
                        <select class="custom-select" id="padre_category_select" name="padre_category_select">
                            <option value="NoCategory">Без категории</option>
                            @if(!empty($categories))
                                @foreach($categories as $category)
                                    @if($category->is_demand == false)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="type_category_change">
                                Тип категории
                            </label>
                        </div>
                        <select class="custom-select" id="type_category_change"
                                name="type_category">
                            <option value="forProduct" class="no_category">Для товаров</option>
                            <option value="info">Информационная категория</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Название категории</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Название категории" id="category_title"
                               aria-label="Category name" aria-describedby="basic-addon1" name="title_category"
                               autocomplete="off">
                    </div>
{{--                    <input type="checkbox" id="demand" name="demand_category" value="check">--}}
{{--                    <label for="demand">--}}
{{--                        Категория - потребность--}}
{{--                    </label>--}}

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="ordering_category">Порядок сортировки</label>
                        </div>
                        <input type="number" class="form-control" placeholder="Введите номер для сортировки" min="1"
                               max="9999" id="ordering_category" name="ordering_category">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="add_category" class="btn btn-primary">Добавить</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="change_categ" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                            <label class="input-group-text" for="padre_category_select_change">Родительская
                                категория</label>
                        </div>
                        <select class="custom-select" id="padre_category_select_change"
                                name="padre_category_select">
                            <option value="NoCategory" class="no_category">Без категории</option>
                            @if($categories != null)
                                @foreach($categories as $category)
                                    @if($category->is_demand == false)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Название категории</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Название категории"
                               id="title_category_change" aria-label="Category name" aria-describedby="basic-addon1"
                               name="title_category" autocomplete="off">
                    </div>

                    <input type="checkbox" id="demand_change" name="demand_category" checked="" class="check_demand"
                           value="check">
                    <label for="demand">
                        Категория - потребность
                    </label>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="ordering_category">Параметр сортировки</label>
                        </div>
                        <input type="number" class="form-control" placeholder="Введите номер для сортировки" min="1"
                               max="9999" name="ordering_category_change" id="ordering_category_change" value="">
                    </div>
                </div>
                <input type="hidden" name="category_hidden_id" id="category_hidden_id" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="b_change_category">Изменить</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="category_page">
        <div class="page-header w-100 alert bg-light p-0 shadow-sm mt-2">
            <div class="btn-group" role="group" aria-label="Basic example">
                <div class="btn btn-group pull-right">
                    <span data-toggle="tooltip" data-placement="left" title="Добавить категорию">
                        <button type="button" data-toggle="modal" data-target="#add_categ" class="btn btn-dark">Добавить
                        </button>
                    </span>
                    <button type="button" id="delete_cat" class="btn btn-dark"
                            data-toggle="tooltip" data-placement="right" title="Удалить выбранные категории">Удалить
                    </button>
                </div>
            </div>
            @if($categories == null)
                <p>Категории отсутствуют ¯\_(ツ)_/¯</p>
            @else
                <div class="container-fluid m-2">
                    <table class="table" id="category_table" style="width:100%">
                        <thead class="text-center">
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Родительская категория</th>
                            <th scope="col">Название</th>
                            <th scope="col">Порядок сортировки</th>
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
@endsection

@section('script')
    <script src="{{asset('js/categories.js')}}"></script>
@endsection
