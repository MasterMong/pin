<div>
    <ul class="list-disc pl-3">
        @foreach($getState() as $innovation)
            <li>
                {{$innovation->name}}
            </li>
        @endforeach
    </ul>
</div>
