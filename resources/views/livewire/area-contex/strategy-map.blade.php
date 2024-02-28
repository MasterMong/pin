<div>

    <div class="flex flex-col md:flex-row ">
        <div class="md:basis-48 md:mr-3 prose mb-3 items-center">
            <h3 class="text-center rounded p-3 bg-orange-300">วิสัยทัศน์</h3>
        </div>
        <div class="flex-auto shadow rounded p-4 bg-indigo-200 hover:bg-indigo-100 mb-3">
            {!! $contex->detail !!}
        </div>
    </div>
    <div class="flex flex-col md:flex-row ">
        <div class="md:basis-48 md:mr-3 prose mb-3 items-center">
            <h3 class="text-center rounded p-3 bg-orange-300">พันธกืจ</h3>
        </div>
        <div class="flex-auto shadow rounded p-4 bg-indigo-200 hover:bg-indigo-100 mb-3">
            {!! $contex->areaMission->detail !!}
        </div>
    </div>
    <div class="flex flex-col md:flex-row ">
        <div class="md:basis-48 md:mr-3 prose mb-3 items-center">
            <h3 class="text-center rounded p-3 bg-orange-300">เป้าประสงค์</h3>
        </div>
        <div class="flex-auto">
            <div class="grid grid-flow-col grid-cols-{{ count($contex->areaMission->areaGoals) }} gap-3">
                <div class="shadow rounded p-4 bg-indigo-200 hover:bg-indigo-100 mb-3">
                    @foreach ($contex->areaMission->areaGoals as $goal)
                        {{ $goal->detail }}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col md:flex-row ">
        <div class="md:basis-48 md:mr-3 prose mb-3 items-center">
            <h3 class="text-center rounded p-3 bg-orange-300">เป้าประสงค์</h3>
        </div>
        <div class="flex-auto">
            <div class="grid grid-flow-col grid-cols-{{ count($contex->areaMission->areaGoals) }} gap-3">
                <div class="shadow rounded p-4 bg-indigo-200 hover:bg-indigo-100 mb-3">
                    @foreach ($contex->areaMission->areaGoals as $goal)
                        {{ $goal->detail }}
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
