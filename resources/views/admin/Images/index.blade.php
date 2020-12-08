@extends('admin.layouts.app')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="example_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('admin.addImage')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="example_modal_label">Добавить картинку</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        Выберите картинку которую хотите добавить
                    </div>
                    <div class="modal-footer">
                        <img id="pic" src="http://placehold.it/180" class="col-md-4 ml-auto" alt="your image"
                             width="180" height="180">
                        <input id="img-input" type="file" name="img" onchange="readURL(this);">
                        <input type='submit' class="btn btn-dark" value="Добавить">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--- Page -->
    <div class="container" id="img_page">
        <div class="page-header w-100 alert bg-light p-0 shadow-sm mt-2">
            <form action="{{route('admin.deleteImage')}}" method="post">
                @csrf
                @method('POST')
                <div class="btn-group" role="group" aria-label="Basic example">
                    <div class="btn btn-group pull-right">
                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#example_modal">
                            Добавить
                        </button>
                        <button type="button" id="deletePic" class="btn btn-dark">Удалить</button>
                    </div>
                </div>
                @if($images == null)
                    <p>ГАЛЕРЕЯ - ПУСТА!</p>
                @else
                    @foreach($images as $image3)
                        <div class="d-flex flex-row justify-content-start">
                            @foreach($image3 as $image)
                                <input type="checkbox" id="pictures_{{$image->id}}" name="checked[]"
                                       value="{{$image->id}}">
                                <label for="pictures_{{$image->id}}" id="pictures_label_{{$image->id}}">
                                    <a href="{{ Storage::disk('public')->url('img/'.$image->name) }}" class="thumbnail">
                                        <img class="rounded-circle" src="{{Storage::disk('public')->url('img/'.$image->name)}}"
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
