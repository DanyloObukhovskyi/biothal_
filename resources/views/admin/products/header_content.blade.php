@extends('admin.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{asset('css/products.css')}}">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="prod-header border container-fluid">
        <div class="row page-header">
            <div class="container-fluid col-sm-12" >
                <div class="row">
                    <div class="h1-prod col-sm-6"><i class="fa fa-list"></i> Статьи</div>
                    <div class="pull-right col-sm-6">
                        <a href="createInformation" data-toggle="tooltip" title="Добавить" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                        <button id="but-del" type="button" data-toggle="tooltip" title="Удалить" class="btn btn-danger">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </div>
                    <div class="breadcrumb col-sm-12" style="background: none">
                        <div><a href="/admin/dashboard"><i class="fa fa-home fa-lg"></i></a></div>
                        <div style="margin-right: 5px">/ </div>
                        <div><a href="{{route('admin.products.pageNew')}}"> Статьи</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="border container-fluid" style="padding-left: 0;
        padding-right: 0;">
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
                                <td class="text-left"><a href="?OrderBy=name" class="asc">Название статьи</a></td>
                                <td class="text-right"><a href="?OrderBy=sort">Порядок сортировки</a></td>
                                <td class="text-right">Действие</td>
                            </tr>
                            </thead>
                            <tbody>
@endsection
