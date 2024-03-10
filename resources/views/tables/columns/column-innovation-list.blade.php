<div>
    <ul class="list-disc pl-3">
        @if(count($getState()) > 0)
            @foreach($getState() as $innovation)
                <li>
                    {{$innovation->name}}
                </li>
            @endforeach
        @endif
    </ul>
</div>
