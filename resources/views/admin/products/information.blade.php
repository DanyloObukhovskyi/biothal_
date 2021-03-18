@extends('admin.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{asset('css/products.css')}}">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="prod-header border container-fluid">
            <div class="row page-header">
                <div class="container-fluid col-sm-12" >
                    <div class="h1-prod col-sm-1">Статьи</div>
                    <div class="pull-right col-sm-3">
                        <a href="createInformation" data-toggle="tooltip" title="Добавить" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                        <button id="but-del" type="button" data-toggle="tooltip" title="Удалить" class="btn btn-danger">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </div>
                    <div class="col-sm-8">
                    </div>
                    <div class="breadcrumb col-sm-3" style="background: none">
                        <div><a href="/admin/dashboard"><i class="fa fa-home fa-lg"></i></a></div>
                        <div><a href="">/ Статьи</a></div>
                    </div>

                </div>
            </div>
    </div>
    <div class="panel-heading">
        <h5 class="panel-title"><i class="fa fa-list"></i> Статьи</h5>
    </div>
    <div class="border container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data" id="form-product">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td style="width: 1px;" class="text-center">
                                        <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" />
                                    </td>
                                    <td class="text-left"><a href="" class="asc">Название статьи</a></td>
                                    <td class="text-right"><a href="">Порядок сортировки</a></td>
                                    <td class="text-right">Действие</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($articles as $article)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" name="selected[]" value="{{ $article->information_id }}" />
                                        </td>
                                        <td class="text-left">{{ $article->attributes->title }}</td>
                                        <td class="text-right">{{ $article->sort_order }}</td>
                                        <td class="text-right"><a href="changeInformation/{{ $article->information_id }}" data-toggle="tooltip" title="Редактировать" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-sm-6 text-left">{{ $articles->links() }}</div>
                        <div class="col-sm-6 text-right">Показано с 1 по {{ $articles->lastItem() }} из {{ $articles->total() }} (страниц: {{ $articles->lastPage() }})</div>
                    </div>
                </div>
            </div>
    </div>
    @endsection

@section('script')
    <script src="{{asset('js/products.js')}}"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        $('#but-del').click(function () {
            if(confirm('Данное действие необратимо. Вы уверены?')) {
                var products_id = [];
                $.each($("input[name='selected[]']:checked"), function () {
                    products_id.push($(this).val());
                })
                console.log(products_id);
                $.ajax({
                    url: 'deleteInformation',
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
