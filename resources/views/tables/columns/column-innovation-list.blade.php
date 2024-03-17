<div>
    <ul class="list-disc pl-3">
        @if($getState() != null)
            @foreach($getState() as $innovation)
                <li>
                    {{$innovation->name}}
                </li>
            @endforeach
        @else
            <div>
                ไม่มีข้อมูล
            </div>
        @endif
    </ul>
</div>
