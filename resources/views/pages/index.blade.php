@extends('layouts.app')
@section('top')
    @include('layouts.navbar')
@endsection

@section('content')
    <div class="grid grid-cols-2 text-center">
        <div class="text-2xl font-bold py-14">{{ config('app.name') }}</div>
        <div class="text-2xl font-bold">{{ config('app.name') }}</div>
    </div>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection
