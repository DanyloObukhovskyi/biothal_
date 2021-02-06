
<div class="tab-pane" id="tab-apt">
    <div class="tab-content">
        <ul class="nav nav-tabs" id="language">
            <li class="nav-item">
                <a class="nav-link active" role="tab" aria-selected="true" href="#language1" data-toggle="tab">
                    <img src="{{ url('image/en-gb.png')}}" title="English"/>
                    English
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="language1">
                <div>
                    <div class="row" style="font-size: 14px;font-weight: bold;margin-bottom: 17px;border-bottom: 2px solid #ccc;padding-bottom: 10px;">
                        <div class="col-sm-2">Заголовок</div>
                        <div class="col-sm-8">Содержимое</div>
                        <div class="col-sm-1">Порядок</div>
                        <div class="col-sm-1">Удалить</div>
                    </div>
                </div>
                <div id="aptsen-gb" class="apt-list">
                    @foreach ($product->productApts as $key => $productApt)
                        <tr id="image-row{{ $key }}">

                        </tr>
                        <div id="apt_rowen-gb{{ $key }}" class="row" style="margin-bottom: 20px">
                            <div class="col-sm-2">
                                <input type="text" name="product_apt_name[en-gb][]" value="{{ $productApt->tab_title }}" id="apt_name{{ $key }}" class="form-control"/>
                            </div>
                            <div class="col-sm-8">
                            <textarea name="product_apt_desc[en-gb][]" id="apt_desc_1_{{ $key }}"
                                      cols="45" rows="5" class="form-control">{{ $productApt->tab_desc }}</textarea>
                            </div>
                            <div class="col-sm-1">
                                <input name="tab_sort_order[en-gb][]" type="text" id="sort_order{{ $key }}" value="{{ $productApt->sort_order }}" size="5" class="form-control"/>
                            </div>
                            <div class="col-sm-1">
                                <a onclick="$('#apt_rowen-gb{{ $key }}').remove();" class="btn btn-danger">
                                    <i class="fa fa-minus-circle fa-fw" style="color: #ffffff"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    <div id="put-here"></div>
                    <a onclick="addAptengb();" class="btn btn-success"><i
                                class="fa fa-plus fa-fw"></i> <span>Добавить вкладку</span></a>
                </div>
            </div>
        </div>
    </div>
</div>