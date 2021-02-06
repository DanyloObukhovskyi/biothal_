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
                <div class="h1-prod col-sm-1">Товары</div>
                <div class="pull-right col-sm-3">
                    <button type="submit" form="form-product" data-toggle="tooltip" title="Сохранить" class="btn btn-primary">
                        <i class="fa fa-save"></i>
                    </button>
                    <a href="#" data-toggle="tooltip" title="Отменить" class="btn btn-default">
                        <i class="fa fa-reply"></i>
                    </a>
                </div>
                <div class="col-sm-8">
                </div>
                <div class="breadcrumb col-sm-3" style="background: none">
                    <div><a href="/admin/dashboard"><i class="fa fa-home fa-lg"></i></a></div>
                    <div><a href="">/ Товары</a></div>
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-pencil"></i> Редактирование</h3>
                </div>
                <div class="panel-body">
                    <form action="#" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab-general" role="tab" aria-controls="home" aria-selected="true">Основное</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-data" role="tab" aria-controls="home" aria-selected="false">Данные</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-links" role="tab" aria-controls="home" aria-selected="false">Связи</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-image" role="tab" aria-controls="home" aria-selected="false">Изображения</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-apt" role="tab" aria-controls="home" aria-selected="false">Вкладки</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            @include('admin.products.tabs.general')
                            @include('admin.products.tabs.data')
                            @include('admin.products.tabs.links')
                            @include('admin.products.tabs.image')
                            @include('admin.products.tabs.apt')
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
    var apt_row = {{ $product->productApts->count() }};
    function addAptengb() {
        html  = '<div id="apt_rowen-gb' + apt_row + '" class="row" style="margin-bottom: 20px">';
        html += '<div class="col-sm-2"><input type="text" name="product_apt_name[en-gb][]" value="" id="apt_name' + apt_row + '" class="form-control" /></div>';
        html += '<div class="col-sm-8"><textarea name="product_apt_desc[en-gb][]"  id="apt_desc_1' + apt_row + '" cols="45" rows="5" ></textarea></div>';
        html += '<div class="col-sm-1"><input type="text" name="tab_sort_order[en-gb][]" value="" id="sort_order' + apt_row + '" size="5" class="form-control"/></div>';
        html += '<div class="col-sm-1"><a onclick="$(\'#apt_rowen-gb' + apt_row  + '\').remove();" class="btn btn-danger"><i class="fa fa-minus-circle fa-fw"></i></a></div>';
        html += '</div>';

        $('#aptsen-gb #put-here').before(html);
        $('#apt_desc_1'+apt_row).summernote({height: 300});
        apt_row++;
    }
    $('#languages_apt a:first').tab('show');
</script>
<script type="text/javascript">
  var image_row = {{ $product->productImages->count() }};

  function addImage() {
    html  = '<tr id="image-row' + image_row + '">';
    html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '"data-toggle="image" class="img-thumbnail"><img src="https://biothal.com.ua/image/cache/no_image-100x100.png" alt="" title="" data-placeholder="https://biothal.com.ua/image/cache/no_image-100x100.png" /></a><input type="hidden" name="product_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
    html += '  <td class="text-right" style="vertical-align: middle;"><input type="text" name="product_image[' + image_row + '][sort_order]" value="" placeholder="Порядок сортировки" class="form-control" /></td>';
    html += '  <td class="text-left" style="vertical-align: middle;"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="Удалить" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#images tbody').append(html);

    image_row++;
  }
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
