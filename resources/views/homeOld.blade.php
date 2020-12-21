@extends('layouts.app')

@section('content')
    @include('layouts.nav')

    {{--    <div class="container">--}}
    {{--        <div class="row justify-content-center">--}}
    {{--            <div class="col-md-8">--}}
    {{--                <div class="card">--}}
    {{--                    --}}{{--                    <div class="card-header">{{ __('Dashboard') }}</div>--}}

    {{--                    <div class="card-body">--}}
    {{--                        @if (session('status'))--}}
    {{--                            <div class="alert alert-success" role="alert">--}}
    {{--                                {{ session('status') }}--}}
    {{--                            </div>--}}
    {{--                        @endif--}}

    {{--                        --}}{{--                        {{ __('You are logged in!') }}--}}
    {{--                    </div>--}}
    {{--                    @if(Auth::user())--}}
    {{--                        @if(Auth::user()->type == 'admin')--}}
    {{--                            <a href="{{route('admin.dashboard')}}"></a>--}}
    {{--                        @endif--}}
    {{--                    @endif--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    <script>--}}
    {{--        $(document).ready(function() {--}}
    {{--            $('#example').DataTable();--}}
    {{--        } );--}}
    {{--    </script>--}}

@endsection
