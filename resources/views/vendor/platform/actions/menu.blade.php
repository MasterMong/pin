@isset($title)
    <li class="nav-title">
        {{ __($title) }}
    </li>
@endisset

@if (!empty($name))
<li class="nav-{{ empty($list)?'item':'group' }}">
    <a class="nav-{{ empty($list)?'link':'link nav-group-toggle' }}"
        @if(empty($list))
            data-turbo="{{ var_export($turbo) }}"
            {{ $attributes }}
        @else
            href="#"
        @endif
    >
        @if(!empty($list))
            @isset($icon)
                <svg class="nav-icon">
                  <use xlink:href="/core_ui/vendors/@coreui/icons/svg/free.svg#cil-{{ empty($name) ?: 'star'}}"></use>
                </svg>
            @endisset
        @endif

        {{ $name ?? '' }}

        @isset($badge)
            {{$badge['data']()}}
        @endisset
    </a>
    
    @if(!empty($list))
        <ul class="nav-group-items">
            @foreach($list as $item)
                {!!  $item->build($source) !!}
            @endforeach
        </ul>
    @endif
</li>
@endif

@if($divider)
    <li class="nav-divider"></li>
@endif

