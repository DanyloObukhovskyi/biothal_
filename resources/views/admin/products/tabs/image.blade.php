
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