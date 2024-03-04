<div>
    @foreach($relates as $relate)
        <div>
            <h1>{{$relate->label}}</h1>
            @foreach($relate->relateTypes as $type)
                <div class="pl-5">
                    {{$type->label}}
                </div>
            @endforeach
        </div>
    @endforeach
    {{-- Stop trying to control. --}}
</div>
