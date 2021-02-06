
<div class="tab-pane" id="tab-links">
    <!-- NeoSeo Exchange 1c - begin -->
    <div class="form-group">
        <label class="col-sm-2 control-label" for="input-code_1c">Код 1С</label>
        <div class="col-sm-10">
            <input type="text" name="code_1c" value="{{$product['productTo1C'] ? $product['productTo1C']['1c_id'] : ''}}"
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