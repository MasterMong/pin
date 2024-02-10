<ul class="header-nav d-none d-md-flex">
    <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Users</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
</ul>
<ul class="header-nav ms-auto">
    <li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8000/notifications">
        <svg class="icon icon-lg">
          <use xlink:href="/core_ui/vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
        </svg></a></li>
    <li class="nav-item"><a class="nav-link" href="#">
        <svg class="icon icon-lg">
          <use xlink:href="/core_ui/vendors/@coreui/icons/svg/free.svg#cil-list-rich"></use>
        </svg></a></li>
    <li class="nav-item"><a class="nav-link" href="#">
        <svg class="icon icon-lg">
          <use xlink:href="/core_ui/vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
        </svg></a></li>
</ul>
<ul class="header-nav ms-3">
  <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      <div class="avatar avatar-md">
          @if($image = Auth::user()->presenter()->image())
            <img class="avatar-img" src="{{$image}}" alt="{{ Auth::user()->presenter()->title()}}"></div>
          @endif
    </a>
    <div class="dropdown-menu dropdown-menu-end pt-0">
      <div class="dropdown-header bg-light py-2">
        <div class="fw-semibold">Account</div>
      </div><a class="dropdown-item" href="#">
        <svg class="icon me-2">
          <use xlink:href="/core_ui/vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
        </svg> Updates<span class="badge badge-sm bg-info ms-2">42</span></a><a class="dropdown-item" href="#">
        <svg class="icon me-2">
          <use xlink:href="/core_ui/vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
        </svg> Messages<span class="badge badge-sm bg-success ms-2">42</span></a><a class="dropdown-item" href="#">
        <svg class="icon me-2">
          <use xlink:href="/core_ui/vendors/@coreui/icons/svg/free.svg#cil-task"></use>
        </svg> Tasks<span class="badge badge-sm bg-danger ms-2">42</span></a><a class="dropdown-item" href="#">
        <svg class="icon me-2">
          <use xlink:href="/core_ui/vendors/@coreui/icons/svg/free.svg#cil-comment-square"></use>
        </svg> Comments<span class="badge badge-sm bg-warning ms-2">42</span></a>
      <div class="dropdown-header bg-light py-2">
        <div class="fw-semibold">Settings</div>
      </div><a class="dropdown-item" href="{{ route(config('platform.profile', 'platform.profile')) }}">
        <svg class="icon me-2">
          <use xlink:href="/core_ui/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
        </svg> Profile</a><a class="dropdown-item" href="">
        <svg class="icon me-2">
          <use xlink:href="/core_ui/vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
        </svg> Settings</a><a class="dropdown-item" href="#">
        <svg class="icon me-2">
          <use xlink:href="/core_ui/vendors/@coreui/icons/svg/free.svg#cil-credit-card"></use>
        </svg> Payments<span class="badge badge-sm bg-secondary ms-2">42</span></a><a class="dropdown-item" href="#">
        <svg class="icon me-2">
          <use xlink:href="/core_ui/vendors/@coreui/icons/svg/free.svg#cil-file"></use>
        </svg> Projects<span class="badge badge-sm bg-primary ms-2">42</span></a>
      <div class="dropdown-divider"></div><a class="dropdown-item" href="#">
        <svg class="icon me-2">
          <use xlink:href="/core_ui/vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
        </svg> Lock Account</a><a class="dropdown-item" href="{{ route(config('platform.logout', 'platform.logout')) }}">
        <svg class="icon me-2">
          <use xlink:href="/core_ui/vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
        </svg> Logout</a>
    </div>
  </li>
</ul>