@extends('layouts.app')

@section('content')
        <div style="margin-top: 20px; color: #6cb2eb"><i><u>Для лица: Категория очищение</u></i><br>
            <div class="container masonry">
                @foreach($face as $value)
                    <div class="item">{!!$value->name!!}<br>
                        <img style="margin-bottom: 40px" src="{{Storage::url('img/tonik.jpg')}}" width="190"><br>
                        {!!$value->description!!}
                        {!!$value->composition!!}</div>
                @endforeach
            </div>
        </div>
@endsection
