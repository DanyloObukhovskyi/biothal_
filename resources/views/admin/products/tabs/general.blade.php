
<div class="tab-pane active" data-toggle="tab" id="tab-general">
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