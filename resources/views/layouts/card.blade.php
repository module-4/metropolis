@extends('layouts.base')

@section('content')
    <div class="min-h-screen bg-bg-200 flex items-center justify-center">
        <div class="lg:w-1/4 w-full m-2">
            @yield('card')
        </div>
    </div>
@endsection
