@extends('layouts.app')
@section('content')
    <div class="h-[100dvh] flex justify-center">
        <div class="my-auto text-center bg-white p-20 rounded-2xl shadow-2xl bg-gray-100 border-2 border-gray-900">
            <div class="font-bold text-2xl">
                {{$message}}
            </div>
            @if($des != '')
                <div class="mt-2">
                    {{$des}}
                </div>
            @endif
            @if($bt_label != '')
                <div class="mt-2">
                    <a class="underline text-blue-500" href="{{$bt_link}}">{{$bt_label}}</a>
                    <a class="underline text-red-500" href="{{ route('logmeout') }}">ออกจากระบบ</a>
                </div>
            @endif
        </div>
    </div>
@endsection
