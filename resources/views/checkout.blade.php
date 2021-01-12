@extends('layouts.app')

@section('content')
    @include('layouts.navCheckout')

    <div class="container">

        <div class="checkout-container">
            @include('partials.checkout')
        </div>
    @include('layouts.footer')
@endsection
