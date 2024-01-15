<fieldset data-async="" x-data=''>
    <div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column">
        <div class="row px-2">
            <div class="col px-1 py-2">
                <h3>{{ $area->name }}</h3>
            </div>
        </div>
        <div class="row px-2">
            <div class="col-md-2 px-1 py-2">
                วิสัยทัศน์
            </div>
            <div class="col-md-10 px-1 py-2">
                {{ $vision }}
            </div>
        </div>
        <div class="row px-2">
            <div class="col-md-2 px-1 py-2">
                พันธกิจ
            </div>
            <div class="col-md-10 px-1 py-2">
                {{ $mission }}
            </div>
        </div>
        <div class="row px-2">
            <div class="col-md-2 px-1 py-2">
                เป้าประสงค์
            </div>
            <div class="col-md-10 px-1 py-2">
                <div class="row">
                    @forelse ($goals as $goal)
                        <div class="col px-2">
                            <div class="text-bg-warning bg-gradient p-2">
                                {{ $goal['detail'] }}
                            </div>
                        </div>
                    @empty
                        <div class="col px-2">
                            <div class="p-2 text-bg-light bg-gradient p-2">
                                -
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="row px-2">
            <div class="col-md-2 px-1 py-2">
                กลยุทธ์
            </div>
            <div class="col-md-10 px-1 py-2">
                <div class="row">
                    @forelse ($startegies as $startegy)
                        <div class="col px-2">
                            <div class="text-bg-warning bg-gradient p-2">
                                {{ $startegy['detail'] }}
                            </div>
                        </div>
                    @empty
                        <div class="col px-2">
                            <div class="p-2 text-bg-light bg-gradient p-2">
                                -
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="row px-2">
            <div class="col-md-2 px-1 py-2">
                เป้าหมาย
            </div>
            <div class="col-md-10 px-1 py-2">
                <div class="row">
                    @forelse ($targets as $target)
                        <div class="col px-2">
                            <div class="text-bg-warning bg-gradient p-2">
                                {{ $target['name'] }}
                            </div>
                        </div>
                    @empty
                        <div class="col px-2">
                            <div class="p-2 text-bg-light bg-gradient p-2">
                                -
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="row px-2">
            <div class="col-md-2 px-1 py-2">
                โครงการ
            </div>
            <div class="col-md-10 px-1 py-2">

            </div>
        </div>
    </div>
    </div>

</fieldset>
