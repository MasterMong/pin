<div>
    @if($contex == null)
        <div class="text-center">
            <a href="{{route('filament.app.pages.area-context-page')}}"
               class="p-2 bg-blue-400 hover:bg-blue-500 rounded text-gray-50">เพิ่มข้อมูล</a>
        </div>
    @else
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
                <div
                    class="grid grid-flow-row auto-rows-max md:grid-flow-col md:grid-cols-{{ count($contex->areaMission->areaGoals) }} gap-3">
                    @foreach ($contex->areaMission->areaGoals as $goal)
                        <div class="shadow rounded p-4 bg-indigo-200 hover:bg-indigo-100 md:mb-3">
                            {{ $goal->detail }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex flex-col md:flex-row ">
            <div class="md:basis-48 md:mr-3 prose mb-3 items-center">
                <h3 class="text-center rounded p-3 bg-orange-300">กลยุทธ์</h3>
            </div>
            <div class="flex-auto">
                <div class="grid grid-flow-col grid-cols-{{ count($contex->areaMission->areaGoals) }} gap-3">
                    @foreach ($contex->areaMission->areaGoals as $goal)
                        <div class="mb-3 grid grid-flow-col grid-cols-{{ count($goal->areaStrategies) }} gap-3">
                            @foreach ($goal->areaStrategies as $strategy)
                                <div class="shadow rounded p-4 bg-indigo-200 hover:bg-indigo-100 ">
                                    {{ $strategy->detail }}
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex flex-col md:flex-row ">
            <div class="md:basis-48 md:mr-3 prose mb-3 items-center">
                <h3 class="text-center rounded p-3 bg-orange-300">เป้าหมาย</h3>
            </div>
            <div class="flex-auto">
                <div class="grid grid-flow-col grid-cols-{{ count($contex->areaMission->areaGoals) }} gap-3">
                    @foreach ($contex->areaMission->areaGoals as $goal)
                        <div class="mb-3 grid grid-flow-col grid-cols-{{ count($goal->areaStrategies) }} gap-3">
                            @foreach ($goal->areaStrategies as $strategy)
                                <ol class="shadow rounded p-4 bg-indigo-200 hover:bg-indigo-100">
                                    @foreach ($strategy->areaTargets as $target)
                                        <li>
                                            {{ $target->detail }}
                                        </li>
                                    @endforeach
                                </ol>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex flex-col md:flex-row ">
            <div class="md:basis-48 md:mr-3 prose mb-3 items-center">
                <h3 class="text-center rounded p-3 bg-orange-300">โครงการ/กิจกรรม</h3>
            </div>
            <div class="flex-auto">
                <div class="grid grid-flow-col grid-cols-{{ count($contex->areaMission->areaGoals) }} gap-3">
                    @foreach ($contex->areaMission->areaGoals as $goal)
                        <div class="mb-3 grid grid-flow-col grid-cols-{{ count($goal->areaStrategies) }} gap-3">
                            @foreach ($goal->areaStrategies as $strategy)
                                <div class="shadow rounded p-4 bg-indigo-200 hover:bg-indigo-100">
                                    @if(count($strategy->activity) == 0)
                                        -
                                    @else
                                        <ol class="list-decimal">
                                            @foreach ($strategy->activity as $activity)
                                                <li class="ml-4">
                                                    {{ $activity->name }}
                                                </li>
                                            @endforeach
                                        </ol>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
