@extends('admin.layouts.app')

@section('content')
    <div class="p-3">
        <div class="page-header">
            <h2>Добро Пожаловать, {{ auth()->user()->name }}!</h2>
        </div>
    </div>
@endsection
