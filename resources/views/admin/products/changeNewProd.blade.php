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
                            <li><a href="#tab-attribute" data-toggle="tab">Атрибуты</a></li>
                            <li><a href="#tab-discount" data-toggle="tab">Скидка</a></li>
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
                                                       value="Маска-пленка – незаменимое средство для глубокого очищения и отшелушивания кожи."
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
                                                    name="product_description[{{$product['id']}}][meta_h1]" value=""
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
                                                          id="input-meta-description1" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-meta-keyword1">Мета-тег
                                                Keyword</label>
                                            <div class="col-sm-10">
                                                <textarea name="product_description[{{$product['id']}}][meta_keyword]" rows="5"
                                                          placeholder="Мета-тег Keyword" id="input-meta-keyword1"
                                                          class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-tag1"><span
                                                    data-toggle="tooltip"
                                                    title="теги разделяются запятой">Теги товара</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" name="product_description[{{$product['id']}}][tag]" value=""
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
                                               value=" Очищающая маска для лица Конопля Водоросли" placeholder="Модель"
                                               id="input-model" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-sku"><span data-toggle="tooltip"
                                                                                                title="SKU или код производителя">Краткое описание</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="sku"
                                               value="Маска-пленка на основе конопляного масла и морских водорослей эффективно очищает поры от загрязнений и излишков кожного сала, уменьшает воспаления, выравнивает цвет лица."
                                               placeholder="Краткое описание" id="input-sku" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-upc"><span data-toggle="tooltip"
                                                                                                title="Универсальный код товара">Англ.название</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="upc" value="Cannabis Seaweed Cleansing Mask"
                                               placeholder="Англ.название" id="input-upc" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-ean"><span data-toggle="tooltip"
                                                                                                title="Европейский код товара">Артикул</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="ean" value="137" placeholder="Артикул" id="input-ean"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-jan"><span data-toggle="tooltip"
                                                                                                title="Японский код товара">Объем</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="jan" value="1265" placeholder="Объем" id="input-jan"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-price">Цена</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="price" value="759" placeholder="Цена" id="input-price"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-quantity">Количество</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="quantity" value="25" placeholder="Количество"
                                               id="input-quantity" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-minimum"><span
                                            data-toggle="tooltip"
                                            title="Минимальное количество товара в заказе (меньше данного кол-ва товара, добавление в корзину будет запрещено )">Минимальное количество</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="minimum" value="1" placeholder="Минимальное количество"
                                               id="input-minimum" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-subtract">Вычитать со
                                        склада</label>
                                    <div class="col-sm-10">
                                        <select name="subtract" id="input-subtract" class="form-control">
                                            <option value="1" selected="selected">Да</option>
                                            <option value="0">Нет</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-stock-status"><span
                                            data-toggle="tooltip"
                                            title="Статус показывается, когда товара нет на складе">Отсутствие на складе</span></label>
                                    <div class="col-sm-10">
                                        <select name="stock_status_id" id="input-stock-status" class="form-control">
                                            <option value="6" selected="selected">2-3 Days</option>
                                            <option value="7">В наличии</option>
                                            <option value="5">Нет в наличии</option>
                                            <option value="8">Предзаказ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-status">Статус</label>
                                    <div class="col-sm-10">
                                        <select name="status" id="input-status" class="form-control">
                                            <option value="1" selected="selected">Включено</option>
                                            <option value="0">Отключено</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-sort-order">Порядок
                                        сортировки</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="sort_order" value="1" placeholder="Порядок сортировки"
                                               id="input-sort-order" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-links">
                                <!-- NeoSeo Exchange 1c - begin -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-code_1c">Код 1С</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="code_1c" value="8d4e9ad1-b166-11ea-ba82-3417ebd478d7"
                                               placeholder="Код 1С" id="input-code_1c" class="form-control"/>
                                    </div>
                                </div>
                                <!-- NeoSeo Exchange 1c - end -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-category">Main category:</label>
                                    <div class="col-sm-10">
                                        <select id="main_category_id" name="main_category_id" class="form-control">
                                            <option value="0" selected="selected"> --- Не выбрано ---</option>
                                            <option value="33" selected="selected">Для лица</option>
                                            <option value="66">Для лица &gt; Маски</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="input-category"><span
                                            data-toggle="tooltip"
                                            title="(Автозаполнение)">Показывать в категориях</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="category" value=""
                                               placeholder="Показывать в категориях" id="input-category"
                                               class="form-control"/>
                                        <div id="product-category" class="well well-sm"
                                             style="height: 150px; overflow: auto;">
                                            <div id="product-category33"><i class="fa fa-minus-circle"></i> Для лица
                                                <input type="hidden" name="product_category[]" value="33"/>
                                            </div>
                                            <div id="product-category66"><i class="fa fa-minus-circle"></i> Для лица
                                                &gt; Маски <input type="hidden" name="product_category[]" value="66"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-attribute">
                                <div class="table-responsive">
                                    <table id="attribute" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <td class="text-left">Атрибут</td>
                                            <td class="text-left">Текст</td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="text-left">
                                                <button type="button" onclick="addAttribute();" data-toggle="tooltip"
                                                        title="Добавить" class="btn btn-primary"><i
                                                        class="fa fa-plus-circle"></i></button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-discount">
                                <div class="table-responsive">
                                    <table id="discount" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <td class="text-left">Группа клиентов</td>
                                            <td class="text-right">Количество</td>
                                            <td class="text-right">Приоритет</td>
                                            <td class="text-right">Цена</td>
                                            <td class="text-left">Дата начала</td>
                                            <td class="text-left">Дата окончания</td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="6"></td>
                                            <td class="text-left">
                                                <button type="button" onclick="addDiscount();" data-toggle="tooltip"
                                                        title="Добавить" class="btn btn-primary"><i
                                                        class="fa fa-plus-circle"></i></button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
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
