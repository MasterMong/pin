<div>
    <ul class="list-disc pl-3">
        @if($getState() != null)
            @foreach($getState() as $innovation)
                <li>
                    {{$innovation->name}}
                </li>
            @endforeach
        @endif
    </ul>
</div>
