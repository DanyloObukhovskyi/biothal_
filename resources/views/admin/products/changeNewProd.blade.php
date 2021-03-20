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
                    <button type="submit" form="form-product" data-toggle="tooltip" title="Сохранить"
                            class="btn btn-primary"><i class="fa fa-save"></i></button>
                    <a href="#" data-toggle="tooltip" title="Отменить" class="btn btn-default"><i
                            class="fa fa-reply"></i></a>
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
                    <form action="#" method="post" enctype="multipart/form-data" id="form-product"
                          class="form-horizontal">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-general" data-toggle="tab">Основное</a></li>
                            <li><a href="#tab-data" data-toggle="tab">Данные</a></li>
                            <li><a href="#tab-links" data-toggle="tab">Связи</a></li>
                            <li><a href="#tab-image" data-toggle="tab">Изображения</a></li>
                            <li><a href="#tab-apt" data-toggle="tab">Вкладки</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" data-toggle="tab" id="tab-general">
                                <ul class="nav nav-tabs" id="language">
                                    <li><a href="#language1" data-toggle="tab"><img
                                                src="{{ Storage::disk('public')->url('image/en-gb.png')}}"
                                                title="English"/> English</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane" id="language1">
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-name1">Название
                                                товара</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="product_description[{{$product['id']}}][name]"
                                                       value="{{$product['productDescription']['name']}}"
                                                       placeholder="Название товара" id="input-name1"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"
                                                   for="input-description1">Описание</label>
                                            <div class="col-sm-10">
                                                <textarea id="summernote" name="product_description[{{$product['id']}}][description]"
                                                          placeholder="Описание" id="input-description1"
                                                          class="form-control summernote">
                                                    {{$product['productDescription']['description']}}
                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-meta-title1">Мета-тег
                                                Title</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="product_description[{{$product['id']}}][meta_title]"
                                                       value="{{$product['productDescription']['meta_title']}}"
                                                       placeholder="Мета-тег Title" id="input-meta-title1"
                                                       class="form-control"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-meta-h11">
                                                HTML тег H1 </label>

                                            <div class="col-sm-10">
                                                <input
                                                    type="text"
                                                    name="product_description[{{$product['id']}}][meta_h1]"
                                                    value="{{$product['productDescription']['meta_h1']}}"
                                                    placeholder="HTML тег H1"
                                                    id="input-meta-h11"
                                                    class="form-control"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-meta-description1">Мета-тег
                                                Description</label>
                                            <div class="col-sm-10">
                                                <textarea name="product_description[{{$product['id']}}][meta_description]" rows="5"
                                                          placeholder="Мета-тег Description"
                                                          id="input-meta-description1" class="form-control">
                                                    {{$product['productDescription']['meta_description']}}
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-meta-keyword1">Мета-тег
                                                Keyword</label>
                                            <div class="col-sm-10">
                                                <textarea name="product_description[{{$product['id']}}][meta_keyword]" rows="5"
                                                          placeholder="Мета-тег Keyword" id="input-meta-keyword1"
                                                          class="form-control">
                                                    {{$product['productDescription']['meta_keyword']}}
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-tag1"><span
                                                    data-toggle="tooltip"
                                                    title="теги разделяются запятой">Теги товара</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" name="product_description[{{$product['id']}}][tag]"
                                                       value="{{$product['productDescription']['tag']}}"
                                                       placeholder="Теги товара" id="input-tag1" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-data">
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="input-model">Модель</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="model"
                                               value="{{$product['model']}}" placeholder="Модель"
                                               id="input-model" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-sku"><span data-toggle="tooltip"
                                                                                                title="SKU или код производителя">Краткое описание</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="sku"
                                               value="{{$product['sku']}}"
                                               placeholder="Краткое описание" id="input-sku" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-upc"><span data-toggle="tooltip"
                                                                                                title="Универсальный код товара">Англ.название</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="upc" value="{{$product['upc']}}"
                                               placeholder="Англ.название" id="input-upc" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-ean"><span data-toggle="tooltip"
                                                                                                title="Европейский код товара">Артикул</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="ean" value="{{$product['ean']}}" placeholder="Артикул" id="input-ean"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-jan"><span data-toggle="tooltip"
                                                                                                title="Японский код товара">Объем</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="jan" value="{{$product['jan']}}" placeholder="Объем" id="input-jan"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-price">Цена</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="price" value="{{$product['price']}}" placeholder="Цена" id="input-price"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-quantity">Количество</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="quantity" value="{{$product['quantity']}}" placeholder="Количество"
                                               id="input-quantity" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-minimum"><span
                                            data-toggle="tooltip"
                                            title="Минимальное количество товара в заказе (меньше данного кол-ва товара, добавление в корзину будет запрещено )">Минимальное количество</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="minimum" value="{{$product['minimum']}}" placeholder="Минимальное количество"
                                               id="input-minimum" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-subtract">Вычитать со
                                        склада</label>
                                    <div class="col-sm-10">
                                        <select name="subtract" id="input-subtract" class="form-control">
                                            @foreach(config('products.product_subtract') as
                                                $product_subtract_key => $product_subtract)
                                                <option value="{{$product_subtract_key}}"
                                                       @if($product_subtract_key == $product['subtract'])
                                                            selected="selected"
                                                        @endif
                                                >
                                                    {{$product_subtract}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-stock-status"><span
                                            data-toggle="tooltip"
                                            title="Статус показывается, когда товара нет на складе">Отсутствие на складе</span></label>
                                    <div class="col-sm-10">
                                        <select name="stock_status_id" id="input-stock-status" class="form-control">
                                            @foreach($stock_statuses as $stock_status)
                                                <option value="{{$stock_status['stock_status_id']}}"
                                                    @if($stock_status['stock_status_id'] == $product['stock_status_id'])
                                                        selected="selected"
                                                    @endif>
                                                    {{$stock_status['name']}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-status">Статус</label>
                                    <div class="col-sm-10">
                                        <select name="status" id="input-status" class="form-control">
                                            @foreach(config('products.products_statuses') as
                                                $product_status_key => $product_status)
                                                <option value="{{$product_status_key}}"
                                                    @if ($product['status'] == $product_status_key)
                                                        selected="selected"
                                                    @endif>
                                                    {{$product_status}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-sort-order">Порядок
                                        сортировки</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                               name="sort_order"
                                               value="{{$product['sort_order']}}"
                                               placeholder="Порядок сортировки"
                                               id="input-sort-order" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-links">
                                <!-- NeoSeo Exchange 1c - begin -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-code_1c">Код 1С</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="code_1c" value="{{$product['productTo1C']['1c_id']}}"
                                               placeholder="Код 1С" id="input-code_1c" class="form-control"/>
                                    </div>
                                </div>
                                <!-- NeoSeo Exchange 1c - end -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-category">Main category:</label>
                                    <div class="col-sm-10">
                                        <select id="main_category_id" name="main_category_id" class="form-control">
                                            <option value="0"
                                                @if (empty($product['productCategory']['category_id']))
                                                    selected="selected"
                                                @endif> --- Не выбрано ---</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category['id']}}"
                                                    @if ($category['id'] == $product['productCategory']['category_id'])
                                                        selected="selected"
                                                    @endif
                                                >{{$category['full_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="tab-image">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <td class="text-left">Изображение товара</td>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <tr>
                                            <td class="text-left"><a href="" id="thumb-image" data-toggle="image"
                                                                     class="img-thumbnail"><img
                                                        src="{{url('image/products/' . $product->image->name)}}"
                                                        alt="" title=""
                                                        width="100"
                                                        data-placeholder="https://biothal.com.ua/image/cache/no_image-100x100.png"/></a><input
                                                    type="hidden" name="image"
                                                    value="catalog/maska-dlja-lica-konoplja-vodorosli.jpg"
                                                    id="input-image"/></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table id="images" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <td class="text-left">Дополнительные изображения</td>
                                            <td class="text-right">Порядок сортировки</td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($product->productImages as $key => $productImages)
                                            <tr id="image-row{{ $key }}">
                                                <td class="text-left">
                                                    <a href="" id="thumb-image{{ $key }}" data-toggle="image" class="img-thumbnail">
                                                        <img src="{{url('image/products/' . $productImages->image->name)}}" width="100" alt="" title="">
                                                    </a>
                                                    <input type="hidden" name="product_image[$key][image]" value="catalog/3.jpg" id="input-image0">
                                                </td>
                                                <td class="text-right" style="vertical-align: middle;">
                                                    <input type="text" name="product_image[{{ $key }}][sort_order]" value="{{ $productImages->sort_order }}" placeholder="Порядок сортировки" class="form-control">
                                                </td>
                                                <td class="text-left" style="vertical-align: middle;">
                                                    <button type="button" onclick="$('#image-row{{ $key }}').remove();" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Удалить">
                                                        <i class="fa fa-minus-circle"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="text-left">
                                                <button type="button" onclick="addImage();" data-toggle="tooltip"
                                                        title="Добавить" class="btn btn-primary"><i
                                                        class="fa fa-plus-circle"></i></button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-apt">
                                <div class="tab-content">
                                    <ul class="nav nav-tabs" id="languages_apt">
                                        <li><a href="#language_apt1" data-toggle="tab"><img
                                                    src="{{ Storage::disk('public')->url('image/en-gb.png')}}"
                                                    title="English"/> English</a></li>
                                    </ul>
                                    <div class="tab-pane" id="language_apt1">
                                        <div>
                                            <div class="row"
                                                 style="font-size: 14px;font-weight: bold;margin-bottom: 17px;border-bottom: 2px solid #ccc;padding-bottom: 10px;">
                                                <div class="col-sm-2">Заголовок</div>
                                                <div class="col-sm-8">Содержимое</div>
                                                <div class="col-sm-1">Порядок</div>
                                                <div class="col-sm-1">Удалить</div>
                                            </div>
                                        </div>
                                        <div id="aptsen-gb" class="apt-list">
                                            <div id="apt_rowen-gb0" class="row" style="margin-bottom: 20px">
                                                <div class="col-sm-2">
                                                    <input type="text" name="product_apt_name[en-gb][]"
                                                           value="Применение " id="apt_name0" class="form-control"/>
                                                </div>
                                                <div class="col-sm-8">
                                                    <textarea name="product_apt_desc[en-gb][]" id="apt_desc_1_0"
                                                              cols="45" rows="5" class="form-control">&lt;p style=&quot;outline: 0px; margin-bottom: 10px; padding-top: 0px; font-size: 16px; color: rgb(41, 37, 63); font-family: standard; line-height: 20px !important;&quot;&gt;Нанесите маску тонким слоем на сухую кожу лица, избегая области вокруг глаз и губ, оставьте до полного высыхания. Аккуратно снимите маску по направлению снизу вверх, прихватывая край плёнки у подбородка. Тщательно смойте остатки маски теплой водой. Нанесите крем.&lt;/p&gt;&lt;p style=&quot;outline: 0px; margin-bottom: 0px; padding-bottom: 0px; font-size: 16px; color: rgb(41, 37, 63); font-family: standard; line-height: 20px !important;&quot;&gt;Используйте маску 1-2 раза в неделю.&lt;/p&gt;</textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <input name="tab_sort_order[en-gb][]" type="text" id="sort_order0"
                                                           value="1" size="5" class="form-control"/>
                                                </div>
                                                <div class="col-sm-1">
                                                    <a onclick="$('#apt_rowen-gb0').remove();" class="btn btn-danger"><i
                                                            class="fa fa-minus-circle fa-fw" style="color: #ffffff"></i></a>
                                                </div>
                                            </div>


                                            <div id="apt_rowen-gb1" class="row" style="margin-bottom: 20px">
                                                <div class="col-sm-2">
                                                    <input type="text" name="product_apt_name[en-gb][]" value="Состав"
                                                           id="apt_name1" class="form-control"/>
                                                </div>
                                                <div class="col-sm-8">
                                                    <textarea name="product_apt_desc[en-gb][]" id="apt_desc_1_1"
                                                              cols="45" rows="5" class="form-control">&lt;p&gt;&lt;span style=&quot;color: rgb(41, 37, 63); font-family: standard; font-size: 16px;&quot;&gt;Aqua, Polyvinyl Alcohol, Isopentyldiol, Propylene Glycol, Glycerin, Biosaccharide Gum-1, Epilobium Angustifolium Flower/Leaf/Steam Extract, Charcoal Powder, Aloe Barbadensis Leaf Juice, Sodium Salicylate, Cannabis Sativa Seed Oil Glycereth-8 Ester, Xanthan Gum, Laminaria Saccharina Extract, Fucus Vesiculosus Extract, Ulva Lactuca Extract, Chondrus Crispus Extract, Maris Sal, Benzyl Alcohol, Ethylhexylglycerin, Tocopherol, Fragrance&lt;/span&gt;&lt;br&gt;&lt;/p&gt;</textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <input name="tab_sort_order[en-gb][]" type="text" id="sort_order1"
                                                           value="0" size="5" class="form-control"/>
                                                </div>
                                                <div class="col-sm-1">
                                                    <a onclick="$('#apt_rowen-gb1').remove();" class="btn btn-danger"><i
                                                            class="fa fa-minus-circle fa-fw" style="color: #ffffff"></i></a>
                                                </div>
                                            </div>
                                            <div id="put-here"></div>
                                            <a onclick="addAptengb();" class="btn btn-success"><i
                                                    class="fa fa-plus fa-fw"></i> <span>Добавить вкладку</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endsection

@section('script')
<script type="text/javascript">
    var apt_row = 2;
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
