@extends('platform::app')

@section('body')

    @yield('workspace')

    @includeFirst([config('platform.template.footer'), 'platform::footer'])

@endsection
