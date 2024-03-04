<div>
    @if(count($getRecord()->projects) == 0)
        <div class="px-3 bg-orange-300 rounded-xl">
            ไม่มีข้อมูล
        </div>
    @else
        <div class="px-3 bg-green-300 rounded-xl">
            {{ count($getRecord()->projects) }}
        </div>
    @endif
</div>
