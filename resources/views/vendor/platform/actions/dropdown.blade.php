@component($typeForm, get_defined_vars())
    
<div class="dropdown">
    <button class="btn btn-transparent p-0"
            {{ $attributes }}
            type="button"
            data-coreui-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false">
      @isset($icon)
        <svg class="icon">
          <use xlink:href="{{ $icon }}"></use>
        </svg>
      @endisset
    </button>
    <div class="dropdown-menu dropdown-menu-end">
        @foreach($list as $item)
            {!!  $item->build($source) !!}
        @endforeach
    </div>
  </div>
@endcomponent
