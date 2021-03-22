@extends('admin.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{asset('css/products.css')}}">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')

    <div class="prod-header border container-fluid">
        <div class="row page-header">
            <div class="container-fluid col-sm-12">
                <div class="h1-prod col-sm-1">Статьи</div>
                <div class="pull-right col-sm-3">
                    <button type="submit" form="form-information" data-toggle="tooltip" title="Сохранить" class="btn btn-primary"><i class="fa fa-save"></i></button>
                    <a href="#" data-toggle="tooltip" title="Отменить" class="btn btn-default"><i class="fa fa-reply"></i></a>
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
    <div id="content">
        <div class="container-fluid">
            <div class="panel panel-default">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                @endif
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-pencil"></i> Редактирование</h3>
                </div>
                <div class="panel-body">
                    <form action="/admin/products/updateInformation/{{  $article->information_id }}" method="post" enctype="multipart/form-data" id="form-information" class="form-horizontal">
                        @csrf
                        <ul class="nav nav-tabs">
                            <li><a class="nav-link active" href="#tab-general" data-toggle="tab">Основное</a></li>
                            <li><a class="nav-link" href="#tab-data" data-toggle="tab">Данные</a></li>
                            <li><a class="nav-link" href="#tab-design" data-toggle="tab">Дизайн</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-general">
                                <ul class="nav nav-tabs" id="language">
                                    <li class="active"><a href="#language1" data-toggle="tab"><img src="{{ url('image/en-gb.png')}}" title="English" /> English</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane" id="language_1">
                                        <br>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label required" for="input-title1">Название статьи</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="title" value="{{ $article->attributes->title }}" placeholder="Название статьи" id="input-title1" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label required" for="input-description1">Описание</label>
                                            <div class="col-sm-10">
                                                <textarea id="summernote" name="description" placeholder="Описание" id="input-description1" class="form-control summernote" >{{ html_entity_decode ($article->attributes->description) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label required" for="input-meta-title1">Мета-тег Title</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="meta_title" value="{{ $article->attributes->meta_title }}" placeholder="Мета-тег Title" id="input-meta-title1" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-meta-description1">Мета-тег Description</label>
                                            <div class="col-sm-10">
                                                <textarea name="meta_description" rows="5" placeholder="Мета-тег Description" id="input-meta-description1" class="form-control">{{ $article->attributes->meta_description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-meta-keyword1">Мета-тег Keywords</label>
                                            <div class="col-sm-10">
                                                <textarea name="meta_keyword" rows="5" placeholder="Мета-тег Keywords" id="input-meta-keyword1" class="form-control">{{ $article->attributes->meta_keywords }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-data">
                                <br>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label required" for="input-keyword"><span data-toggle="tooltip" title="Должно быть уникальным на всю систему и без пробелов">SEO URL</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="keyword" value="{{ $url->keyword }}" placeholder="SEO URL" id="input-keyword" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-bottom"><span data-toggle="tooltip" title="Показывать в нижней части сайта (футер, подвал)">Отображить снизу</span></label>
                                    <div class="col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="bottom" {{ $article->bottom === 1 ? 'checked' : '' }} id="input-bottom" />
                                                &nbsp; </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-status">Статус</label>
                                    <div class="col-sm-10">
                                        <select name="status" id="input-status" class="form-control">
                                            <option value="1" {{ $article->status === 1 ? 'selected' : '' }}>Включено</option>
                                            <option value="0" {{ $article->status === 0 ? 'selected' : '' }}>Отключено</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-sort-order">Порядок сортировки</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="sort_order" value="{{ $article->sort_order }}" placeholder="Порядок сортировки" id="input-sort-order" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-design">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <td class="text-left">Магазины</td>
                                            <td class="text-left">Выберите схему</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-left">Основной магазин</td>
                                            <td class="text-left"><select name="information_layout" class="form-control">
                                                    <option value=""></option>
                                                    <option {{ $article->layout->layout_id === 3 ? 'selected' : '' }} value="3">Category</option>
                                                    <option {{ $article->layout->layout_id === 7 ? 'selected' : '' }} value="7">Checkout</option>
                                                    <option {{ $article->layout->layout_id === 8 ? 'selected' : '' }} value="8">Contact</option>
                                                    <option {{ $article->layout->layout_id === 4 ? 'selected' : '' }} value="4">Default</option>
                                                    <option {{ $article->layout->layout_id === 1 ? 'selected' : '' }} value="1">Home</option>
                                                    <option {{ $article->layout->layout_id === 11 ? 'selected' : '' }} value="11">Information</option>
                                                    <option {{ $article->layout->layout_id === 16 ? 'selected' : '' }} value="16">O Biothal</option>
                                                    <option {{ $article->layout->layout_id === 2 ? 'selected' : '' }} value="2">Product</option>
                                                    <option {{ $article->layout->layout_id === 19 ? 'selected' : '' }} value="19">Водоросли</option>
                                                    <option {{ $article->layout->layout_id === 23 ? 'selected' : '' }} value="23">Контакты</option>
                                                    <option {{ $article->layout->layout_id === 18 ? 'selected' : '' }} value="18">Море</option>
                                                    <option {{ $article->layout->layout_id === 20 ? 'selected' : '' }} value="20">Производство</option>
                                                    <option {{ $article->layout->layout_id === 17 ? 'selected' : '' }} value="17">Философия</option>
                                                </select></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection

@section('script')
    <script type="text/javascript">
        var apt_row = 2;
        function addApt(lang_id) {
            html  = '<div id="apt_row_' + lang_id + '_' + apt_row + '" class="row" style="margin-bottom: 20px">';
            html += '<div class="col-sm-2"><input type="text" name="product_apt_name[' + lang_id + '][]" value="" id="apt_name' + apt_row + '" class="form-control" /></div>';
            html += '<div class="col-sm-8"><textarea name="product_apt_desc[' + lang_id + '][]"  id="apt_desc_1' + apt_row + '" cols="45" rows="5" ></textarea></div>';
            html += '<div class="col-sm-1"><input type="text" name="tab_sort_order[' + lang_id + '][]" value="" id="sort_order' + apt_row + '" size="5" class="form-control"/></div>';
            html += '<div class="col-sm-1"><a onclick="$(\'#apt_row_' + lang_id + '_' + apt_row  + '\').remove();" class="btn btn-danger"><i class="fa fa-minus-circle fa-fw"></i></a></div>';
            html += '</div>';

            $('#apts_' + lang_id + ' #put-here').before(html);
            $('#apt_desc_' + lang_id + '_' + apt_row).summernote({height: 300});
            apt_row++;
        }
    $('#languages_apt a:first').tab('show');
    </script>
    <script type="text/javascript">
        $('#language a:first').tab('show');
        $('#option a:first').tab('show');
    </script>
    <script src="{{asset('js/products.js')}}"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        $('.summernote').summernote();
    </script>
@endsection
