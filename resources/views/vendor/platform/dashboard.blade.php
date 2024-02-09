@extends(config('platform.workspace', 'platform::workspace.compact'))

@section('aside')
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
          <a class="header-brand order-last" href="{{ route(config('platform.index')) }}">
              @includeFirst([config('platform.template.header'), 'platform::header'])
          </a>
        </div>
        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
            {!! Dashboard::renderMenu(\Orchid\Platform\Dashboard::MENU_MAIN) !!}
        </ul>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      <header class="header header-sticky mb-4">
        @includeWhen(Auth::check(), 'platform::partials.profile')
        <div class="header-divider"></div>
        <div class="container-fluid">
    @if(Breadcrumbs::has())
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb px-0 mb-2">
                <x-tabuna-breadcrumbs
                    class="breadcrumb-item"
                    active="active"
                />
            </ol>
        </nav>
    @endif
        </div>
        @include('platform::partials.search')
      </header>
      <div class="body flex-grow-1 px-3">
@endsection

@section('workspace')

    <div class="card mb-4">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div>
              <h4 class="card-title mb-0">@yield('title')</h4>
              <div class="small text-medium-emphasis" title="@yield('description')">@yield('description')</div>
            </div>
            <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                @yield('navbar')
            </div>
          </div>
        </div>
    </div>

    @include('platform::partials.alert')
    @yield('content')
@endsection
