@extends('layouts.app')

@section('content')
    @include('layouts.nav')

    <div class="container">

        <span class="checkout-container">
            @include('partials.checkout')
        </span>

    @include('layouts.footer')
@endsection

