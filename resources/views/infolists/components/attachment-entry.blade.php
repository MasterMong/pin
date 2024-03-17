<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div>
        <hr>
        <div class="text-l font-bold mt-2">
            ไฟล์ที่แนบมาด้วย
        </div>
        @foreach($getState() as $key => $att)
            <div>
                <a href="/storage/{{$att}}" class="mt-2 cursor-pointer text-blue-500 underline">
                    ไฟล์แนบที่ {{$key + 1}}
                </a>
                <iframe src="/storage/{{$att}}" frameborder="0" onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));' style="min-height:400px;width:100%;border:none;overflow:hidden;"></iframe>
            </div>
        @endforeach
    </div>
</x-dynamic-component>
