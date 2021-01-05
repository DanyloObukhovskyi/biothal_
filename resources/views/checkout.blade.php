@extends('layouts.app')

@section('content')
    @include('layouts.navCheckout')

    <div class="container">

        <span class="checkout-container">
            @include('partials.checkout')
        </span>

    @include('layouts.footer')
@endsection

