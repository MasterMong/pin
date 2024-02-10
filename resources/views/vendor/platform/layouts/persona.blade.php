<a href="{{ $url }}">
    <div class="d-sm-flex flex-row flex-wrap align-items-center">
        @empty(!$image)
            <div class="avatar avatar-md">
              <img class="avatar-img" src="{{ $image }}">
            </div>
        @endempty
        <div class="mt-2 mt-sm-0 mt-md-2 mt-xl-0">
            <div>{{ $title }}</div>
            <div class="small text-medium-emphasis">{{ $subTitle }}</div>
        </div>
    </div>
</a>
