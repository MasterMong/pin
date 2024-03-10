<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div>
        <ol class="list-decimal pl-5">
            @foreach($txt()['relate_types'] as $type)
                <li>
                    {{$type->label}}
                    <ol class="list-disc pl-5">
                        @foreach($txt()['relate_items'][$type->id] as $item)
                            <li>
                                {{$item->id}} {{$item->label}}
                            </li>
                        @endforeach
                        @if(isset($txt()['relate_type_child'][$type->name]))
                            <ol class="list-disc pl-5">
                                @foreach($txt()['relate_items'][$txt()['relate_type_child'][$type->name]->id] as $item)
                                    <li>
                                        {{$item->id}} {{$item->label}}
                                    </li>
                                @endforeach
                            </ol>
                        @endif
                    </ol>
                </li>
            @endforeach
        </ol>
    </div>
</x-dynamic-component>
