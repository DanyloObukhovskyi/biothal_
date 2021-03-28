@extends('admin.layouts.app')

@section('content')

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="profile-tab" style="color: #000000" data-toggle="tab" href="#profile"
               role="tab"
               aria-controls="profile" aria-selected="false"><b>Глобальные изображения</b></a>
        </li>
    </ul>

    <!-- Modal -->
    <div class="modal fade" id="example_modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('admin.addGlobalImage')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="example_modal_label2">Добавить картинку</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        Выберите картинку которую хотите добавить
                    </div>
                    <div class="modal-footer">
                        <img id="pic2" src="http://placehold.it/2881x757" class="col-md-4 ml-auto"
                             alt="your image"
                             width="180" height="180">
                        <input id="img2-input" type="file" name="img2" onchange="readURL(this);">
                        <input type='submit' class="btn btn-dark" value="Добавить">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--- Page -->
    <div class="container" id="img_page2">
        <div class="page-header w-100 alert bg-light p-0 shadow-sm mt-2">
            <form action="{{route('admin.deleteGlobalImage')}}" method="post">
                @csrf
                @method('POST')
                <div class="btn-group" role="group" aria-label="Basic example">
                    <div class="btn btn-group pull-right">
                        <button type="button" class="btn btn-dark" data-toggle="modal"
                                data-target="#example_modal2">
                            Добавить
                        </button>
                        <button type="button" id="deletePic2" class="btn btn-dark">Удалить</button>
                    </div>
                </div>
                @if($imagesGlobal == null)
                    <div style="justify-content: center; display: flex">
                        <p >ГАЛЕРЕЯ - ПУСТА!</p>
                    </div>
                @else
                    @foreach($imagesGlobal as $image_global)
                        <div class="card-body d-flex flex-row justify-content-start">
                            @foreach($image_global as $global)
                                <input type="checkbox" id="pictures_{{$global->id}}" name="checked2[]"
                                       value="{{$global->id}}">
                                <label for="pictures_{{$global->id}}" id="pictures_label_{{$global->id}}">
                                    <a href="{{ Storage::disk('public')->url('storage/img/carousel/'.$global->name) }}"
                                       class="thumbnail">
                                        <img class="card-body"
                                             src="{{Storage::disk('public')->url('storage/img/carousel/'.$global->name)}}"
                                             width="200" height="200" alt="Изображение товара">
                                    </a>
                                </label>
                            @endforeach
                        </div>
                    @endforeach
                @endif
            </form>
        </div>
    </div>
@endsection
